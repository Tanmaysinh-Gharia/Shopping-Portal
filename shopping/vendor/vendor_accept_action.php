<?php
session_start();
require '../connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['btn'])) {
    $val = $_POST['btn'];
    $arr = explode(" ",$val);
    $order_id = $arr[0];
    $item_id = $arr[1];
    $consent = $arr[2];
    if($consent == "a")
    {
        $qry_to_approve = "UPDATE order_items
        SET status=2 WHERE order_id = $order_id and item_id = $item_id; ";
        $result_to_approve = mysqli_query($con,$qry_to_approve);
        if($result_to_approve)
            $_SESSION['notify'] = "Approved Successfully !..";
        else
            $_SESSION['notify'] = "There is some problem in updation.. Try again later..";
    }
    else
    {
        $qry_to_approve = "UPDATE order_items
        SET status=-2 WHERE order_id = $order_id and item_id = $item_id; ";
        $result_to_approve = mysqli_query($con,$qry_to_approve);
        if($result_to_approve)
            $_SESSION['notify'] ="Discarded Successfully";
        else
            $_SESSION['notify'] = 'There is some problem in updation.. Try again later..';
    }
    header('location: vendor_accept.php');
} 
?>