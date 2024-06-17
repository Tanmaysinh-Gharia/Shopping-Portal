<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }else{
        $user_id=$_SESSION['id'];

        //Stock Check
        $qry_sel_cart = "SELECT ut.quantity,it.stock,it.name  FROM users_items ut
                        INNER JOIN items it ON it.id=ut.item_id
                        WHERE ut.user_id=$user_id;";
        $res_sel_cart = mysqli_query($con,$qry_sel_cart);
        $flg_stk = true;
        while($row = mysqli_fetch_assoc($res_sel_cart))
        {
            $qty = $row['quantity'];
            $stock = $row['stock'];
            if (($stock - $qty) < 0) {
                //Unavailability of Stock
                $name = $row['name'];
                $_SESSION['notify'] .= "$name is Out of the stock: Required Quantity is not available in the stock !";
                $flg_stk = false;
                header("location: cart.php");
                break;
            }

        }

        if($flg_stk)
        {   
            //Stock is available
            //Now
            //Delivery availibility Check
            $qry_all_sm_pins = "SELECT id,pincode FROM users WHERE type=3 and status=1;";
            $qry_cust_pin = "SELECT pincode FROM users WHERE id=$user_id;";

            $res_user_pin = mysqli_query($con,$qry_cust_pin);
            $res_all_pins = mysqli_query($con,$qry_all_sm_pins);
            
            
            $cust_pin_assoc = mysqli_fetch_assoc($res_user_pin);
            $first_three_cust = (int)($cust_pin_assoc['pincode']/1000);
            $sm_id = 0;
            $found = false;
            
            //Checking with all shipping manager's pincode
            while($pin = mysqli_fetch_assoc($res_all_pins))
            {   
                $first_three_sm = (int)($pin['pincode']/1000);
                
                if($first_three_cust == $first_three_sm)
                {
                    $sm_id= $pin['id'];
                    $found = true;
                    break;
                }
            }
            if($found)
            {

                //Shipping Manager Found
                
                //Updating orders
                $qry_place_ord= "INSERT INTO orders(order_date,user_id,sm_id) 
                VALUES(CURDATE(),$user_id,$sm_id);";
                $confirm_query_result=mysqli_query($con,$qry_place_ord) or die(mysqli_error($con));
                $order_id = mysqli_insert_id($con);
                
                
                //Updating order_items
                $qry_sel_only_cart = "SELECT item_id,quantity FROM users_items WHERE user_id = $user_id;";
                $res_sel_only=mysqli_query($con,$qry_sel_only_cart) or die(mysqli_error($con));
                $numb_rows= mysqli_num_rows($res_sel_cart);
                //Problem Check
                while ($row = mysqli_fetch_assoc($res_sel_only)) {
                    $item_id = $row['item_id'];
                    $qty = $row['quantity'];
                    $qry_insert_order_items = "INSERT INTO order_items(order_id,item_id,qty) VALUES ($order_id,$item_id, $qty);";
                    $confirm_query_result=mysqli_query($con,$qry_insert_order_items) or die(mysqli_error($con));
                }

                //Decrimenting Stock
                $qry_update_stock = "UPDATE items AS it
                                    INNER JOIN users_items AS ut ON it.id = ut.item_id
                                    SET it.stock = it.stock - ut.quantity
                                    WHERE ut.user_id = $user_id;";

                $dec_stk = mysqli_query($con,$qry_update_stock) or  die(mysqli_error($con));
                
                $_SESSION['notify'] = 'Order has been placed Successfully ! You can checkout under order Section.... ';
            }
            else {
                //No Shipping Manager Found
                $_SESSION['notify'] = "Delivery is not available in Your Area.UserID: $user_id";
            }
            header("location: cart.php");
        }
        }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Smart Selects</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jquery library -->
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <div>
        <?php
            require 'header.php';
           ?><div class="dummy_header">
           </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <p>Your order is confirmed. Thank you for shopping with us. <br>You can check out your order Status in orders section <a href="products.php">Click
                                    here</a> to purchase any other item.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <center>
                    <p>&copy; 2024 Smart Selects. All Rights Reserved.</p>
                    <p>This website is developed Vaibhav, Kirtan, Tanmay.</p>
                </center>
            </div>
        </footer>
    </div>
</body>

</html>