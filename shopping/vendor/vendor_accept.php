<?php
session_start();
require '../connection.php';
require 'vendor_header.php';
require '../func/funcstions.php';
if (!isset($_SESSION['email'])) {
    exit; 
}
$vend_id = $_SESSION['id'];
$currentPage = basename($_SERVER['PHP_SELF']);
check_notifications();

function disp_apr($con)
{
    $i = 1;
    $vend_id = $_SESSION['id'];
    
    // $qry_sel_cart = "SELECT ut.quantity,it.stock,it.name  FROM users_items ut
    // INNER JOIN items it ON it.id=ut.item_id
    // WHERE ut.user_id=$user_id;";

    $qry_sel_order_id = "SELECT oi.order_id, i.name, i.price, oi.qty, i.id, o.sm_id, o.order_date, 
                                u.name as sm_name, u.state, u.city, u.pincode, u.address,u.contact
                            FROM order_items oi 
                            INNER JOIN items i ON oi.item_id=i.id 
                            INNER JOIN orders o ON oi.order_id = o.order_id
                            INNER JOIN users u ON u.id = o.sm_id
                            WHERE oi.status = 1 and i.vend_id = $vend_id;";
    $res = mysqli_query($con, $qry_sel_order_id);
    $vend_id = $_SESSION['id'];
    while ($row = mysqli_fetch_assoc($res) ) {
        //Order Details
        $oid = $row['order_id'];
        $qty = $row['qty'];
        $item_name = $row['name'];
        $item_price = $row['price'];
        $item_id = $row['id'];
        $order_date = $row['order_date'];
        $total_amt = $item_price * $qty;

        //Shipping Manager Details
        $sm_name = $row['sm_name'];
        $sm_state = $row['state'];
        $sm_city = $row['city'];
        $sm_pincode= $row['pincode'];
        $sm_address = $row['address'];
        $sm_contact = $row['contact'];

        $approval_id = $oid . " ".$item_id. " "."a";
        $discard_id = $oid . " ".$item_id. " "."d";
        
        //Display row
        echo "<tr>";
        echo "<th>$i</th>";
        echo "<td>Order Id: <b>$oid </b><br>
                  Order_date: <b>$order_date</b><br>  
                  Name: <b>$item_name</b><br>  
                  Unit Price: <b>$item_price</b><br>  
                  Qty: <b>$qty</b><br>  
                  Total Amount: <b>$item_price * $qty = $total_amt</b>
                </td>";
        echo "<td>State: <b>$sm_state </b><br>
                  District: <b>$sm_city</b><br>  
                  Pin-code: <b>$sm_pincode</b><br>
                  Address: <b>$sm_address</b><br>
                  Contact: <b>$sm_contact</b><br>
                  Name: <b>$sm_name</b><br>
                </td>";
        echo "<td>
                <button style='padding:20px;font-size:20px;' type='submit' class='btn btn-success' name='btn' value='$approval_id' >Accept</button>
                <button style='padding:20px;font-size:20px;item-align:right;margin-right:-125px;' type='submit'  class='btn btn-danger' name='btn' value='$discard_id'>Discard</button>
                </td>";
        echo "</tr>";
        $i++;
        
    }
    }
?>
<!DOCTYPE html>
<html>

<body>
    <form style="width: 100%;" method='post' action='vendor_accept_action.php'>
    <div class="container">
        <h3>
            Approvals of Orders...
        </h3>
        <br><br>
        <table class="table" style="font-size: 20px;" id="disp_apr">
            <thead class="thead-light">
                <tr>
                    <th scope='col 1'>#</th>
                    <th scope="col 6">Order_details</th>
                    <th scope="col 4">Shipping Details</th>
                    <th scope="col 2">Approval</th>
                </tr>
            </thead>
            <tbody id='disp_apr_body'>
                <?php disp_apr($con); ?>
            </tbody>
        </table>
    </div>
</form>





</body>

</html>

<?php
    
?>
