<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost";
$username = "u105432154_db";
$password = "1D|ov3q]In!";
$database = "u105432154_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to fetch user from database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Check if user exists and password is correct
    if (mysqli_num_rows($result) == 1) {
        // Start a session
        session_start();

        // Store username in session variable
        $_SESSION['username'] = $username;
        // User authenticated, redirect to dashboard or another page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials, display error message
        echo "Invalid username or password";
    }
}

// Close connection
mysqli_close($conn);

?>
