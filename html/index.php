<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers user_interface s'il est connecté
    header("Location: user_interface.php");
    exit();
} else {
    // Rediriger l'utilisateur vers login s'il n'est pas connecté
    header("Location: login.php");
    exit();
}
?>
