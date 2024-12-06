<?php
session_start();

// Ensure the client is logged in
if (!isset($_SESSION['client_id'])) {
   // Redirect to the main page with the login view
   header("Location: page.html?view=login&message=not_logged_in");
   exit();
}

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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_SESSION['client_id'];
    $client_name = $_POST['client_name'];
    $pet_name = $_POST['pet_name'];
    $pet_type = $_POST['pet_type'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Insert data into the database
    $sql = "INSERT INTO appointments (client_id, client_name, pet_name, pet_type, appointment_date, appointment_time) 
            VALUES ('$client_id', '$client_name', '$pet_name', '$pet_type', '$appointment_date', '$appointment_time')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to appointments.php
        header("Location: appointments.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
