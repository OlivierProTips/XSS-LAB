<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Récupérer le message soumis
    $message = $_POST['message'];

    // Vous pouvez sauvegarder le message dans la base de données ou faire tout autre traitement ici

    // Ajouter le message à la session pour l'afficher ci-dessous
    $_SESSION['last_message'] = $message;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Message</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Write a Message</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" cols="50"></textarea>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>

        <?php if (isset($_SESSION['last_message'])): ?>
            <h3>Last Message:</h3>
            <p><?php echo $_SESSION['last_message']; ?></p>
            <?php unset($_SESSION['last_message']); ?>
        <?php endif; ?>

        <form action="user_interface.php" method="post">
            <button type="submit">Back to User Interface</button>
        </form>
    </div>
</body>
</html>
