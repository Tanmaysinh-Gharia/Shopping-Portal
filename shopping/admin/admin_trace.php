<?php
session_start();
require '../connection.php';
require 'admin_header.php';

if (!isset($_SESSION['email'])) {
    exit; 
}
function disp_order($con)
{
            $order_id = $_SESSION['order_id'];
            $ord_status_map = $_SESSION['ord_status_map'];
            //Trace an order with order Id
            $qry_for_ord = "SELECT u.name as user_name, u.contact as user_contact, u.id as user_id, #user details
                us.name as ship_name, us.contact as ship_contact, us.pincode as ship_pincode,us.id as ship_id, #ship manager details
                DATE_FORMAT(o.order_date, '%d-%m-%Y %H:%i:%s') AS placed_date
                FROM orders o 
                INNER JOIN users u ON u.id = o.user_id
                INNER JOIN users us on us.id = o.sm_id
                WHERE o.order_id = $order_id";
            $res_for_ord = mysqli_query($con,$qry_for_ord);
            $row_for_ord = mysqli_fetch_assoc($res_for_ord);

            if(mysqli_num_rows($res_for_ord)==0)
            {
                echo "<h3 style='color:red; text-align:center;'>Such Type of order doesn't exist in database, with Order_ID as $order_id.</h3>";
                return;
            }
        else  //Display Order
        {
            //Common order details
            //User details
            $user_name = $row_for_ord['user_name'];
            $user_contact = $row_for_ord['user_contact'];
            $user_id = $row_for_ord['user_id'];

            //Ship manager details
            $ship_name = $row_for_ord['ship_name']; 
            $ship_contact = $row_for_ord['ship_contact'];
            $ship_pincode = $row_for_ord['ship_pincode'];
            $ship_id = $row_for_ord['ship_id'];

            //Order details
            $placed_date = $row_for_ord['placed_date'];
            ?>
<div class="container">
<table class="table tabel-hover" style="font-size: 20px;" id="disp_apr">
    <thead>
        <tr>
            <th scope="col 4">
                <h3>
                <b><u>Order Info:</u></b></h3>
                Order ID: <?= $order_id; ?><br>
                Placed At: <?= $placed_date; ?>
            </th>
            <th scope="col 4">
                <h3><b><u>User Info:</u></b></h3>
                User ID: <?= $user_id ?><br>
                User Name: <?= $user_name ?><br>
                Contact No.: <?= $user_contact?><br>
            </th>
            <th scope="col 4">
                <h3><b><u>Shipping Manager Details:</u></b> </h3>
                Ship. man. ID: <?= $ship_id ?><br>
                User Name: <?= $ship_name ?><br>
                Contact No.: <?= $ship_contact?><br>
                Pin-Code.: <?= $ship_pincode?><br>
            </th>
        </tr>
    </thead>
</table></div>
<!-- <div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col6"></div>
    </div>
</div> -->

<div class="container">
<?php
            //Individual Items
            $qry_for_items 
            = "SELECT i.name as item_name, i.price, #item prices
                uv.name as vend_name, uv.contact as vend_contact,uv.id as vend_id, #vendor Details
                oi.item_id, oi.status, oi.qty #item details
                FROM order_items oi  
                INNER JOIN items i ON i.id = oi.item_id
                INNER JOIN users uv on uv.id= i.vend_id
                WHERE oi.order_id = $order_id";
            
            $res = mysqli_query($con, $qry_for_items);
            
            
            $item_number = 1;
            while ($row =mysqli_fetch_assoc($res)) {
                
                
                //Item Details
                $item_id = $row['item_id'];
                $item_name = $row['item_name'];
                $status = $row['status'];
                $status = $ord_status_map[$status];
                $qty = $row['qty'];
                $price = $row['price'];
                $total = $qty * $price;
                
                //Vendor Details
                $vend_name= $row['vend_name'];
                $vend_id = $row['vend_id'];
                $vend_contact = $row['vend_contact'];

                $qry_for_det 
                = "(SELECT DATE_FORMAT(DandT, '%d-%m-%Y %H:%i:%s') AS DandT,cond as ship_cond,sm_id,NULL as del_id,NULL as del_status FROM order_ship WHERE  order_id = $order_id and item_id = $item_id)
                UNION ALL
                (SELECT DATE_FORMAT(DandT, '%d-%m-%Y %H:%i:%s') AS DandT,NULL as ship_cond, sm_id,del_id,NULL as del_status  FROM sm_to_del_entry WHERE  order_id = $order_id and item_id = $item_id)
                UNION ALL
                (SELECT DATE_FORMAT(DandT, '%d-%m-%Y %H:%i:%s') AS DandT,NULL as ship_cond, NULL as sm_id,del_id,status as del_status  FROM del_entry WHERE  order_id = $order_id and item_id = $item_id)
                ORDER BY DandT ASC;
                ";
                $res_det = mysqli_query($con, $qry_for_det);
                $str2 = "";
                while ($entry = mysqli_fetch_assoc($res_det)) {
                    $DandT = $entry['DandT'];
                    $arrDate = explode(" ",$DandT);
                    $date = $arrDate[0];
                    $time = $arrDate[1];
                    $ship_cond = $entry['ship_cond'];
                    $sm_id = $entry['sm_id'];
                    $del_id = $entry['del_id'];
                    $del_status = $entry['del_status'];
                    if ($del_status) {
                        $del_status= $ord_status_map[$del_status];
                    }

                    if ($ship_cond)
                    {
                        $str2 
                        .="<b>Shipped</b> <br>
                        SM ID: $sm_id<br>
                        Condition: $ship_cond<br>
                        Date: $date<br>
                        Time: $time<br>
                        Status: $status<br>";
                    }
                    elseif ($del_status == null) {
                        $str2 
                        .="<b>Assigned For Delivery </b><br>
                        SM ID: $sm_id<br>
                        DEL ID: $del_id<br>
                        Date: $date<br>
                        Time: $time<br>
                        Status: $status<br>";
                    }
                    elseif ($del_status) {
                        
                        $str2 
                        .="<b>Delivery</b> <br>
                        DEL ID: $del_id<br>
                        Date: $date<br>
                        Time: $time<br>
                        Status: $del_status<br>";
                    }
                    $str2 .="<br><br>";
                }?>

<div class="row g">
    <div class="col-md-5">
        <h3><?= $item_number?>) <u>Item Details:<br></u></h3>
        Item ID: <?= $item_id ?> <br>
        Item Name: <?= $item_name ?><br>
        Qty: <?= $qty ?><br>
        Price: <?= $price ?><br>
        Total: <?= $total ?><br>
        <br>
        Vendor ID: <?= $vend_id ?><br>
        Vendor Name: <?= $vend_name?><br>
        Vendor Contact: <?= $vend_contact?><br>
    </div>
    <div class="col-md-7">
        <?php echo ( $str2 ) ? $str2 : "<a style='color:red; font-size:25px'>Vendor Didn't accepted Yet !.</a>" ?>
    </div>
</div>
<hr >

<?php
$item_number++;} ?></div><?php 
        }
}
?>

<!DOCTYPE html>
<html>
<style>
label {
    font-size: 18px;
    margin-bottom: 10px;
}
</style>

<body>
    <div class="container">
        <h2>Trace an Order</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            enctype="multipart/form-data">
            <label> Order Id:</label>
            <input type="number" name="order_id" required oninput="validateinput(event)"
                placeholder="Please Enter The Order ID"><br><br>
            <input type="submit" value="Enter" name="btn">
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['btn'] == 'Enter' ) {
        $order_id = $_POST['order_id'];
        $_SESSION['order_id'] = $order_id;
        disp_order($con);
    }
            ?>


</html>