# Event-Management-System
This is Php based web application.Only registered users can comment on events and post a request for event. Unregistered users can only view/ browse events and read details about an event. Admin can post and delete any event whereas registered user can only delete his particular event.

****Welcome to Kamrul Events website*****************************************

1. To run this web application, you need to install a localhost server XAMPP (version higher or equal to v3.2.2)

2. Once you have installed XAMPP in your specified location which is in most cases in C drive i.e. "C:/xampp".
-> Extract the folder and place the Kamrul Events folder in htdocs folder of xampp -> "C:\xampp\htdocs\".

3.DB Setup:

In the CharlotteEvents directory, you will find a "DB" folder. In it, events.sql is there.

-> Run XAMPP control panel by starting Apache and SQL ports.
-> Go to browser and type localhost/phpmyadmin/

-> create database events before importing the events.sql file in the database by giving the following command in SQL terminal located on top navigation bar-

	create database `events`;
	
-> Now, click on Import-> Choose file(events.sql)-> Hit Go
-> You can view the 4 tables in your database.


4. Once you have setup your database, type URL "localhost/kamrul/index.php".

5. You can now browse/surf the website.


********ADMIN LOGIN****************

-> Mail ID= admin@admin.com
-> Password= admin


**********CONTRIBUTOR LOGIN***********

-> Signup or if you want to login without registering, following are the test credentials you can use-
user:
	Mail ID= user@user.com
	Password= user
user1:
	Mail ID= user1@user1.com
	Password= user1
user2:
	Mail ID= user2@user2.com
	Password= user2
