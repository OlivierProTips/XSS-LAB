<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interface</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $username; ?>!</h2>

        <?php if ($role === 'admin'): ?>
            <h3>Admin Actions</h3>
            <ul>
                <li><a href="read_user_messages.php">Read User Messages</a></li>
                <li><a href="ping_ip.php">Ping IP</a></li>
            </ul>
        <?php else: ?>
            <h3>User Actions</h3>
            <ul>
                <li><a href="write_message.php">Write a Message on Your Wall</a></li>
                <li><a href="send_message_to_advisor.php">Send a Message to Your Advisor</a></li>
            </ul>
        <?php endif; ?>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
