<?php
session_start();
require '../connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $btn = $_POST['btn'];
    $arr= explode(" ",$btn);
    print_r($arr);
    $uid = $arr[0];
    $action = $arr[1];

    if($action == "a")
    {
        $apr_query = "UPDATE users SET status=1 WHERE id=$uid;";
        $res= mysqli_query($con,$apr_query);
        $_SESSION['notify'] = "Approved | For id: $uid;";
        header("location: admin_approvals_rdr.php");
    }
    else
    {
        $del_query = "DELETE FROM users WHERE id=$uid;";
        $res= mysqli_query($con,$del_query);
        $_SESSION['notify'] = "Deleted | For id: $uid;";
        header("location: admin_approvals_rdr.php");
    }
}
?>