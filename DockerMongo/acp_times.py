"""
Open and close time calculations
for ACP-sanctioned brevets
following rules described at https://rusa.org/octime_alg.html
and https://rusa.org/pages/rulesForRiders
"""
import math
import arrow

#  Note for CIS 322 Fall 2016:
#  You MUST provide the following two functions
#  with these signatures, so that I can write
#  automated tests for grading.  You must keep
#  these signatures even if you don't use all the
#  same arguments.  Arguments are explained in the
#  javadoc comments.
#

def separate_decimal_acp(number):
    """
    Args:
      number: Float
    Returns:
      Truns number into hours and minutes
    """
    minutes = (number % 1) * 60.0 #round to nearest minute
    hours = math.trunc(number) #https://www.geeksforgeeks.org/how-to-remove-all-decimals-from-a-number-using-python/
    
    #RUSA calc rounds 0.5 down
    if minutes - math.trunc(minutes) == 0.5:
        minutes = math.trunc(minutes)
    else:
        minutes = round(minutes)
    return (hours, minutes)

def separate_distances(number):
   """
   Args:
      number: control distance
   Returns:
      A list of distances seperated in such a way that shows how much
      distance is traveled in each brevet
   """
   brevets = [(0,200), (200,200), (400,200), (600,400), (1000,300)] #(brevet, distance to next brevet)
   distances = []
   for distance, dst_to_nxt  in brevets:
      km_through_brevet = number - distance
      if km_through_brevet > dst_to_nxt:
         distances.append(dst_to_nxt)
      else:
         distances.append(km_through_brevet)
         break
   return distances

def timing_calculation(distances, speeds):
   """
   Args:
      distances: list of distances to calculate
      speeds: list of speeds

   Returns:
      Tuple of hours and minutes
   """
   add_hours = 0
   add_minutes = 0
   length = len(distances)
   for ind in range(length):
      distance = distances[ind]
      speed = speeds[ind]
      timing = distance/speed
      hours, minutes = separate_decimal_acp(timing)
      add_hours += hours
      add_minutes += minutes
   return (add_hours, add_minutes)


def open_time(control_dist_km, brevet_dist_km, brevet_start_time):
    """
    Args:
       control_dist_km:  number, the control distance in kilometers
       brevet_dist_km: number, the nominal distance of the brevet
           in kilometers, which must be one of 200, 300, 400, 600,
           or 1000 (the only official ACP brevet distances)
       brevet_start_time:  An ISO 8601 format date-time string indicating
           the official start time of the brevet
    Returns:
       An ISO 8601 format date string indicating the control open time.
       This will be in the same time zone as the brevet start time.
    """

    max_speeds = [34, 32, 30, 28, 26]

    #RUSA calc uses same open and close times for distances between brevet and 20% above it
    if control_dist_km > brevet_dist_km:
       #since close time does this it must happen
       control_dist_km = brevet_dist_km
      
    distances = separate_distances(control_dist_km)
    add_hours, add_minutes = timing_calculation(distances, max_speeds)

    time = arrow.get(brevet_start_time)
    x_open_time = time.shift(hours =+ add_hours, minutes =+ add_minutes)
    return x_open_time.isoformat()


def close_time(control_dist_km, brevet_dist_km, brevet_start_time):
    """
    Args:
       control_dist_km:  number, the control distance in kilometers
          brevet_dist_km: number, the nominal distance of the brevet
          in kilometers, which must be one of 200, 300, 400, 600, or 1000
          (the only official ACP brevet distances)
       brevet_start_time:  An ISO 8601 format date-time string indicating
           the official start time of the brevet
    Returns:
       An ISO 8601 format date string indicating the control close time.
       This will be in the same time zone as the brevet start time.
    """
    min_speeds = [15, 15, 15, 11.428, 13.333]
    #Overall time limits vary for each brevet according to the distance. 
    #These are: (in hours and minutes, HH:MM) 
    #13:30 for 200 KM, 20:00 for 300 KM, 27:00 for 400 KM, 
    #40:00 for 600 KM, and 75:00 for 1000 KM.
    min_speeds = [15, 15, 15, 11.428, 13.333]
    control_edge_times = {
                   200: (13, 30),
                   300: (20, 0),
                   400: (27, 0), 
                   600: (40, 0), 
                   1000: (75, 0), 
                   }
    if control_dist_km > brevet_dist_km:
       #each brevet has an overall time so anything larger automatically
       #gets set to the brevet distance
       control_dist_km = brevet_dist_km


    if control_dist_km <= 60: #French method for close time for control dist up to 60 km
       timing = control_dist_km/20
       add_hours, add_minutes = separate_decimal_acp(timing)
       add_hours += 1

    elif control_dist_km in control_edge_times and control_dist_km == brevet_dist_km:
      add_hours, add_minutes = control_edge_times[control_dist_km]
    
    else:
      distances = separate_distances(control_dist_km)
      add_hours, add_minutes = timing_calculation(distances, min_speeds) 
    
    time = arrow.get(brevet_start_time)
    end_time = time.shift(hours =+ add_hours, minutes =+ add_minutes)
    return end_time.isoformat()
