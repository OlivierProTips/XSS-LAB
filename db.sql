-- Création de la base de données
DROP DATABASE IF EXISTS `mydb`;
CREATE DATABASE IF NOT EXISTS mydb;

-- Utilisation de la base de données
USE mydb;

-- Création de la table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);

INSERT INTO users (username, password, role) VALUES ('marcus', 'thisisareallygoodpassword', 'admin');


-- Création de la table des messages des utilisateurs
CREATE TABLE IF NOT EXISTS user_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table des messages destinés au conseiller
CREATE TABLE IF NOT EXISTS advisor_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
