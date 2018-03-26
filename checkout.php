<?php
session_start();
//include a db.php file to connect to database
include ("db.php");
//create a variable called $pagename which contains the actual name of the page
$pagename="Checkout Confirmation";

//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>".$pagename."</title>";
//include head layout 
include ("headfile.html");
//include detect login
include("detectlogin.php");

//display name of the page and some random text
echo "<h2>".$pagename."</h2>";

//if the session array basket excists the user has something in hers/his basket.
//if this is the case we want to display the content of the basket to the user.
if(isset($_SESSION['basket']) && $_GET['bProceedToCheckout']){
    //This variable calculates the total price of the basket
    $iCounterTotal = 0.00;
    $dOrderDate = date('Y-m-d H:i:s');
    $iCurrentUserId = $_SESSION['c_userId'][0];
    $SQLInsertOrder = "INSERT INTO orders(userId, orderDateTime, orderTotal) VALUES ('" . $iCurrentUserId . "', '" . $dOrderDate . "', '" . $iCounterTotal . "')";
    $exeSQLInserOrder = mysql_query($SQLInsertOrder);

    if(mysql_errno() !== 0 ){
        echo "<p>Your order has not been placed.</p>";
    }else{
        $iCurrentOrderNo;
        //SQL query to retrieve max order number for current user (for which id matches the id in session)
        //i.e retrieve the order number of most recent order placed by current user
        $SQLretrieveOrderNo = "SELECT MAX(orderNo) AS orderNo FROM orders WHERE userId =" . $iCurrentUserId;
        //execute SQL query
        $exeSQLretrieveOrderNo = mysql_query($SQLretrieveOrderNo) or die (mysql_error());
        //fetch the result of the execution of the SQL statement and store it in an array
        $resultSQLretrieveOrderNo = mysql_fetch_array($exeSQLretrieveOrderNo);
        //store the value of this order number in a variable
        $iCurrentOrderNo = $resultSQLretrieveOrderNo['orderNo'];
        //display message to confirm that order has been placed successfully and display the order number.
        echo "<p>Your order has been placed succesfully. Your order number is: " . $iCurrentOrderNo ."</p>";
        echo '<table style="width:100%">
        <tr>
            <th>Name</th>
            <th>Price</th> 
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>';

        //the foreach construct iterates over the array splitting each index - value pair into the two variables
        //$index and $value
        foreach ($_SESSION['basket'] as $index => $value) {
            //This SQL query selects the product name and price from the product table for the current product
            //(the where clause ensures that we only get one product as the prodId is unique (PK))
            $SQL = "SELECT prodName, prodPrice FROM product WHERE prodId =" . $index;
            //This PHP function executes the SQL query
            $exeSQL = mysql_query($SQL) or die (mysql_error());
            //This PHP function fetches the result of the execution of the SQL query and saves it in an array.
            //in this case the array only holds information about one product at a time.
            $arrayprod=mysql_fetch_array($exeSQL);

            //I add the price of each product to the variable calculating the total
            $iCurrentSubTotal = $arrayprod['prodPrice'] * $value;
            $iCounterTotal+= $iCurrentSubTotal;

            //SQL query to store details of ordered items in order_line table i.e. order number, 
		    //product id (index), ordered quantity (content of the session array) and subtotal
            $SQLInsertOrderLine = "INSERT INTO order_line(orderNo, prodId, quantityOrdered, subTotal) 
            VALUES ('" . $iCurrentOrderNo . "', '" . $index . "', '" . $value . "', '" . $iCurrentSubTotal . "')";
            $exeSQLInserOrderLine = mysql_query($SQLInsertOrderLine) or die (mysql_error());

            //I show the product in the basket and adds a form with a remove button.
            //the form information is sent to this page if the delete button is pressed and will trigger
            //the code on line 39 - 47
            echo '<tr>
                    <td>'.$arrayprod['prodName'].'</td>
                    <td>'.$arrayprod['prodPrice'].'</td> 
                    <td>'.$value.'</td>
                    <td>'.$arrayprod['prodPrice']*$value.'</td>
                </tr>';
        }

        echo '<tr>
                <td>Total</td>
                <td></td> 
                <td></td>
                <td>'.$iCounterTotal.'</td>
            </tr>
        </table>';

        //SQL update query to update the total value in the order table for this specific order
        $SQLUpdateOrderTotal = "UPDATE orders SET orderTotal =" . $iCounterTotal . " WHERE orderNo =" . $iCurrentOrderNo;
        //execute SQL query and display logout link.
        $exeSQLUpdateOrderTotal = mysql_query($SQLUpdateOrderTotal) or die (mysql_error());
        //display logout link
        echo '<p>To logout and leave the system <a href="logout.php">Logout</a></p>';
        //Unset the basket session array
        unset($_SESSION['basket']);
    }
}else{
    echo "<p>Your order has not been placed.</p>";
}

//include head layout
include("footfile.html");
?>
