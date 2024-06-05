<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }else{
        $uid=$_SESSION['id'];

        $qry_all_sm_pins = "SELECT id,pincode FROM users WHERE type=3 and status=1;";
        $qry_cust_pin = "SELECT pincode FROM users WHERE id=$uid;";

        $res_user_pin = mysqli_query($con,$qry_cust_pin);
        $cust_pin_assoc = mysqli_fetch_assoc($res_all_pins);

        $first_three_cust = (int)($cust_pin_assoc['pincode']/1000);

        $res_all_pins = mysqli_query($con,$qry_all_sm_pins);
        $sm_id = 0;
        $found = false;
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
        if($found and $sm_id != 0)
        {
            $qry_place_ord= "INSERT INTO orders(order_date,ord_status,user_id,sm_id,amount,itm_ids) 
            VALUES(CURDATE(),1,$uid,$sm_id,);";
        }
        $confirm_query_result=mysqli_query($con,$confirm_query) or die(mysqli_error($con));   
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
            ?>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <p>Your order is confirmed. Thank you for shopping with us. <a href="products.php">Click here</a> to purchase any other item.</p>
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
