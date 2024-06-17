<?php
session_start();
require '../connection.php';
require 'admin_header.php';

if (!isset($_SESSION['email'])) {
    header("location: ../index.php"); 
}

$currentPage = basename($_SERVER['PHP_SELF']);

$activePage =  $currentPage;

?>

<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Welcome to the admin dashboard!</p>
    </div>
    <form method="post" action="admin_rdr.php">
        <div class="container" style="width: 70%; height:70%">
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-danger btn-lg btn-block" name="opt" value="1">
                        <h3><b>Remove a User</b></h3>
                        <h4></h4>
                    </button>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-info btn-lg btn-block" style="background-color:turquoise;"
                    name="opt" value="2" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">
                    <h3><b>Trace an Order</b></h3></button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="opt" value="3">
                        <h3><b>Approvals</b></h3>
                        <h4>Vendor/ Delivery agent/ Shipping Manager</h4>
                    </button>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-danger btn-lg btn-block" style="background-color:purple;"
                        name="opt" value="4" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">
                            
                    <h3><b>Analysis of Portal</b></h3>
                    <h4>( Statistics )</h4>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>