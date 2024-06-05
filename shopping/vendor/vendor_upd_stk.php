<?php
session_start();
require '../connection.php';
require 'vendor_header.php';

if (!isset($_SESSION['email'])) {
    exit; 
}
$vend_id = $_SESSION['id'];
$currentPage = basename($_SERVER['PHP_SELF']);


?>

<!DOCTYPE html>
<html>

<body>
    <div class="container">
        <h2>Update Stock of an Item</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            enctype="multipart/form-data">
            <label> Enter Item Id:</label>
            <input type="number" name="item_id" required oninput="validateinput(event)"><br><br>
            <input type="submit" value="Enter" name="btn">
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['btn'] == 'Enter' ) {
        $item_id = $_POST['item_id'];
        $_SESSION['item_id'] = $item_id;

        //Find item with corrosponding item_id and vendor_id
        $qry_to_find = "SELECT * FROM items WHERE   vend_id = $vend_id  and id= $item_id;";
        $res = mysqli_query($con,$qry_to_find);
        if(mysqli_num_rows($res)==0)
            echo "<h3>Item doesn't exist in your added items list..</h3>";
        else
        {   
            //Display Image
            $row =mysqli_fetch_assoc($res);
            ?>

<div class="row">
    <divc class="container" >
        <div class="col-md-4    col-sm-6">
            <div class="thumbnail" style="margin-left: 32%;">
                <?php if(!empty($row['image'])): ?>
                <img src="<?php echo "../".$row['image'];?>" alt="<?php echo $row['name']; ?>">
                <?php else: ?>
                <p>No image available</p>
                <?php endif; ?>

                <div class="caption">
                    <h3>Item Name: <?php echo $row['name']; ?></h3>
                    <h3 style="display: inline-block;"> Item_ID:<a id='output'><?php echo $row['id']; ?></a><button
                            style="display: inline-block; margin-left:20px" class="btn btn-primary"
                            onclick="copyText()">Copy_ID</button></h3>
                    <h4>Price: Rs.<b> <?php echo $row['price']; ?>/-</b></h4><br>
                    <h4>Stock(units): <b> <?php echo $row['stock']; ?></b></h4><br>
                </div>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="upd_stk"><h4>Change Stock to:</h4></label>
                    <input min='0' required id ="upd_stk" type="number" value="<?php echo $row['stock']; ?>" 
                    name="upd_stk" class="form-group">
                    <input type="submit" value="Update Stock" name="btn" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php }}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['btn'] == 'Update Stock' )
{
    $item_id = $_SESSION['item_id'];
    $upd_stk = $_POST["upd_stk"];
    $del_qry = "UPDATE items
                SET stock=$upd_stk WHERE id=$item_id";
    $res = mysqli_query($con,$del_qry);
    if(mysqli_affected_rows($con))
    {
        $_SESSION['notify'] = "Stock Updated Successfully !.";
        header("location: vendor_dashboard.php");
    }
    else
    {
        $_SESSION['notify'] = "There is some error in updation !. Try Again....";
        header("location: vendor_upd_stk.php");
    }
}?>

</html>