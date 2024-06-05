<?php
session_start();
require '../connection.php';
require 'vendor_header.php';

if (!isset($_SESSION['email'])) {
    exit; 
}


    $id = $_SESSION["id"];
    //Moving File 
    $qry_select_all_items = "SELECT * FROM items WHERE vend_id = $id;" ;
    $res_select_all_items = mysqli_query($con,$qry_select_all_items);
?>
<!DOCTYPE html>
<html>
    <script>
    function copyText() {
        const outputElement = document.getElementById('output');
        const textToCopy = outputElement.innerText;
    
        // Create a temporary textarea element
        const tempTextarea = document.createElement('textarea');
        tempTextarea.value = textToCopy;
        document.body.appendChild(tempTextarea);
    
        // Select the text
        tempTextarea.select();
        tempTextarea.setSelectionRange(0, 99999); // For mobile devices
    
        // Copy the text
        document.execCommand('copy');
    
        // Remove the temporary textarea element
        document.body.removeChild(tempTextarea);
        
        // Alert the user (optional)
        alert('Text copied to clipboard!');
    }
    </script>

<head>
    <title>Show All Items</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="container">
        <?php 
        $numb =mysqli_num_rows($res_select_all_items); 
        if($numb <= 0): ?>
            <div class="container"><h3 style="color:red; text-align:center"> No Items Present corrosponding to your vend_id !...</h3></div>
        <?php else: { ?>
            <div class="container">
                <center>
                    <h2>Displaying All The [<?php echo $numb ?>]  Items</h2>
                </center>
            </div>
        <div class="row">
            <?php while($row =mysqli_fetch_assoc($res_select_all_items) )
                    { ?>
            <div class="col-md-3    col-sm-6">

                <div class="thumbnail">
                    <?php if(!empty($row['image'])): ?>
                    <img src="<?php echo "../".$row['image'];?>" alt="<?php echo $row['name']; ?>">
                    <?php else: ?>
                    <p>No image available</p>
                    <?php endif; ?>

                    <div class="caption">
                        <h3 >Item Name: <?php echo $row['name']; ?></h3>
                        <h3 style="display: inline-block;"> Item_ID:<a id ='output' ><?php echo $row['id']; ?></a><button
                                style="display: inline-block; margin-left:20px" class="btn btn-primary"
                                onclick="copyText()">Copy_ID</button></h3>
                        <h4>Price: Rs.<b> <?php echo $row['price']; ?>/-</b></h4>                                   
                    <h4>Stock(units): <b> <?php echo $row['stock']; ?></b></h4><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }}?>
    <?php endif; ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>