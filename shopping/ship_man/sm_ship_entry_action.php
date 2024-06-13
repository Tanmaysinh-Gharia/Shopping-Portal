<?php
session_start();
require '../connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['btn'])) {
    $sm_id = $_SESSION['id'];
    $val = $_POST['btn'];
    $arr = explode(" ",$val);
    $order_id = $arr[0];
    $item_id = $arr[1];
    $consent = $arr[2];
    $map_arr = ['g'=>"Good", 'b'=>"Bad"];
    $consent_entry = $map_arr[$consent];
    $qry_insert_entry = "INSERT INTO order_ship(order_id, item_id,sm_id,cond) 
                    VALUES($order_id,$item_id,$sm_id,'$consent_entry');";
    $res = mysqli_query($con,$qry_insert_entry);
    if(! $res){
        $_SESSION['notify'] = "There is some problem in updation.. Try again later..";
        header('location: sm_ship_entry.php');
    }
    if($consent == "g")
    {
        $qry_to_approve = "UPDATE order_items
        SET status=4 WHERE order_id = $order_id and item_id = $item_id; ";
        $result_to_approve = mysqli_query($con,$qry_to_approve);
        if($result_to_approve)
            $_SESSION['notify'] = "Item Recived In good condition !..";
        else
            $_SESSION['notify'] = "There is some problem in updation.. Try again later..";
    }
    if($consent == "b")
    {
        $qry_to_approve = "UPDATE order_items
        SET status=-4 WHERE order_id = $order_id and item_id = $item_id; ";
        $result_to_approve = mysqli_query($con,$qry_to_approve);
        if($result_to_approve)
            $_SESSION['notify'] ="Recived In Bad Condition !..";
        else
            $_SESSION['notify'] = 'There is some problem in updation.. Try again later..';
    }

    header('location: sm_ship_entry.php');
} 
?>