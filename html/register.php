<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers user_interface.php s'il est déjà connecté
    header("Location: user_interface.php");
    exit();
}

// Vérifier s'il y a un message de succès ou d'erreur
$success_message = isset($_GET['success']) ? $_GET['success'] : '';
$error_message = isset($_GET['error']) ? $_GET['error'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>

        <?php if ($success_message === 'registered'): ?>
            <p class="success">Account created successfully. Please <a href="login.php">log in</a>.</p>
        <?php elseif ($error_message === 'empty'): ?>
            <p class="error">Please fill in all fields.</p>
        <?php elseif ($error_message === 'failed'): ?>
            <p class="error">Failed to create account. Please try again later.</p>
        <?php elseif ($error_message === 'exists'): ?>
            <p class="error">User already exists. Please try another one.</p>
        <?php endif; ?>

        <form action="register_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a>.</p>
    </div>
</body>
</html>
