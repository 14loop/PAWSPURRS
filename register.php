<?php
require_once('config.php'); // Database connection

// Debugging: Show all errors during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect POST data
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phonenumber = $_POST['phonenumber'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash password

    // Validate fields (basic example)
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phonenumber) || empty($_POST['password'])) {
        echo "All fields are required.";
        exit;
    }

    // Insert data into the database
    $sql = "INSERT INTO clients (firstname, lastname, email, phonenumber, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $phonenumber, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid request method.";
}
?>
