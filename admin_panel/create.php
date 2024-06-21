<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    // Array to store uploaded file names
    $uploaded_files = array();

    // Handle primary image upload
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $image = $_FILES["image"]['name'];
        $target_dir = "../site_images/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $uploaded_files[] = $image;
        } else {
            echo "Error: There was an error uploading your primary image file. Please try again.<br>";
        }
    }

    // Handle additional images upload (image2, image3, image4)
    for ($i = 2; $i <= 4; $i++) {
        $file_name = "image$i";
        if ($_FILES[$file_name]["error"] == UPLOAD_ERR_OK) {
            $image = $_FILES[$file_name]['name'];
            $target_file = $target_dir . basename($image);

            if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
                $uploaded_files[] = $image;
            } else {
                echo "Error: There was an error uploading $file_name. Please try again.<br>";
            }
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO product (product_name, product_price, product_description, product_qty,
                                 product_image, product_image_two, product_image_three, product_image_four) 
            VALUES ('$name', '$price', '$description', '$quantity',
                    '" . $uploaded_files[0] . "', '" . $uploaded_files[1] . "', '" . $uploaded_files[2] . "', '" . $uploaded_files[3] . "')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to stock page if insertion is successful
        header("Location: stock.php");
        exit();
    } else {
        // Database insertion failed, display error message
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
