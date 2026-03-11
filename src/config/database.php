<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Connexion à la base de données

// Lecture des variables d'environnement
$env = parse_ini_file(__DIR__ . "/../../.env");

$dsn = "mysql:host=" . $env["DB_HOST"] . ";port=" . $env["DB_PORT"] . ";dbname=" . $env["DB_NAME"] . ";charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $env["DB_USER"], $env["DB_PASSWORD"], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur connexion BDD : " . $e->getMessage());
}