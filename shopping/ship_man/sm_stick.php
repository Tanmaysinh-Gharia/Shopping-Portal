<?php
session_start();
require '../connection.php';
require 'ship_man_header.php';
require '../func/funcstions.php';
if (!isset($_SESSION['email'])) {
    exit; 
}
$sm_id = $_SESSION['id'];
$currentPage = basename($_SERVER['PHP_SELF']);
check_notifications();

function disp_stick($con)
{
    $i = 1;
    $sm_id = $_SESSION['id'];
    
    // $qry_sel_cart = "SELECT ut.quantity,it.stock,it.name  FROM users_items ut
    // INNER JOIN items it ON it.id=ut.item_id
    // WHERE ut.user_id=$user_id;";

    $qry_sel_order = "SELECT DATE(o.order_date) AS order_date,oi.item_id,o.order_id,u.state,u.city,u.pincode,u.address,o.user_id
                            FROM orders o 
                            INNER JOIN order_items oi ON oi.order_id=o.order_id 
                            INNER JOIN users u ON u.id = o.user_id
                            WHERE oi.status = 4 and o.sm_id = $sm_id;";

    $res = mysqli_query($con, $qry_sel_order);

    while ($row = mysqli_fetch_assoc($res) ) {
        //Order Details
        $oid = $row['order_id'];
        $item_id = $row['item_id'];
        $order_date = $row['order_date'];

        //Sticker Details
        $user_id = $row['user_id'];
        $user_state = $row['state'];
        $user_city = $row['city'];
        $user_pincode = $row['pincode'];
        $user_address = $row['address'];

        //Sticked?
        $stick_id = $oid . " ".$item_id. " "."s";
        
        
        //Display row
        echo "<tr>";
        echo "<th>$i</th>";
        echo "<td>Order Id: <b>$oid </b><br>
                  Order_date: <b>$order_date</b><br>  
                  Item_ID: <b>$item_id</b><br>  
                  </td>";
        echo "<td><b>User_ID:$user_id </b><br>
                  State: <b>$user_state</b><br>  
                  City: <b>$user_city</b><br>  
                  Pincode: <b>$user_pincode</b><br>  
                  Address: <b>$user_address</b><br>  
                  </td>";
        echo "<td>
                <button style='padding:20px;font-size:20px;' type='submit' class='btn btn-success' name='btn' value='$stick_id' >Sticked</button>
                </td>";
        echo "</tr>";
        $i++;
    }
    }
?>

<!DOCTYPE html>
<html>

<body>
    <form style="width: 100%;" method='post' action='sm_stick_action.php'>
    <div class="container">
        <h2><u>Stick Address Details of User on the item </u></h2>
        <h3>
            User_id...<br>
            State...<br>
            City...<br>
            Pincode...<br>
            Address...<br>
        </h3>
        <br><br>
        <table class="table" style="font-size: 20px;" id="disp_apr">
            <thead class="thead-light">
                <tr>
                    <th scope='col 1'>#</th>
                    <th scope="col 6">Order_details</th>
                    <th scope="col 4"> Information</th>
                    <th scope="col 2">Sticked?</th>
                </tr>
            </thead>
            <tbody id='disp_entry_body'>
                <?php disp_stick($con); ?>
            </tbody>
        </table>
    </div>
</form>





</body>

</html>
