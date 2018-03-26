<?php
session_start();

//include a db.php file to connect to database
include ("db.php");
//create a variable called $pagename which contains the actual name of the page
$pagename="Ordering Basket";


//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>".$pagename."</title>";
//include head layout 
include ("headfile.html");

//$sCurrentProd = "[".$newprodid.",".$reququantity."]";
//$aCurrentProd= $sCurrentProd
include ("detectlogin.php");
//display name of the page and some random text
echo "<h2>".$pagename."</h2>";

if(isset($_POST['h_prodid'])){
    $newprodid = $_POST['h_prodid'];
    $reququantity = $_POST['prodQuantity'];
    
    $_SESSION['basket'][$newprodid]=$reququantity;

    echo '<p>Your basket has been updated</p>';
}

if($_POST['h_deleteProdid']){
    $deleteProdId = $_POST['h_deleteProdid'];
    unset($_SESSION['basket'][$deleteProdId]);
}


if(isset($_SESSION['basket'])){
    $iCounterTotal;
    echo '<table style="width:100%">
            <tr>
                <th>Name</th>
                <th>Price</th> 
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
            </tr>';
  
    foreach ($_SESSION['basket'] as $index => $value) {
        $SQL = "SELECT prodName, prodPrice FROM product WHERE prodId =" . $index;
        $exeSQL = mysql_query($SQL) or die (mysql_error());
        $arrayprod=mysql_fetch_array($exeSQL);

        $iCounterTotal+=$arrayprod['prodPrice']*$value;

        echo '<tr>
                <td>'.$arrayprod['prodName'].'</td>
                <td>'.$arrayprod['prodPrice'].'</td> 
                <td>'.$value.'</td>
                <td>'.$arrayprod['prodPrice']*$value.'</td>
                <td>
                    <form action=basket.php method=post>
                    <input type=submit value="Remove">
                    <input type=hidden name=h_deleteProdid value='.$index.'>
                    </form>
                </td>
            </tr>';
    }
    
    echo '<tr>
            <td>Total</td>
            <td></td> 
            <td></td>
            <td>'.$iCounterTotal.'</td>
        </tr>
    </table>';

    if($_SESSION['c_userId']){
        $proceedToCheckout = true;
        echo '<div>
            <p>To finalise your order <a href="checkout.php?bProceedToCheckout=' . $proceedToCheckout . '">Checkout</a></p>
        </div>';
    }else{
        echo '<div>
            <p><a href="login.php">Login</a> if you are already a WorkedUp member.</p>
            <p><a href="register.php">Register</a> if you are not a WorkedUp member yet.</p>
        </div>';
    }
}else{
    echo '<p>Your basket is empty</p>';
}



//include head layout
include("footfile.html");
?>
