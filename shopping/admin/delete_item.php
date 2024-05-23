


<?php

session_start();
require '../connection.php';

if (!isset($_SESSION['admin_email'])) {
    header('location: admin_dashboard.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_query = "DELETE FROM items WHERE id=$id";
    mysqli_query($con, $delete_query) or die(mysqli_error($con));

    header('location: manage_items.php');
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Delete_item</title>
    <link rel="stylesheet" href="styles.css">
</head>
</html>
