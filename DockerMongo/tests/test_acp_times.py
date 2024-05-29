"""
Nose tests for acp_times.py
"""
#import open and close functs + supporting functs
from acp_times import * 
import arrow
import nose 
import logging
logging.basicConfig(format='%(levelname)s:%(message)s',
                    level=logging.WARNING)
log = logging.getLogger(__name__)


default_date = arrow.get("2017-01-01 00:00", 'YYYY-MM-DD HH:mm').isoformat()
def test_small_values():
    """
    Values smaller than 60 add one hour to close time
    """
    assert open_time(20, 200, default_date) == arrow.get("2017-01-01 00:35", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(20, 200, default_date) == arrow.get("2017-01-01 02:00", 'YYYY-MM-DD HH:mm').isoformat()

def test_overall_time_limit_rule():
    """
    Article 9 states that: Overall time limits vary for each brevet 
    according to the distance. These are: (in hours and minutes, HH:MM) 
    13:30 for 200 KM, 20:00 for 300 KM, 27:00 for 400 KM, 
    40:00 for 600 KM, and 75:00 for 1000 KM.
    """
    assert close_time(200, 200, default_date) == arrow.get("2017-01-01 13:30", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(300, 300, default_date) == arrow.get("2017-01-01 20:00", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(400, 400, default_date) == arrow.get("2017-01-02 03:00", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(600, 600, default_date) == arrow.get("2017-01-02 16:00", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(1000, 1000, default_date) == arrow.get("2017-01-04 03:00", 'YYYY-MM-DD HH:mm').isoformat()


def test_larger_than_brevet():
    """
    Control larger than brevet 
    (up to 20% larger) and above
    """
    brevets = [200, 300, 400, 600, 1000]
    for b in brevets:
        percent_20 = b*0.2
        #20 percent above brevet stays the same - based on the RUSA calc which had a maximum of 20 percent above brevet
        assert open_time(b, b, default_date) == open_time(b+percent_20, b, default_date)
        assert close_time(b, b, default_date) == close_time(b+percent_20, b, default_date)
        #above 20 percent is still the same
        assert open_time(b, b, default_date) == open_time(b+percent_20+1, b, default_date)
        assert close_time(b, b, default_date) == close_time(b+percent_20+1, b, default_date)
    
def test_zero():
    """
    Control is zero
    """
    assert open_time(0, 200, default_date) == default_date
    assert close_time(0, 200, default_date) == arrow.get("2017-01-01 01:00", 'YYYY-MM-DD HH:mm').isoformat()

def test_from_website():
    """
    Test examples shown on website
    """
    assert open_time(890, 1000, default_date) == arrow.get("2017-01-02 05:09", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(890, 1000, default_date) == arrow.get("2017-01-03 17:23", 'YYYY-MM-DD HH:mm').isoformat() 
    
    assert open_time(60, 200, default_date) == arrow.get("2017-01-01 01:46", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(60, 200, default_date) == arrow.get("2017-01-01 04:00", 'YYYY-MM-DD HH:mm').isoformat() 

    assert open_time(120, 200, default_date) == arrow.get("2017-01-01 03:32", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(120, 200, default_date) == arrow.get("2017-01-01 08:00", 'YYYY-MM-DD HH:mm').isoformat() 

    assert open_time(175, 200, default_date) == arrow.get("2017-01-01 05:09", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(175, 200, default_date) == arrow.get("2017-01-01 11:40", 'YYYY-MM-DD HH:mm').isoformat() 

    assert open_time(205, 200, default_date) == arrow.get("2017-01-01 05:53", 'YYYY-MM-DD HH:mm').isoformat()
    assert close_time(205, 200, default_date) == arrow.get("2017-01-01 13:30", 'YYYY-MM-DD HH:mm').isoformat() 

