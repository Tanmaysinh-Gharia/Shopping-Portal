<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['admin_email'])) {
    exit; 
}

$activePage = basename($_SERVER['PHP_SELF']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    $target_dir = "C:/xampp/htdocs/Practicals/Innovative/shopping2/shopping/img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image."; 
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $target_file = "img/" . basename($_FILES["image"]["name"]);
            $insert_query = "INSERT INTO items (name, price, image) VALUES ('$name', '$price', '$target_file')";
            mysqli_query($con, $insert_query) or die(mysqli_error($con));

            header('location: admin_dashboard.php');
            exit; 
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Item</title>
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
        <h2>Add New Item</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>
            <label>Price:</label><br>
            <input type="number" name="price" required><br><br>
            <label>Image:</label><br>
            <input type="file" name="image" id="image" required><br><br>
            <input type="submit" value="Add Item">
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
