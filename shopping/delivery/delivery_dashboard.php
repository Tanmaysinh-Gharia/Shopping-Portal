<?php
session_start();
require '../connection.php';
require 'delivery_header.php';
require '../func/funcstions.php';
if (!isset($_SESSION['email'])) {
    exit; 
}
$del_id = $_SESSION['id'];
check_notifications(); 
?>

<!DOCTYPE html>
<html>
<body>
    <div class="container">
        <h2><b>Agent Dashboard</b></h2>
        <h3>Welcome,<br>Dear Delivery Agent!</h3>
    </div>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
        <div class="container" style="inline-size: 50%; ">
            <button type="submit" class="btn btn-danger btn-lg btn-block" name="opt" value="1">
                <h3>Orders To Deliver</h3><h4>Today's Goal</h4>
            </button>
        </div>
        <div class="container" style="inline-size: 50%; ">
            <button type="submit" class="btn btn-danger btn-lg btn-block" 
            style="background-color:purple;" name="opt"
            value="2" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">
            <h3>Manual Entry</h3><h4>If mistaken...</h4>
            </button>
            </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "hello";
        switch ($_POST["opt"]) {
            case 1:
                header("location: delivery_orders.php");
                break;
            case 2:
                header("location: delivery_entry.php");
                break;
            case 3:
                header("location: vendor_del_item.php");
                break;
            case 4:
                header("location: vendor_upd_stk.php");
                break;
            case 5:
                header("location: vendor_show.php");
                break;
            case 6:
                header("location: vendor_mod_item.php");
                break;
            case 7:
                header("location: vendor_accept.php");
                break;
            case 8:
                header("location: vendor_dispatch.php");
                break;
            case 9:
                header("location: vendor_damaged.php");
                break;
            default:    
                header("location: vendor_dashboard.php");
                break;
        }
    }
?>

</html>