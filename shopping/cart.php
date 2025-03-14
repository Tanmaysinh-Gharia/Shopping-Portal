<?php
session_start();
require 'connection.php';
require 'func/funcstions.php';
if (!isset($_SESSION['email'])) {
    header('location: login.php');
}
check_notifications();
$user_id = $_SESSION['id'];
$user_products_query = "SELECT it.id, it.name, it.price, ut.quantity,it.stock
                        FROM users_items ut 
                        INNER JOIN items it ON it.id = ut.item_id 
                        WHERE ut.user_id='$user_id';";
$user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));
$no_of_user_products = mysqli_num_rows($user_products_result);
$sum = 0;

if ($no_of_user_products == 0) {
    ?>
    <script>
        window.alert("No items in the cart!!");
    </script>
<?php
} else {
    while ($row = mysqli_fetch_array($user_products_result)) {
        $sum += $row['price'] * $row['quantity'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="img/soytoy_logo.png"/>
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
    <?php require 'header.php'; ?>
    <br>
    <div class="container">
        <table class="table table-bordered table-striped" style="font-size: 18px;">
            <tbody>
            <tr>
                <th>Item Number</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
            <?php
            $user_products_result = mysqli_query($con, $user_products_query) or die(mysqli_error($con));
            $counter = 1;
            $item_ids= "";
            $vend_ids= "";
            $qtys = "";
            $flg = true;
            while ($row = mysqli_fetch_array($user_products_result)) {
                $curr_id = $row['id'];
                ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td>
                        <?php echo $row['name']; ?>
                        <?php if ($row['stock']<= 0 or $row['quantity'] > $row['stock']):?>
                    <button class='btn btn-danger' style='color:white;'> Out Of Stock | Available:<?php echo $row['stock'];$flg = false; ?></button>
                    <?php endif; ?>
                    </td>
                    <td><?php echo $row['price']; ?></td>
                    <td>
                        <form action="update_quantity.php" method="POST">
                            <input type="hidden" name="item_id" value="<?php echo $curr_id; ?>">
                            <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" max='<?php echo $row['stock'];?>'>
                            <?php if($flg == true): ?>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <?php else: ?>
                            <button type="" class="btn btn-secondary disabled">Update</button>
                            <?php endif; ?>
                        </form>
                    </td>
                    <td><?php echo $row['price'] * $row['quantity']; ?></td>
                    <td><a href='cart_remove.php?id=<?php echo $curr_id; ?>'>Remove</a></td>
                </tr>
                <?php
                $counter++;
                $flg = True;
            }
            ?>
            <tr>
                <td></td>
                <td>Total</td>
                <td></td>
                <td></td>
                <td>Rs <?php echo $sum; ?>/-</td>
                <?php if($counter > 1): ?>
                    <td><a href="success.php" class="btn btn-success">
                        <b>
        Confirm Order</b></a>
        <?php else: ?>
            <td><a href="success.php" class="btn btn-success disabled" >
                <b>
No Items in the Cart</b></a>
            <?php endif;?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <br><br><br><br><br><br><br><br><br><br>
    <footer class="footer">
    <div class="container">
        <div class="text-center">
            <p>&copy; 2024 Smart Selects. All Rights Reserved.</p>
            <p>This website is developed by Tanmaysinh Gharia.</p>
        </div>
    </div>
</footer>
</div>
</body>
</html>
