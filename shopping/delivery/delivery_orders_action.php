<?php
session_start();
require "../connection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['id'];
    if ($_POST['btn'] == 'update') {
        $order_id = $_POST['order_id'];
        $item_id = $_POST['item_id'];
        $upd_status = $_POST['del_status'];
        $qry_check_ord = "SELECT * FROM del_entry 
                        WHERE DATE(DandT) = CURRENT_DATE and order_id = $order_id and item_id = $item_id;";
        $res_check_ord = mysqli_query($con,$qry_check_ord);
        if ($res_check_ord && (mysqli_num_rows($res_check_ord) == 1)) {
            $qry_upd_entry = "UPDATE del_entry 
                                SET status = $upd_status, DandT = CURRENT_TIMESTAMP
                                WHERE order_id = $order_id and item_id = $item_id and Date(DandT) = CURRENT_DATE;";

            $res_entry = mysqli_query($con,$qry_upd_entry);

            if($upd_status == 6)
            {
                $qry_sel = "SELECT * FROM sm_to_del_entry WHERE order_id = $order_id and $item_id = $item_id;";
                $res_sel = mysqli_query($con,$qry_sel);
                $set_status = (mysqli_num_rows($res_sel) >= 3) ? -6 : 6 ;
                $upd_status = $set_status;
            }
            if ($res_entry)
            {
                $qry_upd = "UPDATE order_items SET status= $upd_status WHERE item_id = $item_id and order_id = $order_id";
                $res_upd = mysqli_query($con,$qry_upd);
                echo "bbom".$upd_status.$res_upd;
                if ($res_upd)
                    $_SESSION['notify'] = "Updation Done Successfully !...";
                else
                    $_SESSION['notify'] = "There is Some problem ! Try again Later...";
            }
            else
                $_SESSION['notify'] = "There is Some problem ! Try again Later...";
                
            header("location: delivery_dashboard.php");
        }
        else{
            $_SESSION['notify'] = "Such Entry doesn't exist !..";
        }
    }
    //Call By 
    else
    {
        $arr = $_POST['btn'];
        $arr = explode(" ",$arr);
        $order_id = $arr[0];
        $item_id = $arr[1];
        $upd_status =$arr[2];
    }
    switch ($upd_status) {
        //Successfully Delivered
        case 7:
            $qry_entry = "INSERT INTO del_entry(del_id,order_id,item_id,status)
            VALUES ($id,$order_id,$item_id,7);";
            $res_entry = mysqli_query($con,$qry_entry);
            
            if ($res_entry)
            {
                $qry_upd = "UPDATE order_items SET status= 7 WHERE item_id = $item_id and order_id = $order_id";
                $res_upd = mysqli_query($con,$qry_upd);
                if ($res_upd)
                    $_SESSION['notify'] = "Order Delivered Successfully !...";
                else
                    $_SESSION['notify'] = "There is Some problem ! Try again Later...";
            }
            else
                $_SESSION['notify'] = "There is Some problem ! Try again Later...";
                
            header("location: delivery_dashboard.php");
            
            break;
        
        //Wrong or Damaged Item Recieved
        case -4:
            $qry_entry = "INSERT INTO del_entry(del_id,order_id,item_id,status)
            VALUES ($id,$order_id,$item_id,-4);";
            $res_entry = mysqli_query($con,$qry_entry);
            if ($res_entry)
            {
                $qry_upd = "UPDATE order_items SET status= -4 WHERE item_id = $item_id and order_id = $order_id";
                $res_upd = mysqli_query($con,$qry_upd);
                if ($res_upd)
                    $_SESSION['notify'] = "Vendor Will Again Deliver This item !...";
                else
                    $_SESSION['notify'] = "There is Some problem ! Try again Later...";
            }
            else
                $_SESSION['notify'] = "There is Some problem ! Try again Later...";
            header("location: delivery_dashboard.php");
        
        //Undelivered
        case 6:
            $qry_sel = "SELECT * FROM sm_to_del_entry WHERE order_id = $order_id and $item_id = $item_id;";
            $res_sel = mysqli_query($con,$qry_sel);
            if ($res_sel) {
                $qry_entry = "INSERT INTO del_entry(del_id,order_id,item_id,status)
                VALUES ($id,$order_id,$item_id,6);";
                $res_entry = mysqli_query($con,$qry_entry);
                if ($res_entry)
                {
                    //Check if three atemps completed or not accordingly set status
                    $set_status = (mysqli_num_rows($res_sel) >= 3) ? -6 : 6 ;

                    $qry_upd = "UPDATE order_items SET status= $set_status WHERE item_id = $item_id and order_id = $order_id";
                    $res_upd = mysqli_query($con,$qry_upd);
                    if ($res_upd)
                        $_SESSION['notify'] = "Can't able to deliver This item !...";
                    else
                        $_SESSION['notify'] = "There is Some problem ! Try again Later...";
                }
                else
                    $_SESSION['notify'] = "There is Some problem ! Try again Later...";
                header("location: delivery_dashboard.php");
            }
            else
                $_SESSION['notify'] = "There is Some problem ! Try again Later...";
            
            header("delivery_dashboard.php");
            break;

        default:       
            header("location: delivery_dashboard.php");
            break;
    }
} 
?>