<?php
session_start();
require '../connection.php';
require 'admin_header.php';

if (!isset($_SESSION['email'])) {
    header("location: ../index.php"); 
}

$currentPage = basename($_SERVER['PHP_SELF']);

$activePage =  $currentPage;

?>

<!DOCTYPE html>
<html>

<body>
<div class="container">
    <h2>Admin Dashboard</h2>
    <p>Welcome to the admin dashboard!</p>
</div>
<form method="post" action="admin_rdr.php">
    <div class="container" style="inline-size: 50%; ">
    <button type="submit" class="btn btn-danger btn-lg btn-block" name="opt" value="1"><h3>Remove</h3><h4>Vendor/ User/ Delivery agent/ Shipping Manager</h4></button>
    </div>
    <div class="container" style="inline-size: 50%; ">
    <button type="submit" class="btn btn-warning btn-lg btn-block"name="opt" value="2">Block level button</button>
    </div>
    <div class="container" style="inline-size: 50%; ">
    <button  type="submit" class="btn btn-primary btn-lg btn-block"name="opt" value="3"><h3>Approvals</h3><h4>Vendor/ Delivery agent/ Shipping Manager</h4></button>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>
