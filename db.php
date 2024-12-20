<?php
$servername = "sql205.infinityfree.com"; // Database host
$username = "if0_37911031"; // Database username
$password = "ursH4xgux0g8e"; // Database password
$dbname = "if0_37911031_loginpage"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
