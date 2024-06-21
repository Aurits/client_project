<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    $image = $_FILES['image']['name'];
    // Append directory prefix to image name
    $image = "Edited/" . $image;
    $target_dir = "../Edited/";
    $target_file = $target_dir . basename($image);

    // Check if the file was uploaded successfully
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // File uploaded successfully, proceed with database insertion
        $sql = "INSERT INTO product (product_name, product_price, product_image, product_qty, product_description) 
                VALUES ('$name', '$price', '$image', '$quantity', '$description')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to stock page if insertion is successful
            header("Location: stock.php");
            exit(); // Ensure script termination after redirection
        } else {
            // Database insertion failed, display error message
            echo "Error: Unable to insert data into the database. Please try again later.";
        }
    } else {
        // File upload failed, display error message
        echo "Error: There was an error uploading your file. Please try again.";
    }
}

mysqli_close($conn);
