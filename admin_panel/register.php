<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password (you should use a more secure hashing algorithm like bcrypt)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $checkQuery = "SELECT * FROM Users WHERE Username = '$name'";
    $result = $conn->query($checkQuery);
    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose a different one.";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO Users (Username, Password) VALUES ('$name', '$hashedPassword')";
        if ($conn->query($sql) === TRUE) {
            // Redirect to login page
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
