<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "spongebobsquarepants";
$db_database = "mydb";

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_database", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
