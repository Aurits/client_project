<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'db_connection.php';

    // Collect and sanitize input data
    $title = $conn->real_escape_string($_POST['title']);
    $category_id = $conn->real_escape_string($_POST['category']);
    $content = $conn->real_escape_string($_POST['content']);
    $blog_image = '';

    // Handle image upload
    if (!empty($_FILES['blog_image']['name'])) {
        $target_dir = "../site_images/";
        $blog_image = $target_dir . basename($_FILES["blog_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($blog_image, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["blog_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["blog_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $blog_image)) {
                echo "The file " . htmlspecialchars(basename($_FILES["blog_image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Insert data into blogs table
    $sql = "INSERT INTO BLOGS (TITLE, BLOG_IMAGE, CONTENT, CATEGORY_ID) VALUES ('$title', '$blog_image', '$content', '$category_id')";
    if ($conn->query($sql) === TRUE) {
        echo "New blog post created successfully";
        header('Location: blogs.php'); // Redirect to blog listing page
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
