"""
Replacement for RUSA ACP brevet time calculator
(see https://rusa.org/octime_acp.html)

"""

import flask
from flask import request, abort
import arrow  # Replacement for datetime, based on moment.js
import acp_times  # Brevet time calculations
import config
import logging
#Mongo
import os
from pymongo import MongoClient
import mongo_funct


###
# Globals
###
app = flask.Flask(__name__)
CONFIG = config.configuration()
app.secret_key = CONFIG.SECRET_KEY
##Mongo
client = MongoClient(os.environ['DB_PORT_27017_TCP_ADDR'], 27017)
db = client.appdb

###
# Pages
###

@app.route("/")
@app.route("/index")
def index():
    ####Mongo
    _items = db.appdb.find()
    items = [item for item in _items]
    ####
    app.logger.debug("Main page entry")
    return flask.render_template('calc.html')


@app.errorhandler(404)
def page_not_found(error):
    app.logger.debug("Page not found")
    flask.session['linkback'] = flask.url_for("index")
    return flask.render_template('404.html'), 404

@app.route("/empty")
def empty_form():
    """empty form submitted"""
    return flask.render_template('empty.html'), 400
@app.route("/negative")
def negative():
    """negative values"""
    return flask.render_template('negative.html'), 400  
###############
#
# AJAX request handlers
#   These return JSON, rather than rendering pages.
#
###############
@app.route("/_calc_times")
def _calc_times():
    """
    Calculates open/close times from miles, using rules
    described at https://rusa.org/octime_alg.html.
    Expects one URL-encoded argument, the number of miles.
    """

    app.logger.debug("Got a JSON request")

    km = request.args.get('km', 999, type=float)
    distance = request.args.get('distance', type = float)
    begin_date = request.args.get('begin_date')
    begin_time = request.args.get('begin_time')

    app.logger.debug("km={}".format(km))
    app.logger.debug("request.args: {}".format(request.args))

    day_and_time = begin_date + ' ' + begin_time
    time = arrow.get(day_and_time, 'YYYY-MM-DD HH:mm')
    time2 = arrow.get(day_and_time, 'YYYY-MM-DD HH:mm')

    open_time = acp_times.open_time(km, distance, time.isoformat())
    close_time = acp_times.close_time(km, distance, time2.isoformat())

    result = {"open": open_time, "close": close_time, 
              'brevetdist': distance,
              "begindate": begin_date, "begintime": begin_time,
              'daytime' : day_and_time,
              "km":km
              }
    return flask.jsonify(result=result)

@app.route("/display")
def display():
    """Gets all database entries and puts them into a flask file"""
    items = mongo_funct.get_all()
    return flask.render_template('display.html', items=items), 200

@app.route("/submit")
def sumbit():
    """
    Enters all gathered table data and puts it into a database
    """
    miles = request.args.get('miles_dst', type=float) 
    distances = request.args.get('distances', type=float)
    openings = request.args.get('openings', type=str)
    closings = request.args.get('closings', type=str)
    brev = request.args.get('brev', type=int)
    loc = request.args.get('loc', type=str)
    start_date = request.args.get('start_date', type=str)
    start_time = request.args.get('start_time', type=str)
    mongo_funct.add_to_db(distances, openings, closings, brev, loc, start_date, start_time, miles)
    rslt = {
        "m" : miles
    }
    return flask.jsonify(result=rslt)

#############

app.debug = CONFIG.DEBUG
if app.debug:
    app.logger.setLevel(logging.DEBUG)

if __name__ == "__main__":
    print("Opening for global access on port {}".format(CONFIG.PORT))
    app.run(port=CONFIG.PORT, host="0.0.0.0")
