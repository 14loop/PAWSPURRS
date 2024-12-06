<?php
session_start();
require_once('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['client_id'])) {
    header("Location: page.html");
    exit();
}

$client_id = $_SESSION['client_id'];

// Validate POST data
$current_password = isset($_POST['current_password']) ? trim($_POST['current_password']) : '';
$new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
$confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
    die("All fields are required.");
}

if ($new_password !== $confirm_password) {
    die("Passwords do not match.");
}

// Database connection
$servername = "pawsandpurrs-server.mysql.database.azure.com";
$username = "zstafqrshb";
$password = "phpmyadmin1!";
$database = "pawsandpurrs-database";

$conn = new mysqli("pawsandpurrs-server.mysql.database.azure.com", "zstafqrshb", "phpmyadmin1!", "pawsandpurrs-database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify the current password
$sql = "SELECT password FROM clients WHERE client_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error preparing query: " . $conn->error);
}

$stmt->bind_param("i", $client_id);
if (!$stmt->execute()) {
    die("Error executing password retrieval query: " . $stmt->error);
}
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!password_verify($current_password, $row['password'])) {
        die("Incorrect current password.");
    }
} else {
    die("User not found.");
}

// Hash the new password
$new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

// Update the password in the database
$sql = "UPDATE clients SET password = ? WHERE client_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error preparing update query: " . $conn->error);
}

$stmt->bind_param("si", $new_password_hashed, $client_id);
if (!$stmt->execute()) {
    die("Error updating password: " . $stmt->error);
}

echo "Password updated successfully.";
header("Location: appointments.php");
exit();
?>
