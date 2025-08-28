<?php
session_start();

// Simple login system for admin panel
$valid_username = "admin";
$valid_password = "treatx123"; // Change this to a secure password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Treatx' Pastries</title>
    <link rel="stylesheet" href="pastry_business.css">
</head>
<body>
    <div style="max-width: 400px; margin: 100px auto; padding: 2rem; background: white; border-radius: 15px; box-shadow: 0 6px 15px rgba(123, 45, 38, 0.15);">
        <h2 style="text-align: center; color: var(--primary-color);">Admin Login</h2>
        
        <?php if (isset($error)): ?>
            <p style="color: red; text-align: center;"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <form method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
            <div>
                <label for="username" style="font-weight: bold;">Username:</label>
                <input type="text" id="username" name="username" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            
            <div>
                <label for="password" style="font-weight: bold;">Password:</label>
                <input type="password" id="password" name="password" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            
            <button type="submit" style="background: linear-gradient(45deg, var(--primary-color), var(--accent-color)); color: white; border: none; padding: 0.75rem; border-radius: 5px; cursor: pointer; font-weight: bold;">
                Login
            </button>
        </form>
        
        <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem; color: #666;">
            Default credentials: admin / treatx123
        </p>
    </div>
</body>
</html>
