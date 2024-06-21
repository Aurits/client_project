<?php
include 'db_connection.php';

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td><img src='../site_images/" . $row["product_image"] . "' width='100'></td>";
        echo "<td>" . $row["product_price"] . "</td>";
        echo "<td>" . $row["product_qty"] . "</td>";
        echo "<td>" . $row["product_description"] . "</td>";
        echo "<td><a href='updatestock.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No products found</td></tr>";
}

mysqli_close($conn);