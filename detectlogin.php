<?php
session_start();
//include a db.php file to connect to database
include ("db.php");
//create a variable called $pagename which contains the actual name of the page

//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

if($_SESSION['c_userId']){
    echo '<div class="containerCustomerinfo">
            <p>Name: ' . $_SESSION['c_userFirstName'][0] . ' ' . $_SESSION['c_userLastName'][0] . ' / Customer No: ' . $_SESSION['c_userId'][0] . ' </p>
        </div>';
}
//display window title
//echo "<title>".$pagename."</title>";
//include head layout 
//include ("headfile.html");


//include head layout
//include("footfile.html");
?>
