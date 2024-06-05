<?php
session_start();
require '../connection.php';

if(isset($_SESSION['email'])){
    header('location: admin_dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $admin_password = mysqli_real_escape_string($con, $_POST['admin_password']);

    $query = "SELECT * FROM admins WHERE email='$email' AND password='$admin_password'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $_SESSION['email'] = $email;
        header('location: admin_dashboard.php');
    } else {
        echo "<script>alert('Invalid credentials. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Admin Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="admin_password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
