<?php
session_start();
require '../connection.php';
require 'ship_man_header.php';

if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
    exit; 
}
if (isset($_SESSION["notify"]))
{
    ?>
    <script>alert("<?php echo $_SESSION['notify']; ?>");</script>
    <?php
    unset($_SESSION['notify']);
}
$uid = $_SESSION['id'];
$currentPage = basename($_SERVER['PHP_SELF']);


?>

<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <h3>Welcome,<br>Dear Shipping Manager!</h3>
    </div>
    <?php 
        $qry = "SELECT * FROM orders where ord_status=1 and uend_id = $uid;";
        $res = mysqli_query($con,$qry);
        $orders = mysqli_num_rows($res);
?>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
        <div class="container" style="inline-size: 50%; ">
            <button type="submit" class="btn btn-danger btn-lg btn-block" 
            style="background-color:purple;" name="opt"
                value="1" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">
                <h3>Shipping Entry</h3>
                <span class="badge badge-light" style="font-size: 20px;"><?php echo $orders ?></span>
            </button>
        </div>
        <div class="container" style="inline-size: 50%; ">
            <button type="submit" class="btn btn-warning btn-lg btn-block" name="opt" value="2">
                <h3>Add an item</h3>
                <h4>On portal</h4>
            </button>
        </div>
        <div class="container" style="inline-size: 50%; ">
            <button type="submit" class="btn btn-danger btn-lg btn-block" name="opt" value="3">
                <h3>Delete an item</h3>
                <h4>From portal</h4>
            </button>
        </div>
        <div class="container" style="inline-size: 50%; ">
            <button type="submit" class="btn btn-primary btn-lg btn-block" name="opt" value="4">
                <h3>Update stock of an item</h3>
                <h4>Manually</h4>
            </button>
        </div>
        <div class="container" style="inline-size: 50%; ">
            <button type="submit" class="btn btn-info btn-lg btn-block" name="opt" value="5">
                <h3>Show all my items</h3>
                <h4>From the portal</h4>
            </button>
        </div>
        <div class="container" style="inline-size: 50%; ">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="opt" value="6">
                <h3>Modify Item Properties</h3>
                <h4>by Item_id</h4>
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
                header("location: vendor_del.php");
                break;
            case 2:
                header("location: vendor_add_item.php");
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
            default:    
                header("location: vendor_dashboard.php");
                break;
        }
    }
?>

</html>