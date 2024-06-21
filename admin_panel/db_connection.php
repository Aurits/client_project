<?php

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
