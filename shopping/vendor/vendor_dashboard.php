<?php
session_start();
require '../connection.php';
require 'vendor_header.php';
require '../func/funcstions.php';

if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
    exit; 
}
check_notifications();
$vend_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <h2><b>Welcome, </b>Dear Vendor!</h2>
    </div>
    <div class="container" style="width: 80%;">
        <form method="post" action="vendor_rdr.php">
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-danger btn-lg btn-block" name="opt" value="9">
                        <h3>Damaged Items to <br>Redeliver</h3>
                    </button>
                </div>
                <div class="col-md-6" >
                    <button type="submit" class="btn btn-danger btn-lg btn-block" style="background-color:purple;"
                        name="opt" value="7" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">
                        <h3>Accept the Orders</h3>
                    </button>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6" >
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="opt" value="8">
                        <h3>Dispatch Orders</h3>
                        <h4>To Shipping Manager</h4>
                    </button>
                </div>
                <div class="col-md-6" >
                    <button type="submit" class="btn btn-warning btn-lg btn-block" name="opt" value="2">
                        <h3>Add an item</h3>
                        <h4>On portal</h4>
                    </button>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6" >
                    <button type="submit" class="btn btn-danger btn-lg btn-block" name="opt" value="3">
                        <h3>Delete an item</h3>
                        <h4>From portal</h4>
                    </button>
                </div>
                <div class="col-md-6" >
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="opt" value="4">
                        <h3>Update stock of an item</h3>
                        <h4>Manually</h4>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" >
                    <button type="submit" class="btn btn-info btn-lg btn-block" name="opt" value="5">
                        <h3>Show all my items</h3>
                    <h4>From the portal</h4>
                </button>
            </div>
            <div class="col-md-6" >
                <button type="submit" class="btn btn-success btn-lg btn-block" name="opt" value="6">
                    <h3>Modify Item Properties</h3>
                    <h4>by Item_id</h4>
                </button>
            </div>
        </div>
        </form>
    </div>

</body>

</html>