<?php
require 'connection.php';  // Include the database connection file
session_start();

// Now you can use $con for database operations

$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";

// Validate email
if (!preg_match($regex_email, $email)) {
    echo "Incorrect email. Redirecting you back to registration page...";
    ?>
    <meta http-equiv="refresh" content="2;url=signup.php" />
    <?php
    exit(); // Stop script execution after redirect
}

$password = md5(md5(mysqli_real_escape_string($con, $_POST['password'])));

// Validate password length
if (strlen($password) < 6) {
    echo "Password should have at least 6 characters. Redirecting you back to registration page...";
    ?>
    <meta http-equiv="refresh" content="2;url=signup.php" />
    <?php
    exit(); // Stop script execution after redirect
}

$contact = $_POST['contact'];
$city = mysqli_real_escape_string($con, $_POST['city']);
$address = mysqli_real_escape_string($con, $_POST['address']);

$duplicate_user_query = "SELECT id FROM users WHERE email='$email'";
$duplicate_user_result = mysqli_query($con, $duplicate_user_query) or die(mysqli_error($con));
$rows_fetched = mysqli_num_rows($duplicate_user_result);

if ($rows_fetched > 0) {
    // Duplicate email
    ?>
    <script>
        window.alert("Email already exists in our database!");
    </script>
    <meta http-equiv="refresh" content="1;url=signup.php" />
    <?php
    exit(); // Stop script execution after redirect
} else {
    // Insert new user
    $user_registration_query = "INSERT INTO users(name, email, password, contact, city, address) 
                               VALUES ('$name', '$email', '$password', '$contact', '$city', '$address')";
    $user_registration_result = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
    echo "User successfully registered";
    $_SESSION['email'] = $email;
    $_SESSION['id'] = mysqli_insert_id($con);

    ?>
    <meta http-equiv="refresh" content="3;url=products.php" />
    <?php
}
?>
