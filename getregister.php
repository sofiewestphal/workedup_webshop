<?php
session_start();
//create a variable called $pagename which contains the actual name of the page
include ("db.php");
$pagename="Registration Confirmation";

//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>".$pagename."</title>";
//include head layout 
include ("headfile.html");

echo "<p></p>";
//display name of the page and some random text
echo "<h2>".$pagename."</h2>";
$userFirstName = $_POST['userFirstName'];
$userLastName = $_POST['userLastName'];
$userAddress = $_POST['userAddress'];
$userPostcode = $_POST['userPostcode'];
$userTelephone = $_POST['userTelephone'];
$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];
$userConfirmPassword = $_POST['userConfirmPassword'];
$reg = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

// echo $userFirstName;
// echo $userLastName;
// echo $userAddress;
// echo $userPostcode;
// echo $userTelephone;
// echo $userEmail;
// echo $userPassword;
// echo $userConfirmPassword;

if (!(empty($userFirstName) || empty($userLastName) || empty($userAddress) || empty($userPostcode) || 
    empty($userTelephone) || empty($userEmail) || empty($userPassword) || empty($userConfirmPassword))) {
        
        if($userConfirmPassword !== $userPassword){
            echo '<div>
                    <p>Sorry, your passwords do not match... <br> 
                    Go back to the <a href="register.php">registration page</a> and make sure you enter the same password.<p>
                </div>';
        } else if(preg_match($reg, $userEmail)){
            echo '<div>
                    <p>Sorry, your email does not seem to be in the right format.<br> 
                    Go back to the <a href="register.php">registration page</a> and make sure to enter an email address.<p>
                </div>';
        }
        else {
            $SQL = "INSERT INTO users (userFirstName, userLastName, userAddress, userPostcode, userTelephone, userEmail, userPassword)
            VALUES('".$userFirstName."', '".$userLastName."', '".$userAddress."', '".$userPostcode."', '".$userTelephone."', '".$userEmail."', '".$userPassword."');";

            $exeSQL = mysql_query($SQL);

            if(mysql_errno() !== 0 ){
                if (mysql_errno() == 1062) {
                    echo '<div>
                            <p>A user already exist with this email <br> Go to the <a href="login.php">login page</a> to login.<p>
                        </div>';
                } else{
                    echo '<div>
                            <p>Sorry, an error occured.. <br> Go back to the <a href="register.php">registration page</a> and try to register again.<p>
                        </div>';
                }
            } else {
                echo '<div>
                        <p>Yay you are now a member of WorkedUp <br> Go to the <a href="login.php">login page</a> to login.<p>
                    </div>';
            }
        }
        
    }else{
        echo '<div>
            <p>At least one of the fields in the form was empty... <br> Go back to the <a href="register.php">registration page</a> and make sure you fill out all the fields in the form.<p>
        </div>';
    } 

//include head layout
include("footfile.html");
?>
