<?php
session_start();
//include a db.php file to connect to database
include ("db.php");
//create a variable called $pagename which contains the actual name of the page
$pagename="Log out";
//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>".$pagename."</title>";
//include head layout 
include ("headfile.html");

//display name of the page and some text
echo "<h2>".$pagename."</h2>";
unset($_SESSION['basket']);
unset($_SESSION['c_userId']);
unset($_SESSION['c_userFirstName']);
unset($_SESSION['c_userLastName']);
session_destroy();
echo'<p>You are now logged out</p>';
//include head layout
include ("footfile.html");
?>
