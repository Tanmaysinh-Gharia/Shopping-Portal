<?php
session_start();
require '../connection.php';


if (!isset($_SESSION['admin_email'])) {
    exit; 
}

$currentPage = basename($_SERVER['PHP_SELF']);

$activePage = ($currentPage !== 'admin_dashboard.php') ? 'admin_dashboard.php' : $currentPage;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: white;">Welcome, Admin!</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <li <?php if ($activePage === 'add_item.php' || $activePage === 'admin_dashboard.php') echo 'class="active"'; ?>><a href="add_item.php">Add New Item</a></li>
    <li <?php if ($activePage === 'manage_items.php' || $activePage === 'admin_dashboard.php') echo 'class="active"'; ?>><a href="manage_items.php">Manage Items</a></li>
    <li <?php if ($activePage === 'manage_orders.php' || $activePage === 'admin_dashboard.php') echo 'class="active"'; ?>><a href="manage_orders.php">Show Orders</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2>Admin Dashboard</h2>
    <p>Welcome to the admin dashboard!</p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>
