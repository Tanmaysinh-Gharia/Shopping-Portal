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
?>
<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <h3>
            Removing User...
        </h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3><u>
                                User Information
                            </u></h3>
                    </div>
                    <div class="panel-body">
                        <p style="font-size: 25px;">Enter Details carefully this process is irreversible.</p>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                            <div class="form-group ">
                                <label for="u_id">User_ID</label>
                                <input type="number" class="form-control" name="u_id" id="u_id"
                                    placeholder="User ID in numbers" required>
                            </div>

                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                required name='type_o_user'>
                                <option value="" selected disabled hidden>Select User Type</option>
                                <option value="1">1.Customer</option>
                                <option value="2">2.Vendor</option>
                                <option value="3">3.Shipping Manager</option>
                                <option value="4">4.Delivery Agent</option>
                            </select>
                            <div class="form-group text-right">
                                <input type="submit" style="font-size:20px" value="Remove" class="btn btn-primary">
                            </div>
                        </form>
                        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //No empty fields
            $u_id = $_POST['u_id'];
            $tou = $_POST['type_o_user'];
            $qry = "delete from users where id=$u_id;";
            $res = mysqli_query($con,$qry);
            if($res)
            {
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>