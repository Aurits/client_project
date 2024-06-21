<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: usermanagement.php");
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>