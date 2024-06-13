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

function disp_entry($con)
{
    $i = 1;
    $sm_id = $_SESSION['id'];
    
    // $qry_sel_cart = "SELECT ut.quantity,it.stock,it.name  FROM users_items ut
    // INNER JOIN items it ON it.id=ut.item_id
    // WHERE ut.user_id=$user_id;";

    $qry_sel_order = "SELECT DATE(o.order_date) AS order_date,oi.item_id,o.order_id,i.vend_id
                            FROM orders o 
                            INNER JOIN order_items oi ON oi.order_id=o.order_id 
                            INNER JOIN items i ON i.id = oi.item_id
                            WHERE oi.status = 3 and o.sm_id = $sm_id;";

    $res = mysqli_query($con, $qry_sel_order);

    while ($row = mysqli_fetch_assoc($res) ) {
        //Order Details
        $oid = $row['order_id'];
        $item_id = $row['item_id'];
        $order_date = $row['order_date'];

        //vendor Details
        $vend_id = $row['vend_id'];

        $good_cond_id = $oid . " ".$item_id. " "."g";
        $bad_cond_id = $oid . " ".$item_id. " "."b";
        
        //Display row
        echo "<tr>";
        echo "<th>$i</th>";
        echo "<td>Order Id: <b>$oid </b><br>
                  Order_date: <b>$order_date</b><br>  
                  Item_ID: <b>$item_id</b><br>  
                </td>";
        echo "<td><b>$vend_id </b><br>
                </td>";
        echo "<td>
                <button style='padding:20px;font-size:20px;' type='submit' class='btn btn-success' name='btn' value='$good_cond_id' >Good</button>
                <button style='padding:20px;font-size:20px;item-align:right;margin-right:-125px;' type='submit'  class='btn btn-danger' name='btn' value='$bad_cond_id'>Bad</button>
                </td>";
        echo "</tr>";
        $i++;
    }
    }
?>

<!DOCTYPE html>
<html>

<body>
    <form style="width: 100%;" method='post' action='sm_ship_entry_action.php'>
    <div class="container">
        <h3>
            Entry of Item...
        </h3>
        <br><br>
        <table class="table" style="font-size: 20px;" id="disp_apr">
            <thead class="thead-light">
                <tr>
                    <th scope='col 1'>#</th>
                    <th scope="col 6">Order_details</th>
                    <th scope="col 4">Vendor ID</th>
                    <th scope="col 2">Condition</th>
                </tr>
            </thead>
            <tbody id='disp_entry_body'>
                <?php disp_entry($con); ?>
            </tbody>
        </table>
    </div>
</form>





</body>

</html>
