<?php
session_start();
if (!isset($_SESSION['client_id'])) {
    header("Location: page.html?view=login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <h2>Change Password</h2>
    <form action="process_password_change.php" method="POST">
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" id="current_password" required>
        <br><br>
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" required>
        <br><br>
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <br><br>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>
