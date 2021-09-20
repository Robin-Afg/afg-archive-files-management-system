Archive files management system is an MIS developed for Afghanistan government organizations, it has been used for more than 2 years within some government entities. The software is designed and follows Afghanistan government administrative process and procedures. This MIS is in Dari Language. This is a clone of the application created. It is equipped with functionalities such as:
•	Adding documents
•	Editing documents
•	Attaching pdf files with document
•	Writing comments on documents by normal users 
•	Updating and deleting comments
•	Granting access for normal users to use specific documents
•	Searching
•	Activity logging
•	Notifications
•	Sending Emails
•	User registration (Only admin users can register other users)
•	Updating password
•	Soft deletes
•	Downloading function of granted documents has been developed with extra document security
•	4 level of users can use the system
o	Admin users : has access to all system functionalities
o	Archive users: has access to all system functionalities except deleting
o	Viewer users: can only view all parts of the system
o	Normal users: can only work with documents granted for them

How to install: 
•	Download the project and place it within htdocs or your webserver public folder
•	In your MySQL or other database application import the database provided in install folder (do not use migrations)
•	Replace the vendor\hekmatinasser\src\Lang\fa.php file with the fa.php file you will find in the install folder of this app 
•	Login in to the system with the following credentials
o	Email: Admin@gmail.com
o	Password: admin@123
•	After logging in you are free to create and test all functionalities of the system by creating new users, adding documents and more.
Bring necessary changes to .env file. 

Note: The original application has been developed with Laravel 5, but we integrated all application functionalities in Laravel 8
