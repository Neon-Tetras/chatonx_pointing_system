# chatonx_pointing_system
ChatonX pointing system

Check all users and their conversations and award points

    http://localhost/chatonx/points/view_conversations.php

    The above url should be private, scheduled and called once a day to do the above action. 
    This can be scheduled and called using cronJobs

Get user points
    http://localhost/chatonx/points/get_user_points.php?user_id=6

    returns a JsonArray of the format

    {"user_id":"6","point":2.09361,"created":{"date":"2018-03-20 12:06:45.000000","timezone_type":3,"timezone":"Europe\/Berlin"},"last_updated":{"date":"2018-03-29 19:11:58.000000","timezone_type":3,"timezone":"Europe\/Berlin"}}
	
	Other point scripts
	
	AssignPoints.php : To award point to a single user
	
	available_points_update.php : allows admin to update the total points available in system
	
	Rainfall.php: handles the distribution of points to all users

	transfer_points.php : Handle point transfer between two users
	usage: http://localhost/chatonx/points/transfer_points.php?u_id=6&r_id=11&point=0.002
