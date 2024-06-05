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
    <style>
        label{
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
<body>
    <div class="container">
        <h2>Update an Item</h2>
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
            echo "<h3 style='color:red; text-align:center;'>Item doesn't exist in your added items list with Item_ID as $item_id.</h3>";
        else
        {   
            //Display Image
            $row =mysqli_fetch_assoc($res);
            ?>

<div class="row">
    <divc class="container" style="margin-left: center;">
        <div class="col-md-9    col-sm-6">
            <div class="thumbnail" style="margin-left: 42%;">
                <h2>Modify an Item</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="contact"> Item_ID </label>
                        <input readonly type="text" class="form-control" 
                        name='item_id' value = "<?php echo $_SESSION['item_id']; ?>">
                    </div>
                    <div class="form-group" >
                        <label>Item Name:</label>
                        <input type="text" class = "form-control" name="name" 
                        value="<?php echo $row['name']; ?>" >
                    </div>
                    <div class="form-group" >
                        <label>Price:</label>
                        <input min = '1' type="number" class = "form-control" name="price" 
                        value="<?php echo $row['price']; ?>">
                    </div>
                    <div class="form-group" >
                        <label>Stock (which is available deliver):</label>
                        <input min = '0' type="number" class = "form-control" name="stock" 
                        value="<?php echo $row['stock']; ?>">
                    </div>
                    <div class="form-group" >
                        <label>Image*:</label>
                        <input type="file" class = "form-control" name="image" required >
                    </div>
                    <input name = "btn"class="btn btn-success" style="margin-left: 40%; font-size:20px;" type="submit" value="Modify">
                </form>
            </div>
            <?php }}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['btn'] == 'Modify' )
{
    $item_id = $_SESSION['item_id'];
    $sel_qry = "SELECT * FROM items WHERE id=$item_id";
    //Removing Previous Image file
    $res = mysqli_fetch_assoc(mysqli_query($con,$sel_qry));
    
    unlink("../".$res['image']);
    $del_qry = "DELETE FROM items WHERE id=$item_id";

    //Adding New item on that id
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $stock = mysqli_real_escape_string($con, $_POST['stock']);
        $id = $_SESSION["id"];
        //Moving File 
        $target_dir = "C:/xampp/htdocs/Practicals/Innovative/shopping2/shopping/img/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $target_file = $target_dir . $name."_".$id .".". $imageFileType;
        $check = getimagesize($_FILES["image"]["tmp_name"]);
    
        if ($check === false) {
            echo "File is not an image."; 
            $uploadOk = 0;
        }
        if ($uploadOk == 1) {
            //File stored in the format of: itemname_vendid.filetype(jpg/png/jpeg/l.w.)
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $target_file = "img/" . $name ."_".$id .".". $imageFileType ;
                
                //Entering file location into database
                $mod_query = "UPDATE items 
                SET name='$name', price =$price , image='$target_file',
                vend_id= $id,stock = $stock
                WHERE id= $item_id";
                mysqli_query($con, $mod_query) or die(mysqli_error($con));
                $_SESSION['notify'] = "Item has been Modified Successfully !";
                header('location: vendor_dashboard.php');
                // exit; 
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    

}?>

</html>