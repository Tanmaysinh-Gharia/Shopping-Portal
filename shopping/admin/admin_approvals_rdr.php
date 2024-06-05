<?php
session_start();
require '../connection.php';
require 'admin_header.php';
require '../func/funcstions.php';
if (!isset($_SESSION['email'])) {
    exit; 
}
$currentPage = basename($_SERVER['PHP_SELF']);
$activePage =  $currentPage;
check_notifications();
?>
<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <h3>
            Approvals...
        </h3>
    </div>
    <form method="post" action="admin_approvals.php">
    <div class="container" style="inline-size: 50%; ">
    <button type="submit" class="btn btn-info btn-lg btn-block" name="apr" value="2"><h3>Vendors' Approvals</h3></button>
    </div>
    <div class="container" style="inline-size: 50%; ">
    <button type="submit" class="btn btn-warning btn-lg btn-block"name="apr" value="3"><h3>Shipping Managers' Approvals</h3></button>
    </div>
    <div class="container" style="inline-size: 50%; ">
    <button  type="submit" class="btn btn-success btn-lg btn-block"name="apr" value="4"><h3>Delivery Agents' Approvals</h3></button>
    </div>
</form>


          

</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //No empty fields
    $u_id = $_POST['u_id'];
    $tou = $_POST['type_o_user'];
    $qry = "delete from users where id=$u_id;";
    $res = mysqli_query($con,$qry);
    if($res){
        echo "User having User_ID : ". $u_id . " with type as ".$_SESSION['types']['tou'] ." is <b> deleted Permenantly...</b>.";
        switch ($tou) {
            case 1:
                $query2 = "delete from user_items where user_id=$u_id;";
                mysqli_query($con,$query2);
                break;
                case 2:
                    $query2 = "select id from items where vend_id = $u_id;";
                    $res2 = mysqli_query($con,$query2);
                    $query3 = "delete from items where vend_id = $u_id;"; 
                    mysqli_query($con,$query3);
                    if(mysqli_affected_rows($con))
                    {
                        echo mysqli_affected_rows($con)." Items added by Vendor is also deleted..";
                        $query4 = "delete from user_items where item_id = $u_id;"; 
                        mysqli_query($con,$query4);    
                    }
                    break;
                    default:
                    break;
        }
    }
    else{
        echo "<b>User Not found</b> with user_id: ". $u_id ." and type as ".$_SESSION['types']['tou'];
    }
}
?>
</html>