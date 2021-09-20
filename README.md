Archive files management system is an MIS developed for Afghanistan government organizations, it has been used for more than 2 years within some government entities. The software is designed and follows Afghanistan government administrative process and procedures. This MIS is in Dari Language. This is a clone of the application created. It is equipped with functionalities such as:
<ul>
    <li>Adding documents </li>
    <li> Editing documents </li>
<li> Attaching pdf files with document </li>
<li>Writing comments on documents by normal users  </li>
<li>Updating and deleting comments </li>
<li>Granting access for normal users to use specific documents </li>
<li>Searching </li>
<li>Activity logging </li>
<li>Notifications </li>
<li>Sending Emails </li>
<li>User registration (Only admin users can register other users) </li>
<li>Updating password </li>
<li>Soft deletes </li>
<li>Downloading function of granted documents has been developed with extra document security </li>
    <li>	4 level of users can use the system </li>
<li> <li>Admin users : has access to all system functionalities </li> </li>
<li> <li>Archive users: has access to all system functionalities except deleting </li> </li>
<li> <li>Viewer users: can only view all parts of the system </li> </li>
    <li> <li>Normal users: can only work with documents granted for them </li> </li>

    <p>How to install: </P>
<ul><li> Download the project and place it within htdocs or your webserver public folder<ul><li>
<li> In your MySQL or other database application import the database provided in install folder (do not use migrations) </li>
<li>Replace the vendor\hekmatinasser\src\Lang\fa.php file with the fa.php file you will find in the install folder of this app  </li>
<li>Login in to the system with the following credentials </li>
    <p>Email: Admin@gmail.com </p>
    <p>Password: admin@123</p>
<li> After logging in you are free to create and test all functionalities of the system by creating new users, adding documents and more.
    Bring necessary changes to .env file. </li>

<p>Note: The original application has been developed with Laravel 5, but we integrated all application functionalities in Laravel 8 </p>
