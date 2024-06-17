<?php
    session_start();
    require '../connection.php';
    if(!isset($_SESSION['email'])){
        header('location: ../index.php');
    }  
    $old_password= md5($_POST['oldPassword']);
    $new_password= md5($_POST['newPassword']);
    $email=$_SESSION['email'];
    //echo $email;
    $password_from_database_query="select password from users where email='$email'";
    $password_from_database_result=mysqli_query($con,$password_from_database_query) or die(mysqli_error($con));
    $row=mysqli_fetch_assoc($password_from_database_result);
    //echo $row['password'];
    if($row['password']==$old_password){
        $update_password_query="update users set password='$new_password' where email='$email'";
        $update_password_result=mysqli_query($con,$update_password_query) or die(mysqli_error($con));
        $_SESSION['notify'] = "Your password has been updated Successfully !";
        header("location: admin_dashboard.php");
    }else{
        $_SESSION['notify'] = "Entered Wrong Password !";
        header("location: settings.php");
    }
?>