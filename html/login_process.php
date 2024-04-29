<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Vérifier si les champs sont remplis
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("Location: login.php?error=empty");
        exit();
    }

    // Récupérer les données soumises
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier les informations d'identification dans la base de données
    include('functions.php');
    $user = getUserByUsername($username);

    if (isset($user) && $password === $user['password']) {
        // Authentification réussie
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];
        header("Location: user_interface.php");
        exit();
    } else {
        // Nom d'utilisateur ou mot de passe incorrect
        header("Location: login.php?error=invalid");
        exit();
    }
} else {
    // Rediriger vers la page de connexion si l'utilisateur tente d'accéder à cette page directement sans soumettre le formulaire de connexion
    header("Location: login.php");
    exit();
}
?>
