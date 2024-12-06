<?php
session_start();
$errorMessage = "";

// Check for error message passed back from admin_login_process.php
if (isset($_SESSION['login_error'])) {
    $errorMessage = $_SESSION['login_error'];
    unset($_SESSION['login_error']); // Clear the error after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    
    <!-- Display error message if any -->
    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
    <?php endif; ?>
    
    <form id="adminLoginForm" method="POST" action="admin_login_process.php">
        <label for="Admin_email">Email</label>
        <input type="email" id="Admin_email" name="Admin_email" required>
        
        <label for="Admin_password">Password</label>
        <input type="password" id="Admin_password" name="Admin_password" required>
        
        <button type="submit">Log In</button>
    </form>
</body>
</html>
