<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit();
}

// Check if user is logged in as admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Redirect user to login page if not logged in as admin
    header("Location: login.php");
    exit();
}

$result = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ping'])) {
    $ip = $_POST['ip'];
    // Ping the IP address
    $result = shell_exec("ping -c 4 $ip");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ping IP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Ping IP</h2>
        <form action="ping_ip.php" method="POST">
            <div class="form-group">
                <label for="ip">Enter IP Address:</label>
                <input type="text" id="ip" name="ip" required>
            </div>
            <button type="submit" name="ping">Ping</button>
        </form>
        <?php if (!empty($result)): ?>
            <div class="result">
                <pre><?php echo $result; ?></pre>
            </div>
        <?php endif; ?>
        <form action="user_interface.php" method="post">
            <button type="submit">Back to User Interface</button>
        </form>
    </div>
</body>
</html>
