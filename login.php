<?php
session_start();
require_once(__DIR__ . '/wwwroot/config.php'); // Ensure correct path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch client details
    $sql = "SELECT client_id, password FROM clients WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['client_id'] = $row['client_id']; // Store client ID in session
            echo "Login successful";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Error logging in.";
    }

    $stmt->close();
}
?>

