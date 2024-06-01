# Project 6: Brevet time calculator service

Simple listing service from project 5 stored in MongoDB database.

## Author: Aaron Reyes Rodriguez areyesro@uoregon.edu

### ACP controle times
* That's "controle" with an 'e', because it's French, although "control" is also accepted. Controls are points where a rider must obtain proof of passage, and control[e] times are the minimum and maximum times by which the rider must arrive at the location.

* The source for to calculate the controle times is here (https://rusa.org/pages/acp-brevet-control-times-calculator). Additional information used for implementing specific rules is here (https://rusa.org/pages/rulesForRiders).

### Calculation
* This software provides the calculation time for a brevet control distance. The distance is calculated with kilometers. Each distance has an opening and closing time depending on the minimum speed and maximum speed that correlates to its distance. Here are the following distances with their minimum and maximum speed

 - 0-200km minimum = 15 km/hr maximum = 34 km/hr
 - 200-400km minimum = 15 km/hr maximum = 34 km/hr
 - 400-600km minimum = 15 km/hr maximum = 34 km/hr
 - 600-1000km minimum = 11.428 km/hr maximum = 34 km/hr
 - 1000-1300km minimum = 13.333 km/hr maximum = 34 km/hr

* The opening time depends on the minimum time and the closing time depends on the maximum. The time calculation divides the distance by the speeds. The hours and minutes are calculated like this:

      * 100(km)/15(km/hr) = 6.6666… The number before the decimal is the hours and we turn the decimal (0.6666…) into minutes by multiplying by 60 and rounding to the nearest minute. We end up with 6 hours and 40 minutes. There is a small specification for the rounding for the minutes. Let’s say when we multiply by 60 for the minutes we get 7.5 minutes we round to 7 instead of 8.

* For larger than 200 we separate the distances according to each row and apply the distances in said row. For example, let's say there is a control at 890km. The times are calculated in the following way: 

      * Opening time - 200/34 + 200/32 + 200/30 + 290/28 = 29 Hours 29 minutes 
      * Closing time - 200/15 + 200/15 + 200/15 + 290/11.428 = 65 Hours 23 minutes

### Special Cases
* Let's say a control distance ends at a brevet. According to article 9 in the rules for the RUSA there are certain times the control must close at said brevet. In the article it says “(in hours and minutes, HH:MM) 13:30 for 200 KM, 20:00 for 300 KM, 27:00 for 400 KM, 40:00 for 600 KM, and 75:00 for 1000 KM”. This also implies that if a race is longer than the brevet the control distances after the brevet must still correspond to the brevet closing time. For example a control at 200km and 205km close at the same time.

* For distances less than 60 we add one hour to the closing time, this is prevents controls from having a time too close to the open time or even before the open time.

### Software implementation

#### Ajax
* This software creates a table to imput distances. You select a time and date to calulate the opening and closing time for each input distance. It does this by using Ajax and Flask. Ajax inputs the opening and closing times by first having javascript take in the input distance and starting date and time. It then sends those to the Flask file. Flask then applies the calculations with the functions in acp_times.py. Finally, Flask returns a ISO 8601 format date-time string for each close and open time back to Ajax and Ajax inputs the date and time in the correct format.

#### Mongodb
* This project also uses mongodb databases. It does this with the following functionalites:

      1. A submit button that when clicked adds all entries from the ACP table and stores them in a database
      1. A display button which takes you to an hmtl page that shows all the entries that have been submitted into the database

#### API
* Another feature in this project is the use of API. It does this with the following functionalites:

1. API

      * http://<host:port>/listAll - returns all open and close times in the database
      * http://<host:port>/listOpenOnly - returns open times only
      * http://<host:port>/listCloseOnly - returns close times only

1. API representation

      * http://<host:port>/listAll/csv - returns all open and close times in CSV format
      * http://<host:port>/listOpenOnly/csv - returns open times only in CSV format
      * http://<host:port>/listCloseOnly/csv - returns close times only in CSV format
      * http://<host:port>/listAll/json - returns all open and close times in JSON format
      * http://<host:port>/listOpenOnly/json - returns open times only in JSON format
      * http://<host:port>/listCloseOnly/json - returns close times only in JSON format

1. A query parameter to get top "k" open and close times. For examples, see below.

      * http://<host:port>/listOpenOnly/csv?top=3 - returns top 3 open times only (in ascending order) in CSV format
      * http://<host:port>/listOpenOnly/json?top=5 - returns top 5 open times only (in ascending order) in JSON format
      * http://<host:port>/listCloseOnly/csv?top=6 - returns top 5 close times only (in ascending order) in CSV format
      * http://<host:port>/listCloseOnly/json?top=4 - returns top 4 close times only (in ascending order) in JSON format

1. There is also a consumer program (made in php). It shows the examples from up above and some extra more. 
    