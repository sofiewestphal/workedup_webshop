<?php
session_start();
//create a variable called $pagename which contains the actual name of the page
$pagename="Customer Registration";

//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>".$pagename."</title>";
//include head layout 
include ("headfile.html");

echo "<p></p>";
//display name of the page and some random text
echo "<h2>".$pagename."</h2>";
echo '<form id="frmUserRegistration" method="post" action="getregister.php">
        <div>
            <label for="inputUserFirstName">Firstname:</label>
            <input type="text" name="userFirstName" id="inputUserFirstName" placeholder="">
        </div>

        <div>
            <label for="inputUserLastName">Lastname:</label>
            <input type="text" name="userLastName" id="inputUserLastName" placeholder="">
        </div>

        <div>
            <label for="inputUserAddress">Address:</label>
            <input type="text" name="userAddress" id="inputUserAddress" placeholder="Eg: 4 Privet Drive">
        </div>

        <div>
            <label for="inputUserPostcode">Postcode:</label>
            <input type="text" name="userPostcode" id="inputUserPostcode" placeholder="Eg: W1W 6EP">
        </div>

        <div>
            <label for="inputUserTelephone">Telephone Number:</label>
            <input type="tel" name="userTelephone" id="inputUserTelephone" placeholder="Eg: 0770 1234567">
        </div>

        <div>
            <label for="inputUserEmail">Email:</label>
            <input type="email" name="userEmail" id="inputUserEmail" placeholder="Eg: harry.potter@hogwarts.edu">
        </div>

        <div>
            <label for="inputUserPassword">Password:</label>
            <input type="password" name="userPassword" id="inputUserPassword">
        </div>

        <div>
            <label for="inputUserConfirmPassword">Confirm Password:</label>
            <input type="password" name="userConfirmPassword" id="inputUserConfirmPassword">
        </div>

        <div>
            <input type="submit" value="Register">
            <input type="reset" value="Clear Form">
        </div>

    </form>';

//include head layout
include("footfile.html");
?>
