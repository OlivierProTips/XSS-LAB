<?php
include('db_config.php');

function createUser($username, $password) {
    global $conn;
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    return $stmt->execute();
}

function loginUser($username, $password) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username=:username AND password=:password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        // User logged in successfully
        return true;
    } else {
        // Login failed
        return false;
    }
}

function insertMessage($username, $message) {
    global $conn;
    $sql = "INSERT INTO messages (username, message) VALUES (:username, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
}

function insertMessageForAdvisor($username, $message) {
    global $conn;
    $sql = "INSERT INTO advisor_messages (username, message) VALUES (:username, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
}

function getUserMessages() {
    global $conn;
    $sql = "SELECT * FROM advisor_messages";
    $result = $conn->query($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function deleteMessage($messageId) {
    global $conn;
    $sql = "DELETE FROM advisor_messages WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $messageId);
    $stmt->execute();
}

function usernameAvailable($username) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->rowCount() == 0;
}

function getUserRole($username) {
    global $conn;
    $sql = "SELECT role FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['role'];
}

function getUserByUsername($username) {
    global $conn;
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


?>
