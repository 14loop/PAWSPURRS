<?php
// Database Configuration
$host = "pawsandpurrs-server.mysql.database.azure.com"; // Hostname
$username = "zstafqrshb"; 
$password = "CKlyc1XfXVR3Rz1$"; 
$database = "pawsandpurrs-database"; // Your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
