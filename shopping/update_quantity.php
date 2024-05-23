<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id']) && isset($_POST['quantity'])) {
    $item_id = $_POST['item_id'];
    $new_quantity = $_POST['quantity'];

    // Update the quantity for the item in the users_items table
    $update_query = "UPDATE users_items SET quantity = $new_quantity WHERE item_id = $item_id";
    mysqli_query($con, $update_query) or die(mysqli_error($con));

    header('location: cart.php'); // Redirect back to the cart page
} else {
    header('location: products.php'); // Redirect if POST data is not set
}
?>
