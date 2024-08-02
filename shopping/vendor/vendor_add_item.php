<?php
session_start();
require '../connection.php';
require 'vendor_header.php';

if (!isset($_SESSION['email'])) {
    exit; 
}

//After submitting the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);
    $id = $_SESSION["id"];
    //Moving File 
    $target_dir = "../img/";
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
            $insert_query = "INSERT INTO items (name, price, image,vend_id,stock) 
            VALUES ('$name', $price, '$target_file',$id,$stock)";
            mysqli_query($con, $insert_query) or die(mysqli_error($con));
            $_SESSION['notify'] = "Item has been Added Successfully !";
            header('location: vendor_dashboard.php');
            // exit; 
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Item</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    

    <div class="container">
        <h2>Add New Item</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <label>Item Name:</label>
            <input type="text" name="name" required ><br><br>
            <label>Price:</label>
            <input type="number" name="price" required><br><br>
            <label>Stock (which available deliver):</label>
            <input type="number" name="stock" required><br><br>
            <label>Image:</label>
            <input type="file" name="image" id="image" required><br><br>
            <input type="submit" value="Add Item">
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
