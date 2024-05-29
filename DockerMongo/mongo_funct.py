import os
from pymongo import MongoClient
client = MongoClient(os.environ['DB_PORT_27017_TCP_ADDR'], 27017)
db = client.appdb

def add_to_db(distances, openings, closings, brev, loc, date, time, miles):
    """Creates a database entry for acp_times and its various details"""
    item_doc = {
            'distance' : distances,
            'open' : openings,
            'close' : closings,
            'brevet' : brev,
            'loc' : loc,
            'date' : date,
            'time' : time,
            'miles' : miles 
        }
    db.appdb.insert_one(item_doc)
    return

def get_all():
   """Gets all the database entries and puts them in a list"""
   _items = db.appdb.find()
   items = [item for item in _items]
   return items 