<?php
session_start();
require 'check_if_added.php';
require 'connection.php'; // Include your database connection file
require 'func/funcstions.php';
// Fetch products from the database
$user_id = $_SESSION['id'];
check_notifications();

?>
<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<head>
    <title>Smart Selects</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <div>
        <?php require 'header.php'; ?>
        <div class="container filledcont">
            <h2>Orders</h2>
            <p>List of Your Orders</p>
        </div>

        <div class="container filledcont">
            <?php 
    $qry_orders= "SELECT order_id,DATE(order_date) as order_date FROM orders WHERE user_id=$user_id;";
    $res_orders = mysqli_query($con,$qry_orders);
    $numb =mysqli_num_rows($res_orders); 
    
    function disp_ord($res_orders,$con)
    {

        $user_id = $_SESSION['id'];
        $order_idx = 1;
        $item_idx = 1;
        //For Each Order
        while ($row = mysqli_fetch_assoc($res_orders) ) {
            $item_idx = 1;
            $order_id = $row['order_id'];
            $order_date = $row['order_date'];
            //Order Id Display
            echo "<thead class='thead-dark'>
                        <tr class='trm'>
                            <th class='thm'  style='width: 20%'>Order_No: $order_idx</th>
                            <th  class='thm' style='width: 40%'>Order_ID: $order_id</th>
                            <th  class='thm' style='width: 50%'>Date(YYYY-MM-DD): $order_date</th>
                        </tr >
                    </thead>";
            
            echo "<thead class='thead-dark'>
                        <tr class='trm'>
                            <th  class='thm' style='width: 5%'>#</th>
                            <th  class='thm' style='width: 20%'>Item Name</th>
                            <th  class='thm' style='width: 20%'>Unit Price * Qty</th>
                            <th  class='thm' style='width: 15%'>Total</th>
                            <th  class='thm' style='width: 20%'>Vendor Name</th>
                            <th  class='thm' style='width: 20%'>Status</th>
                        </tr >
                    </thead>
                    <tbody>";
                    
            $qry_sel_items = "SELECT ot.qty,ot.status,it.name,it.price,it.vend_id  FROM order_items ot
                             INNER JOIN items it ON it.id=ot.item_id
                             WHERE ot.order_id=$order_id;";        
            $res_item_of_order = mysqli_query($con,$qry_sel_items) or  die(mysqli_error($con));
            $qry_vend_name = "SELECT name FROM users WHERE id=";

            //For Each Item
            while ($row = mysqli_fetch_assoc($res_item_of_order)) {
                $item_name = $row['name'];
                $unit_price = $row['price'];
                $qty = $row['qty'];
                $vend_id = $row['vend_id'];
                $status = $row['status'];
                $total = $unit_price * $qty;
                $qry_for_vend_name = $qry_vend_name.$vend_id.";";
                $res_vend_name = mysqli_query($con,$qry_for_vend_name) or  die(mysqli_error($con));
                $res_vend_name = mysqli_fetch_assoc($res_vend_name);
                $vend_name = $res_vend_name['name'];
                $status = $_SESSION['ord_status_map'][$status];
                echo "<tr class='trm'>
                    <th  class='thm' style='width: 5%'>$item_idx</th>
                    <td class='tdm' style='width: 20%' >$item_name<td>
                    <td class='tdm' style='width: 20%' >$unit_price * $qty<td>
                    <td class='tdm' style='width: 15%' >$total<td>
                    <td class='tdm' style='width: 20%' >$vend_name<td>
                    <td class='tdm' style='width: 20%' >$status<td>
                </tr >";
                $item_idx++;
            }
            $order_idx++;
        echo "<thead class='thead-dark'>
                        <tr class='trm'>
                            <th class='thm'  style='width: 100%'></th>
                        </tr >
                    </thead>";
        }
    }

    $count = 0;
    if($numb <= 0): ?>
            <div class="container filledcont">
                <h3 style="color:red; text-align:center">
                    No Orders Placed !...</h3>
            </div>
            
        <?php else: { ?>
        <div class="container filledcont">
            <center>
                <h2>Displaying All The [<?php echo $numb ?>] Orders</h2>
            </center>
        </div>
        <div class="container filledcont">
            <table class="tablem" style="font-size: 20px;" id="disp_ord">
            
                <?php disp_ord($res_orders,$con); ?>
            </table>
        </div>
        
        <?php }endif; ?>
        </div>


    </div>
</body>

</html>