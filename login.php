<?php
session_start(); 
include("db.php");
//create a variable called $pagename which contains the actual name of the page
$pagename="Login";

//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>".$pagename."</title>";
//include head layout 
include ("headfile.html");

echo "<p></p>";
//display name of the page and some random text
echo "<h2>".$pagename."</h2>";
if($_SESSION['c_userId']){
    echo '<p>Hello, '. $_SESSION['c_userFirstName'][0] .' ' . $_SESSION['c_userLastName'][0] . '<br>
    You are already logged in.</p>';
}else{
    echo '<form id="frmUserLogin" method="post" action="getlogin.php">

        <div>
            <label for="loginUserEmail">Email:</label>
            <input type="email" name="loginUserEmail" id="loginUserEmail" placeholder="Eg: harry.potter@hogwarts.edu">
        </div>

        <div>
            <label for="loginUserPassword">Password:</label>
            <input type="password" name="loginUserPassword" id="loginUserPassword">
        </div>


        <div>
            <input type="submit" value="Login">
            <input type="reset" value="Clear Form">
        </div>

    </form>';
}


//include head layout
include("footfile.html");
?>
