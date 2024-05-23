<?php
// Check if form is submitted
if (isset($_POST["submit"])) {
    // Check if file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/"; // Directory where you want to store uploaded images
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
        } else {
            // Move uploaded file to the specified directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No image selected or an error occurred during upload.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>upload</title>
    <link rel="stylesheet" href="styles.css">
</head>
</html>