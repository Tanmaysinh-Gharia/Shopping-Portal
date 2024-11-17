<?php
session_start();
require 'check_if_added.php';
require 'connection.php'; // Include your database connection file
require 'func/funcstions.php';

// Fetch products from the database
$select_query = "SELECT * FROM items";
$select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
$i = -1;
check_notifications();
//Needed Prefix for below query
$qry_for_vendor_name = "select * from users where id=";

?>

<!DOCTYPE html>
<html>

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
        <div class="container" style="width: 90%;">
            <div class="jumbotron">
                <h1 style>Welcome to our Smart Selects!</h1>
                <p>We have the best Products for you.<br> No need to hunt around, we have all in one place.</p>
            </div>
        </div>
        <div class="container" style="width: 90%;">
            <?php
                // Loop through each product and display them
                while ($row = mysqli_fetch_assoc($select_query_result)) {
                    $i++;
                    if($i %4 == 0){?>
            <div class="row">
                <?php }?>

                <div class="col-md-3    col-sm-6">
                    <div class="thumbnail">
                        <?php if(!empty($row['image'])): ?>
                        <img style="height: 330px;width: 350px;padding:10px 0 0 0" src="<?php echo $row['image'];?>"
                            alt="<?php echo $row['name']; ?>">
                        <?php else: ?>  
                        <p>No image available</p>
                        <?php endif; ?>
                        <div class="caption" style="padding-left: 20px;margin-top:-7px">
                            <h3><?php echo $row['name']; ?></h3>
                            <?php
                            $vend_name_arr = mysqli_fetch_assoc(mysqli_query($con,$qry_for_vendor_name.$row['vend_id'].";"));
                            ?>
                            <p style="margin:-7px 0 20px 0;" >Vendor: <?php echo $vend_name_arr['name']; ?></p>
                            <h4 style="font-size:20px;">₹ <b> <?php echo $row['price']; ?>/-</b></h4><br>
                            <?php if(!isset($_SESSION['email'])): ?>
                            <p><a href="login.php" role="button" class="btn btn-warning btn-block" style="color: black; font-size:20px;width:80%;margin:auto"><span class="glyphicon glyphicon-shopping-cart"></span>  Add to Cart</a></p>
                            <?php else: ?>
                            <?php if(check_if_added_to_cart($row['id'])): ?>
                            <a href="#" class="btn btn-block btn-success disabled" style="color: black; font-size:20px;width:80%;margin:auto" >Added to cart</a>
                            <?php elseif ($row['stock'] <= 0) : ?>
                            <a href="#" class="btn btn-block btn-secondary disabled" style="color: black; font-size:20px;width:80%;margin:auto" >Out of Stock</a>
                            <?php else: ?>
                            <a href="cart_add.php?id=<?php echo $row['id']; ?>" class="btn btn-block btn-warning" style="color: black; font-size:20px;width:80%;margin:auto" > <span class="glyphicon glyphicon-shopping-cart"></span> Add to cart</a>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php } 
                            if($i %4 == 0) echo "</div>";?>

            </div>
        </div>
    </div>
    </div>
</body>

</html>