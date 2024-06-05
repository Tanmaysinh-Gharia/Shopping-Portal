<?php
session_start();

    require 'connection.php';
    
    if ($_SESSION["captcha_code"] != $_POST["captcha_code"])
    {
        //Invalid Captcha
        $_SESSION["captcha_inv"] = true;
        $_SESSION['notify'] = "Captcha Invalid";
    }   
    $email = $_POST['email'];
    $_SESSION["email"] = $email;

    // // echo $email . "and ". $password_admin;
    $type_o_user = $_POST['type_o_user'];
    $name = $_POST['name'];
    $pass = md5($_POST['pass']);
    $contact = $_POST['contact'];
    $country = "India";
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pin = $_POST['pins'];
    $address = $_POST['address'];
    $type_o_user = $_POST['type_o_user'];
    $check_query = "SELECT * FROM users WHERE email='$email';";
    //Duplicate Email address registration
    if(mysqli_num_rows(mysqli_query($con,$check_query)) > 0){
        $_SESSION['notify']= "E-mail Address already assigned!";
        header('location: sign_up.php');
    }
    if($type_o_user == 1)
    $insert_query="INSERT INTO users(name,email,password,contact,state,city,pincode,address,type,status)
                    VALUES ('$name','$email','$pass',$contact,'$state','$city',$pin,'$address',1,1);";
    else
    $insert_query="INSERT INTO users(name,email,password,contact,state,city,pincode,address,type,status)
                    VALUES ('$name','$email','$pass',$contact,'$state','$city',$pin,'$address',$type_o_user,0);";
    mysqli_query($con,$insert_query);
    if(mysqli_affected_rows($con))
        $_SESSION["notify"] = "New User Created Successfully !";
    else
    $_SESSION["notify"] = "There is some issue to create new user. Try again after some time !";
    if($type_o_user!= 1)
    $_SESSION['notify'] = "If Your Senior will accept your profile, Then only you will be Assigned a role on the portal...";
    header('location: login.php');
 ?>