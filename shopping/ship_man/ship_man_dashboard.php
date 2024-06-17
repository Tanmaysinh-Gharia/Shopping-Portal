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
    
?>
    <div class="container" style="height:80%">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-md-6" >
                <button type="submit" class="btn btn-danger btn-lg btn-block" 
                style="background-color:purple;" name="opt"
                    value="1" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">
                    <h3>Shipping Entry</h3>
                    <span class="badge badge-light" style="font-size: 20px;"></span>
                </button>
            </div>
            <div class="col-md-6" >
                <button type="submit" class="btn btn-danger btn-lg btn-block" name="opt" value="2">
                    <h3>Mark Item as Damaged</h3>
                    <h4>(Implicitly Send to vendor)</h4>
                </button>
            </div>
        </div>
        <div class="row">
        <div class="col-md-6" >
            <button type="submit" class="btn btn-warning btn-lg btn-block" name="opt" value="3">
                <h3>Assign Items to </h3>
                <h4>Delivery Agents</h4>
            </button>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary btn-lg btn-block" name="opt" value="4">
                <h3>Stick User Address Badge</h3>
                <h4>With User_ID</h4>
            </button>
        </div>
        </div>
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        switch ($_POST["opt"]) {
            case 1:
                header("location: sm_ship_entry.php");
                break;
            case 2:
                header("location: sm_damaged.php");
                break;
            case 3:
                header("location: sm_assign.php");
                break;
            case 4:
                header("location: sm_stick.php");
                break;
            default:    
                header("location: ship_man_dashboard.php");
                break;
        }
    }
?>

</html>