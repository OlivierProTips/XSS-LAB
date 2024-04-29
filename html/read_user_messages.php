<?php
include('functions.php');

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

// Fetch user messages from database
$userMessages = getUserMessages();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>User Messages</h2>
        <?php foreach ($userMessages as $message): ?>
            <div class="message">
                <p><?php echo $message['message']; ?></p>
                <form action="read_user_messages.php" method="POST">
                    <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                    <button type="submit" name="delete_message">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
        <form action="user_interface.php" method="post">
            <button type="submit">Back to User Interface</button>
        </form>
    </div>

    <?php
    // Code to handle message deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_message'])) {
        $messageId = $_POST['message_id'];
        deleteMessage($messageId);
        // Redirect back to this page to refresh the message list
        header("Location: read_user_messages.php");
        exit();
    }
    ?>

</body>
</html>
