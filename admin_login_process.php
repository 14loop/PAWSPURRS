<?php
session_start();
require_once('config.php');

// Retrieve input
$email = $_POST['Admin_email'];
$password = $_POST['Admin_password'];

// Database connection
$conn = new mysqli("pawsandpurrs-server.mysql.database.azure.com", "zstafqrshb", "phpmyadmin1!", "pawsandpurrs-database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the admin exists
$sql = "SELECT * FROM pawsandpurrs-database.admin WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $pawsandpurrs-database.admin = $result->fetch_assoc();
    if (password_verify($password, $admin['password'])) {
        // Store admin session
        $_SESSION['admin_id'] = $pawsandpurrs-database.admin['admin_id'];
        $_SESSION['role'] = $pawsandpurrs-database.admin['role'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No admin found with that email.";
}
$conn->close();
