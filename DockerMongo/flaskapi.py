import os
from pymongo import MongoClient
client = MongoClient(os.environ['DB_PORT_27017_TCP_ADDR'], 27017)
db = client.appdb
import arrow

#############################


def listAll(num):
    """
    List num open+close times in ascending order
    """
    result = []

    #for top
    ctr = 0
    max = False

    brevs = db.appdb.find()
    brev_it = [item for item in brevs]
    brev_it.sort(key = lambda item:item['day_time']) #sort ascending by start date and time

    sorted_brevs = sort_by_dtb(brev_it)

    for i in range(len(sorted_brevs)):
        base = sorted_brevs[i][0] #all instances of all_of[i] will have the same 
                            #distance, date, and time
        tmp = {
            'distance':base['brevet'],
            'begin_date': base['date'],
            "begin_time": base['time'],
            'controls': [] 
        }
        controls = []

        if num == 0: #if top is 0 then no times are shown so return empty
            tmp['controls'] = controls
            result.append(tmp)
            return result 
        
        for item in sorted_brevs[i]: #add every control with same base
            control_tmp = {}
            control_tmp['open'] = item['open']
            control_tmp['close'] = item['close']
            controls.append(control_tmp)
            ctr+=1
            if ctr == num: #top times reached let it sort after
                max = True

        controls.sort(key=lambda item: arrow.get(item['open'], 'ddd M/D HH:mm')) #sort times in ascending order
        
        if max == True: 
            #get rid of excess times
            while num != ctr:
                controls.pop()
                ctr-=1
        
        tmp['controls'] = controls
        result.append(tmp)
        if max == True:
            return result 
    return result


#############################


def listOpen(num):
    """
    List num open times in ascending order
    """
    result = []

    #for top
    ctr = 0
    max = False

    brevs = db.appdb.find()
    brev_it = [item for item in brevs]
    brev_it.sort(key = lambda item:item['day_time']) #sort ascending by start date and time

    sorted_brevs = sort_by_dtb(brev_it) 

    for i in range(len(sorted_brevs)):
        base = sorted_brevs[i][0] #all instances of all_of[i] will have the same 
                            #distance, date, and time
        tmp = {
            'distance':base['brevet'],
            'begin_date': base['date'],
            "begin_time": base['time'],
            'controls': [] 
        }
        controls = []

        if num == 0: #if top is 0 then no times are shown so return empty
            tmp['controls'] = controls
            result.append(tmp)
            return result 
        
        for item in sorted_brevs[i]: #add every control with same base
            control_tmp = {}
            control_tmp['open'] = item['open']
            controls.append(control_tmp)
            ctr+=1
            if ctr == num: #top times reached let it sort after
                max = True

        controls.sort(key=lambda item: arrow.get(item['open'], 'ddd M/D HH:mm')) #sort times in ascending order
        
        if max == True: 
            #get rid of excess times
            while num != ctr:
                controls.pop()
                ctr-=1
        
        tmp['controls'] = controls
        result.append(tmp)
        if max == True:
            return result 
    return result


#############################


def listClose(num):
    """
    List num close times in ascending order 
    """
    result = []

    #for top
    ctr = 0
    max = False

    brevs = db.appdb.find()
    brev_it = [item for item in brevs]
    brev_it.sort(key = lambda item:item['day_time']) #sort ascending by start date and time

    sorted_brevs = sort_by_dtb(brev_it)

    for i in range(len(sorted_brevs)):
        base = sorted_brevs[i][0] #all instances of all_of[i] will have the same 
                            #distance, date, and time
        tmp = {
            'distance':base['brevet'],
            'begin_date': base['date'],
            "begin_time": base['time'],
            'controls': [] 
        }
        controls = []

        if num == 0: #if top is 0 then no times are shown so return empty
            tmp['controls'] = controls
            result.append(tmp)
            return result 
        
        for item in sorted_brevs[i]: #add every control with same base
            control_tmp = {}
            control_tmp['close'] = item['close']
            controls.append(control_tmp)
            ctr+=1
            if ctr == num: #top times reached let it sort after
                max = True

        controls.sort(key=lambda item: arrow.get(item['close'], 'ddd M/D HH:mm')) #sort times in ascending order
        
        if max == True: 
            #get rid of excess times
            while num != ctr:
                controls.pop()
                ctr-=1
        
        tmp['controls'] = controls
        result.append(tmp)
        if max == True:
            return result 
    return result



#Source for sort https://www.geeksforgeeks.org/python-sort-list-of-dates-given-as-strings/

#############################
#Helper functions
#############################

def sort_by_dtb(brev_it):
    """
    Sorts times in ascending order
    """
    sorted_brevs = [] #all times in ascending order with no repeats   
    copy = [] #to check for repeats
    for item in brev_it: #sort items of db by date time and brevet

        if item['dtb'] in copy: #make sure we dont repeat
            continue

        dtb = db.appdb.find({'dtb':item['dtb']}) #find all items with same 'd'ate, 't'ime, and 'b'revet
        dtb_list = [item for item in dtb]
        
        tmp = []
        for i in dtb_list:
            tmp.append(i)
        copy.append(item['dtb'])
        sorted_brevs.append(tmp)
    return sorted_brevs