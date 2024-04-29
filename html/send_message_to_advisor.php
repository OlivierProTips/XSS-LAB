<?php
include('functions.php');
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit();
}

$success_message = isset($_GET['success']) ? $_GET['success'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_message'])) {

    $message = $_POST['message'];
    $username = $_SESSION['username'];

    // Insert message into messages table in the database
    insertMessageForAdvisor($username, $message);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message to Advisor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Send Message to Advisor</h2>
        <form action="send_message_to_advisor.php?success=ok" method="POST">
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" name="send_message">Send Message</button>
        </form>
        <?php if ($success_message === 'ok'): ?>
            <p class="success">Message sent successfully</p>
        <?php endif; ?>

<form action="user_interface.php" method="post">
    <button type="submit">Back to User Interface</button>
</form>
    </div>


</body>
</html>
