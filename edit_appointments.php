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

// Fetch appointment details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // For admins, fetch any appointment; for clients, fetch only their appointments
    if ($isAdmin) {
        $sql = "SELECT * FROM appointments WHERE id = ?";
    } else {
        $sql = "SELECT * FROM appointments WHERE id = ? AND client_id = ?";
    }
    
    $stmt = $conn->prepare($sql);
    if ($isAdmin) {
        $stmt->bind_param("i", $id);
    } else {
        $client_id = $_SESSION['client_id'];
        $stmt->bind_param("ii", $id, $client_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $appointment = $result->fetch_assoc();
    } else {
        die("Appointment not found or access denied.");
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $client_name = $_POST['client_name'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $pet_name = $_POST['pet_name'];
    $pet_type = $_POST['pet_type'];

    // For admins, update any appointment; for clients, update only their appointments
    if ($isAdmin) {
        $sql = "UPDATE appointments SET client_name=?, appointment_date=?, appointment_time=?, pet_name=?, pet_type=? WHERE id=?";
    } else {
        $sql = "UPDATE appointments SET client_name=?, appointment_date=?, appointment_time=?, pet_name=?, pet_type=? WHERE id=? AND client_id=?";
    }

    $stmt = $conn->prepare($sql);
    if ($isAdmin) {
        $stmt->bind_param("sssssi", $client_name, $appointment_date, $appointment_time, $pet_name, $pet_type, $id);
    } else {
        $client_id = $_SESSION['client_id'];
        $stmt->bind_param("sssssii", $client_name, $appointment_date, $appointment_time, $pet_name, $pet_type, $id, $client_id);
    }

    if ($stmt->execute()) {
        // Redirect back to respective dashboard
        if ($isAdmin) {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: appointments.php");
        }
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <style>
        form {
            width: 50%;
            margin: 0 auto;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            color: #000;
        }
        button {
            padding: 10px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2>Edit Appointment</h2>
    <form method="POST" action="edit_appointments.php">
        <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
        <label for="client_name">Your Name</label>
        <input type="text" id="client_name" name="client_name" value="<?php echo $appointment['client_name']; ?>" required>

        <label for="appointment_date">Preferred Date</label>
        <input type="date" id="appointment_date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required>

        <label for="appointment_time">Preferred Time</label>
        <input type="time" id="appointment_time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>" required>

        <label for="pet_name">Pet's Name</label>
        <input type="text" id="pet_name" name="pet_name" value="<?php echo $appointment['pet_name']; ?>" required>

        <label for="pet_type">Pet Type</label>
        <input type="text" id="pet_type" name="pet_type" value="<?php echo $appointment['pet_type']; ?>" required>

        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
