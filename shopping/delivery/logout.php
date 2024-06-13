<?php
session_start();
session_destroy();
header('location: ../index.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log out</title>
    <link rel="stylesheet" href="styles.css">
</head>
</html>