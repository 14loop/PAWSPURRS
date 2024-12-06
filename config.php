<?php
// Database Configuration
$host = "localhost"; // Hostname
$username = "root"; // Default username for XAMPP
$password = ""; // Default password (empty for XAMPP)
$database = "pet_grooming"; // Your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
