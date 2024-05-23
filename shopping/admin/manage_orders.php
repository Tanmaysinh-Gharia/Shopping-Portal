<?php
session_start();
require '../connection.php';

// Redirect to login page if admin is not logged in
if (!isset($_SESSION['admin_email'])) {
    // header('location: admin_login.php');
    exit;
}

// Set active page based on current filename
$activePage = basename($_SERVER['PHP_SELF']);

// Fetch orders from the database
$query = "SELECT * FROM users_items";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Show Orders</title>
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
                    <li <?php if ($activePage === 'admin_dashboard.php') echo 'class="active"'; ?>><a href="admin_dashboard.php">Dashboard</a></li>
                    <li <?php if ($activePage === 'add_item.php') echo 'class="active"'; ?>><a href="add_item.php">Add New Item</a></li>
                    <li <?php if ($activePage === 'manage_items.php') echo 'class="active"'; ?>><a href="manage_items.php">Manage Items</a></li>
                    <li <?php if ($activePage === 'manage_orders.php') echo 'class="active"'; ?>><a href="manage_orders.php">Show Orders</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Show Orders</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Item ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['item_id']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
