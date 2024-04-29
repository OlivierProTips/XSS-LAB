<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Vérifier si les champs sont remplis
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("Location: register.php?error=empty");
        exit();
    }

    // Récupérer les données soumises
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insérer les données dans la base de données
    include('functions.php');
    if (getUserByUsername($username)) {
        // L'utilisateur existe déjà, rediriger avec un message d'erreur
        header("Location: register.php?error=exists");
        exit();
    }
    if (createUser($username, $password)) {
        // Rediriger l'utilisateur vers la page de connexion avec un message de succès
        header("Location: register.php?success=registered");
        exit();
    } else {
        // Rediriger l'utilisateur vers la page de création de compte avec un message d'erreur
        header("Location: register.php?error=failed");
        exit();
    }
} else {
    // Rediriger vers la page de création de compte si l'utilisateur tente d'accéder à cette page directement sans soumettre le formulaire
    header("Location: register.php");
    exit();
}
?>
