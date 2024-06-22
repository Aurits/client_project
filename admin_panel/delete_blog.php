<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $blogId = intval($_GET['id']);

    // SQL statement to delete the blog by ID
    $sql = "DELETE FROM blogs WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blogId);

    if ($stmt->execute()) {
        // Redirect back to the blogs page with a success message
        header("Location: blogs.php?status=deleted");
        exit();
    } else {
        // Redirect back to the blogs page with an error message
        header("Location: blogs.php?status=error");
        exit();
    }
} else {
    // If the ID is not set, redirect back to the blogs page
    header("Location: blogs.php");
    exit();
}
