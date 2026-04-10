CREATE DATABASE ticketing_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE ticketing_db;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('collaborateur', 'admin', 'client') NOT NULL
);

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE projets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    client_id INT NOT NULL,
    contrat ENUM('forfait', 'regie') NOT NULL,
    taux DECIMAL(10,2),
    statut ENUM('actif', 'termine', 'en-attente') NOT NULL DEFAULT 'actif',
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    projet_id INT NOT NULL,
    priorite ENUM('basse', 'moyenne', 'haute') NOT NULL DEFAULT 'moyenne',
    type ENUM('inclus', 'facturable') NOT NULL,
    estimation DECIMAL(10,2),
    assignes VARCHAR(255),
    statut ENUM('nouveau', 'en-cours', 'en-attente', 'termine', 'a-valider') NOT NULL DEFAULT 'nouveau',
    FOREIGN KEY (projet_id) REFERENCES projets(id)
    ;)
