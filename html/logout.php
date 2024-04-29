<?php
session_start();

// Détruire toutes les données de session
$_SESSION = array();

// Supprimer le cookie de session
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header("Location: login.php");
exit();
?>
