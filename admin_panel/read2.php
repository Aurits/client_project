<?php
include 'db_connection.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td><a href='update2.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete2.php?id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No products found</td></tr>";
}

mysqli_close($conn);
