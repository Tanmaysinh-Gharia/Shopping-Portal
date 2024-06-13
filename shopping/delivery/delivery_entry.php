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
        <h3>
            Manual Entry can only be done for today's tasks...
        </h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3><u>
                                Delivery Information
                            </u></h3>
                    </div>
                    <div class="panel-body">
                        <p style="font-size: 25px;">Enter Details carefully this process is irreversible.</p>
                        <form method="post" action="delivery_orders_action.php">
                            <div class="form-group ">
                                <label for="order_id">Order ID</label>
                                <input type="number" class="form-control" name="order_id" id="order_id"
                                    placeholder="Item ID in numbers" required>
                            </div>
                            <div class="form-group ">
                                <label for="item_id">Item_ID</label>
                                <input type="number" class="form-control" name="item_id" id="item_id"
                                    placeholder="Item ID in numbers" required>
                            </div>

                            <div class="form-group ">
                                <label for="del_status">Update To</label>
                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id = "del_status"
                                required name='del_status'>
                                <option value="" selected disabled hidden>Select Delivery Type</option>
                                <option value="7">1.Successfully delivered</option>
                                <option value="6">2.Can't able to deliver</option>
                                <option value="-4">3.Wrong/Damaged Item</option>
                            </select>
                            </div>
                            
                            <div class="form-group text-right">
                                <input type="submit" style="font-size:20px" name="btn" value="update" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>