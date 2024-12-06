<?php
session_start();
require_once('config.php');

// Check if the user is logged in
if (!isset($_SESSION['client_id'])) {
    // Redirect to login page if not logged in
    header("Location: page.html?view=login");
    exit();
}

// Database connection
$servername = "pawsandpurrs-server.mysql.database.azure.com";
$username = "zstafqrshb";
$password = "phpmyadmin1!";
$database = "pawsandpurrs-database";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$client_id = $_SESSION['client_id'];

// Check if the user has an appointment
$sql = "SELECT * FROM appointments WHERE client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();

// If the user doesn't have an appointment, redirect them to the appointment creation page
if ($result->num_rows == 0) {
    header("Location: page.html?view=appointments");
    exit();
}

// Fetch client-specific appointments
$sql = "SELECT * FROM appointments WHERE client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Your Appointments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Your Appointments</h2>
    <table>
        <tr>
            <!-- Removed the ID column -->
            <th>Client Name</th>
            <th>Pet Name</th>
            <th>Pet Type</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <!-- ID column is hidden -->
                    <td><?php echo $row['client_name']; ?></td>
                    <td><?php echo $row['pet_name']; ?></td>
                    <td><?php echo $row['pet_type']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['appointment_time']; ?></td>
                    <td>
                        <!-- Updated "Edit" to "Reschedule" -->
                        <a href="edit_appointments.php?id=<?php echo $row['id']; ?>">Reschedule</a>
                        <a href="delete_appointment.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Cancel</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No appointments found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Added "Schedule New Appt" button -->
    <div style="margin-top: 20px;">
        <a href="page.html?view=appointments" style="text-decoration: none; padding: 10px 15px; background-color: blue; color: white; border-radius: 5px;">Schedule New Appointment</a>
    </div>

    <!-- Added "Change Password" button -->
    <div style="margin-top: 20px; text-align: right;">
    <a href="change_password.php" style="text-decoration: none; padding: 10px 15px; background-color: blue; color: white; border-radius: 5px;">Change Password</a>
    <a href="logout.php" style="text-decoration: none; padding: 10px 15px; background-color: blue; color: white; border-radius: 5px;">Log Out</a>
</div>


    <?php $conn->close(); ?>
</body>
</html>

