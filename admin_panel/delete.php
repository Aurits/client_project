<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM product WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: stock.php");
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
