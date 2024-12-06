<?php
session_start();
require_once('config.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "pet_grooming";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check user role
$isAdmin = isset($_SESSION['admin_id']);
$isClient = isset($_SESSION['client_id']);

if (!$isAdmin && !$isClient) {
    // Redirect to login page if not logged in
    header("Location: page.html?view=login");
    exit();
}

// Delete appointment logic
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($isAdmin) {
        // Admins can delete any appointment
        $sql = "DELETE FROM appointments WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
    } elseif ($isClient) {
        // Clients can delete only their own appointments
        $client_id = $_SESSION['client_id'];
        $sql = "DELETE FROM appointments WHERE id = ? AND client_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id, $client_id);
    }

    if ($stmt->execute()) {
        // Redirect to respective dashboards after deletion
        if ($isAdmin) {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: appointments.php");
        }
        exit();
    } else {
        echo "Error deleting appointment: " . $conn->error;
    }
} else {
    echo "Invalid appointment ID.";
}

$conn->close();
?>
