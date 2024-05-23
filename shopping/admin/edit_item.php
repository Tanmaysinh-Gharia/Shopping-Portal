<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['admin_email'])) {
    // header('location: admin_login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    $update_query = "UPDATE items SET name='$name', price='$price' WHERE id=$id";
    mysqli_query($con, $update_query) or die(mysqli_error($con));

    header('location: manage_items.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM items WHERE id=$id";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Item</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label>Price:</label><br>
        <input type="number" name="price" value="<?php echo $row['price']; ?>" required><br><br>
        <input type="submit" value="Update Item">
    </form>
</body>
</html>
