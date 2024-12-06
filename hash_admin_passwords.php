<?php
$conn = new mysqli("localhost", "root", "", "pet_grooming");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all admins
$sql = "SELECT admin_id, password FROM admin";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    if (strlen($row['password']) < 60) {
        $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);
        $update_sql = "UPDATE admin SET password = ? WHERE admin_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $hashed_password, $row['admin_id']);
        $stmt->execute();
        echo "Updated password for admin ID: " . $row['id'] . " - New Hash: " . $hashed_password . "<br>";
    }
}


$conn->close();
?>
