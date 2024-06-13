<?php
session_start();
require '../connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['btn'])) {
    $sm_id = $_SESSION['id'];
    $lots_map = $_SESSION['lots_map'];
    $agent_ass_map = $_SESSION['agent_ass_map'];

    //Maximum Orders can be delivered by Agent 
    $maxi_ass = 14;
    $_SESSION['notify'] = '';
    foreach ($lots_map as $pincode => $arr_ord_item) {
        if (isset($_POST[$pincode]) and $_POST[$pincode] != null) {
            $agent_id_ent = $_POST[$pincode];
            if (array_key_exists($agent_id_ent,$agent_ass_map)) {
                //Agent Found
                $agent_id = $agent_id_ent;
                $agent_capacity = $maxi_ass - $agent_ass_map[$agent_id] ;
                if ($agent_capacity > 0 and count($arr_ord_item) > 0) {
                    //Agent has capacity to deliver orders
                    while ($agent_capacity > 0) {
                        $first = $arr_ord_item[0];
                        $order_id = $first[0];
                        $item_id = $first[1];                    
                        $qry_to_ass = "INSERT INTO sm_to_del_entry(sm_id,del_id,order_id,item_id) 
                        VALUES ($sm_id,$agent_id,$order_id,$item_id);";
                        // $qry_upd_status = "UPDATE order_items SET status=6 WHERE order_id=$order_id and item_id = $item_id;";
                        // $res_upd = mysqli_query($con,$qry_upd_status); 
                        $res = mysqli_query($con,$qry_to_ass);
                        if ($res ) {$_SESSION['notify'] .= "Successfully assigned to $agent_id.<br>";
                        array_shift($arr_ord_item);
                        $agent_capacity--;
                        if (count($arr_ord_item) == 0) {
                            //Removing key on null orders
                            unset($arr_ord_item[$pincode]);
                            break;
                        }
                    }
                    else{
                        $_SESSION['notify'] = "There are some error right now ! Try again later ....<br>";
                        header('location: sm_assign.php');
                    }
                }
            }
        }   
    }}
    header('location: sm_assign.php');
}
?>