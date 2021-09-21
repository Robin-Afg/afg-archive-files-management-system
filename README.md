<h3 style="text-center;" >Archive files management system for Afghanistan </h3>
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
    <li>	4 level of users can use the system 
        <ul>
            <li> Admin users : has access to all system functionalities </li>
            <li> Archive users: has access to all system functionalities except deleting </li>
            <li> Viewer users: can only view all parts of the system </li> 
            <li> Normal users: can only work with documents granted for them </li> 
        </ul>
    </li>
</ul>
    <p>How to install: </P>
<ul>
    <li> Download the project and place it within htdocs or your webserver public folder </li>
    <li> In your MySQL or other database application import the database provided in install folder (do not use migrations) </li>
    <li> In your command line Run " composer Install "</li>
    <li>Replace the vendor\hekmatinasser\src\Lang\fa.php file with the fa.php file you will find in the install folder of this app  </li>
    <li>Login in to the system with the following credentials 
        <ul>
            <li>Email: Admin@gmail.com </li>
            <li>Password: admin@123</li>
        </ul>
    </li>
<li> After logging in you are free to create and test all functionalities of the system by creating new users, adding documents and more.
    Bring necessary changes to .env file. </li>
</ul>

<p>Note: The original application has been developed with Laravel 5, but we integrated all application functionalities in Laravel 8 </p>




![login](https://user-images.githubusercontent.com/89167574/134092148-787f3634-6184-470e-bb5f-d012400cd76a.png)

![dashboard](https://user-images.githubusercontent.com/89167574/134092150-4ee5b7b6-9001-4e61-a2b4-bcb161131c3d.png)

![Sadera](https://user-images.githubusercontent.com/89167574/134092159-0feca0e6-0bde-4d57-aec5-70efa642040f.png)

![activity_log](https://user-images.githubusercontent.com/89167574/134092165-6736611c-0c90-4800-92f0-62326e066e29.png)





