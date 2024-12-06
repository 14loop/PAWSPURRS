<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

require_once('config.php');

// Database connection
$conn = new mysqli("pawsandpurrs-server.mysql.database.azure.com", "zstafqrshb", "phpmyadmin1!", "pawsandpurrs-database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all appointments
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="admin_logout.php">Log Out</a>
    <table>
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Pet Name</th>
                <th>Pet Type</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['client_name']; ?></td>
                <td><?php echo $row['pet_name']; ?></td>
                <td><?php echo $row['pet_type']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo $row['appointment_time']; ?></td>
                <td>
                    <a href="edit_appointments.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete_appointment.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>
