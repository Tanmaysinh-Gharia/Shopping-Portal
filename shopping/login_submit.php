<?php
session_start();

    require 'connection.php';
    
    if ($_SESSION["captcha_code"] != $_POST["captcha_code"])
    {
        //Invalid Captcha
        $_SESSION["captcha_inv"] = true;
    }   

    //Password Format check
    $password=md5($_POST['password']);

    $email = $_POST['email'];
    // // echo $email . "and ". $password_admin;
    $authentication_query="SELECT id,type,status FROM users WHERE email='$email' and password='$password'";
    $authentication_result=mysqli_query($con,$authentication_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($authentication_result);

    if ($rows_fetched == 0) 
    {
        //no user
        //redirecting to same login page
        $_SESSION['notify']= "Wrong Username or Password !";
        header("location: login.php"); 
    }
    else{
        //Only single user with specific email and password;
        $row=mysqli_fetch_array($authentication_result);
        //login according to type of users
        $_SESSION["email"] = $email;
        $_SESSION['id']=$row['id'];  //user id
        if($row['status'])
        {
            switch ($row['type']) {
                case 1:
                    //Customer
                    header('location: products.php');
                    break;
                case 2:
                    //Vendor 
                    header('location: vendor/vendor_dashboard.php');
                    break;
                
                case 3:
                    //Shipping Manager
                    header('location: ship_man/ship_man_dashboard.php');
                    break;
                case 5:
                    header('location: admin/admin_dashboard.php');
                    break;    
    
                    default:
                        header('location: login.php');
                    break;
            }
        }
        else{
            $_SESSION['notify'] = 'Under Waiting Process...Once Admin will select Your application then only you are assigned a role.';
            header("location: login.php");
        }
    }

    
 ?>