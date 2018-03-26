<?php
session_start();
//create a variable called $pagename which contains the actual name of the page
include ("db.php");
$pagename="Login Confirmation";

//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>".$pagename."</title>";
//include head layout 
include ("headfile.html");

echo "<p></p>";
//display name of the page and some random text
echo "<h2>".$pagename."</h2>";
$userEmail = $_POST['loginUserEmail'];
$userPassword = $_POST['loginUserPassword'];


if (!(empty($userEmail) || empty($userPassword))) {
        
    $SQL = "SELECT userId, userEmail, userPassword, userFirstName, userLastName FROM users WHERE userEmail ='" . $userEmail . "'";
    $exeSQL = mysql_query($SQL);
    $arrayUser = mysql_fetch_array($exeSQL) or die (mysql_error());

    if($arrayUser['userEmail']){

        if ($arrayUser['userPassword'] == $userPassword) {

            $iCurrentUserId = $arrayUser['userId'];
            $sCurrentUserFirstName = $arrayUser['userFirstName'];
            $sCurrentUserLastName = $arrayUser['userLastName'];
            $_SESSION['c_userId'] = [$iCurrentUserId];
            $_SESSION['c_userFirstName'] = [$sCurrentUserFirstName];
            $_SESSION['c_userLastName'] = [$sCurrentUserLastName];

            echo '<div>
                    <p><b>Hello, ' . $sCurrentUserFirstName . ' ' . $sCurrentUserLastName . '</b> <br>
                    You have succesfully logged into the system! <br>
                    The email you entered is ' . $userEmail . '. <br>
                    The password you entered is a secret.<p>

                    <p>To continue shopping go to the <a href="index.php">product page</a>. <br> 
                    To view your basket go to the <a href="basket.php">basket page</a>. </p>
                </div>';
        } else{
            echo '<div>
                    <p>Sorry, your password is not correct.<br> 
                    Go back to the <a href="login.php">login page</a> and make sure you entered the right password.<p>
                </div>';
        }
    } else {
        echo '<div>
                <p>A Sorry, we do not have a user with that email.<br> 
                Go back to the <a href="login.php">login page</a> and make sure you entered the right email.<p>
            </div>';
    }
}
else{
    echo '<div>
        <p>You need to enter both your email and your password to login <br> 
        Go back to the <a href="login.php">login page</a> and make sure you do so.<p>
    </div>';
} 

//include head layout
include("footfile.html");
?>
