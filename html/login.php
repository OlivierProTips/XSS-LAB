<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers user_interface.php s'il est déjà connecté
    header("Location: user_interface.php");
    exit();
}

// Vérifier s'il y a une erreur de connexion
$error = isset($_GET['error']) ? $_GET['error'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <?php if ($error === 'empty'): ?>
            <p class="error">Please fill in all fields.</p>
        <?php elseif ($error === 'invalid'): ?>
            <p class="error">Invalid username or password.</p>
        <?php endif; ?>

        <form id="loginForm" action="login_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Create one</a>.</p>
    </div>
</body>
</html>
