<?php
session_start();
require '../connection.php';
require 'delivery_header.php';
require '../func/funcstions.php';
if (!isset($_SESSION['email'])) {
    exit; 
}
$del_id = $_SESSION['id'];
check_notifications(); 

function disp_orders($con){
    $del_id = $_SESSION['id'];

    $qry_sel_order_id = "SELECT sd.order_id, sd.item_id,oi.qty,o.order_date, u.name, u.state, u.city, u.pincode, u.address,u.contact,sd.DandT,
                                i.name as item_name,i.price,i.image
                            FROM sm_to_del_entry sd 
                            INNER JOIN order_items oi ON oi.order_id=sd.order_id and oi.item_id = sd.item_id
                            INNER JOIN orders o ON oi.order_id = o.order_id
                            INNER JOIN items i ON i.id = sd.item_id
                            INNER JOIN users u ON u.id = o.user_id
                            LEFT JOIN del_entry de ON de.item_id = sd.item_id and de.order_id = sd.order_id and DATE(de.DandT) = CURRENT_DATE
                            WHERE oi.status=5 and sd.del_id = $del_id and DATE(sd.DandT)= CURDATE() and de.order_id is null";
    $res = mysqli_query($con, $qry_sel_order_id);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res) ) {
        //Order Details
        $oid = $row['order_id'];
        $qty = $row['qty'];
        $item_name = $row['item_name'];
        $item_price = $row['price'];
        $item_id = $row['item_id'];
        $order_date = $row['order_date'];
        $total_amt = $item_price * $qty;
        $img = $row['image'];
        $img = "../" . $img;
        //User Details
        $u_name = $row['name'];
        $u_contact = $row['contact'];
        
        //Address
        $u_state = $row['state'];
        $u_city = $row['city'];
        $u_pincode= $row['pincode'];
        $u_address = $row['address'];


        $delivered_id = $oid . " ".$item_id. " "."7";
        $wrong_id = $oid . " ".$item_id. " "."-4";
        $undelivered_id = $oid . " ".$item_id. " "."6";
        
        //Display row
        echo "<tr>";
        //col1
        echo "<th>$i</th>";

        //col2
        echo "<td>";
        if (!empty($img)) 
            echo "<img style='height: 200px;width: 200px;' src='$img' alt='$item_name'>";
        else
            echo "<p>No image available</p>";
        echo "</td>";

        //col3
        echo "<td>Order Id: <b>$oid </b><br>
                  Item Id: <b>$item_id</b><br>  
                  Order_date: <b>$order_date</b><br>  
                  Name: <b>$item_name</b><br>  
                  Unit Price: <b>$item_price</b><br>  
                  Qty: <b>$qty</b><br>  
                  Total Amount: <b>$item_price * $qty = $total_amt</b>
                </td>";

        //col4
        echo "<td>
                <b><u>User Details</u></b><br>    
                  User Name: <b>$u_name</b><br>
                  Contact: <b>$u_contact</b><br><br>
                  <b><u>Address Details</u></b><br>    
                  State: <b>$u_state </b><br>
                  District: <b>$u_city</b><br>  
                  Pin-code: <b>$u_pincode</b><br>
                  Address: <b>$u_address</b><br>
                </td>";
        //col5
        echo "<td>
                <button style='margin:0 0 10% 28%; padding:15px;font-size:20px;' type='submit' class='btn btn-success' name='btn' value='$delivered_id' >Delivered</button><br>
                <button style='margin:0 0 10% 18%;padding:15px;font-size:20px;item-align:right;margin-right:-125px;' type='submit'  class='btn btn-danger' name='btn' value='$wrong_id'>Wrong/Damaged</button><br>
                <button style='margin:0 0 10% 25%;padding:15px;font-size:20px;item-align:right;margin-right:-125px;' type='submit'  class='btn btn-info' name='btn' value='$undelivered_id'>Undelivered</button>
                </td>";
        echo "</tr>";
        $i++;
        
    }
}
?>
<!DOCTYPE html>
<html>

<body>
    <form style="width: 100%;" method='post' action='delivery_orders_action.php'>
    <div class="container">
        <h2>
           <b>Confirmations of the Orders...</b>
        </h2>
        <br><br>
        <table class="table" style="font-size: 20px;" id="disp_apr">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="col-12 col-md-1">#</th>
                    <th scope="col" class="col-12 col-md-2">Item Image</th>
                    <th scope="col" class="col-12 col-md-3">Order Details</th>
                    <th scope="col" class="col-12 col-md-2">User's Info</th>
                    <th scope="col" class="col-12 col-md-2">Status</th>
                </tr>
            </thead>
            <tbody id='disp_apr_body'>
                <?php disp_orders($con); ?>
            </tbody>
        </table>
    </div>
</form>





</body>

</html>

<?php
    
?>
