<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    // Primary product image
    $image = $_FILES['image']['name'];
    $target_dir = "../site_images/";
    $target_file = $target_dir . basename($image);

    // Additional images
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];
    $image4 = $_FILES['image4']['name'];

    // Move uploaded files to target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert data into the database
        $sql = "INSERT INTO product (product_name, product_price, product_image, product_qty, product_description,
                                     product_image_two, product_image_three, product_image_four) 
                VALUES ('$name', '$price', '$image', '$quantity', '$description', '$image2', '$image3', '$image4')";

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
