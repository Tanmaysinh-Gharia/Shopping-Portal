<?php
    require 'connection.php';
    session_start();
    if ($_SESSION["captcha_code"] != $_POST["captcha_code"])
    {
        header("location: login.php"); 
        $_SESSION["captcha_inv"] = true;
    }
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email)){
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }
    $password_admin = mysqli_real_escape_string($con,$_POST['password']);
    $password=md5(md5(mysqli_real_escape_string($con,$_POST['password'])));
    if(strlen($password)<6){
        echo "Password should have atleast 6 characters. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" /> 
        <?php
    }
    $_SESSION["admin_email"] = $email;
    echo $email . "and ". $password_admin;
    $admin_authentication_query="SELECT id,email FROM admins WHERE email='$email' and password='$password_admin'";
    $admin_authentication_result=mysqli_query($con,$admin_authentication_query) or die(mysqli_error($con));
    $rows_fetched_admin=mysqli_num_rows($admin_authentication_result);
    
    // echo $rows_fetched_admin."top";
    // echo $rows_fetched_user;
    if ($rows_fetched_admin == 0)
    {
        $user_authentication_query="select id,email from users where email='$email' and password='$password'";
        $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
        $rows_fetched_user=mysqli_num_rows($user_authentication_result);
    if($rows_fetched_user==0 ){
        //no user
        //redirecting to same login page
        ?>
        <script>
            window.alert("Wrong username or password");
        </script>
        <meta http-equiv="refresh" content="1;url=login.php" />
        <?php
        //header('location: login');
        //echo "Wrong email or password.";
    }else{
        $row=mysqli_fetch_array($user_authentication_result);
        $_SESSION['email']=$email;
        $_SESSION['id']=$row['id'];  //user id
        header('location: products.php');
    }
}
else
{
    $row_admin=mysqli_fetch_array($admin_authentication_result);
    $_SESSION['email']=$email;
    $_SESSION['id']=$row['id'];  //user id
    header('location: admin/admin_dashboard.php');
}
    
 ?>