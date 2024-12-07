<?php
// Database Configuration
$host = "pawsandpurrs-server.mysql.database.azure.com"; // Hostname
$username = "zstafqrshb"; 
$password = "phpmyadmin1!"; 
$database = "pawsandpurrs-database"; // Your database name

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($conn)) {f
die('Failed to connect to MySQL: '.mysqli_connect_error());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
