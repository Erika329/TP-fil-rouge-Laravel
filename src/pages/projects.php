<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page liste des projets

// Connexion à la base de données
require_once __DIR__ . "/../config/database.php";

// Récupération des filtres depuis l'URL via $_GET
$filtre_client = $_GET["filtre-statut"] ?? "tous";
$filtre_statut = $_GET["filtre-projet"] ?? "tous";

// Construction de la requête SQL avec filtres
$sql = "SELECT projets.id, projets.nom, clients.nom AS client, projets.contrat, projets.statut
        FROM projets
        JOIN clients ON projets.client_id = clients.id
        WHERE 1=1";

$params = [];

if ($filtre_client !== "tous") {
    $sql .= " AND LOWER(clients.nom) = :client";
    $params[":client"] = $filtre_client;
}
if ($filtre_statut !== "tous") {
    $sql .= " AND projets.statut = :statut";
    $params[":statut"] = $filtre_statut;
}

// Exécution de la requête
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$projets = $stmt->fetchAll();

// Récupération des clients pour le filtre
$clients = $pdo->query("SELECT id, nom FROM clients")->fetchAll();
?>
<!DOCTYPE html>
<!--Erika KAMDOM FOTSO 3A FISE-->
<!--TP Fil Rouge / Application de gestion de Ticket-->
<!--Page liste des projets-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projets - Ticketing</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body class="body-dash">
        <header>
            <div class="tableau_de_bord">
                <h1>Projets</h1>
                <nav class="Navigation_principale">
                    <ul>
                        <li><a href="dashboard.html">Tableau de bord</a></li>
                        <li><a href="projects.php">Projets</a></li>
                        <li><a href="tickets.php">Tickets</a></li>
                        <li><a href="ticket create.php">Créer un ticket</a></li>
                        <li><a href="clients.html">Clients</a></li>
                        <li><a href="profile.php">Profil</a></li>
                        <li><a href="settings.html">Paramètres</a></li>
                    </ul>
                </nav>
                <button id="logout" class="logout-btn"><a href="index.php">Déconnexion</a></button>
            </div>
        </header>
        <main>
            <section aria-labelledby="liste-projets">
                <h2 id="liste-projets">Liste des projets</h2>

                <!-- Formulaire de filtre en GET pour filtrer côté serveur -->
                <form id="filtre-projets-form" action="" method="GET">
                    <label for="recherche-projet">Recherche</label>
                    <input id="recherche-projet" name="recherche-projet" type="search"
                        placeholder="Nom du projet"
                        value="<?= htmlspecialchars($_GET['recherche-projet'] ?? '') ?>">

                    <label for="filtre-statut">Client</label>
                    <select id="filtre-statut" name="filtre-statut">
                        <option value="tous" <?= $filtre_client === "tous" ? "selected" : "" ?>>Tous</option>
                        <!-- Les clients sont chargés dynamiquement depuis la BDD -->
                        <?php foreach($clients as $client): ?>
                            <option value="<?= strtolower(htmlspecialchars($client['nom'])) ?>"
                                <?= $filtre_client === strtolower($client['nom']) ? "selected" : "" ?>>
                                <?= htmlspecialchars($client['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="filtre-projet">Statut</label>
                    <select id="filtre-projet" name="filtre-projet">
                        <option value="tous" <?= $filtre_statut === "tous" ? "selected" : "" ?>>Tous</option>
                        <option value="actif" <?= $filtre_statut === "actif" ? "selected" : "" ?>>Actif</option>
                        <option value="termine" <?= $filtre_statut === "termine" ? "selected" : "" ?>>Terminé</option>
                        <option value="en-attente" <?= $filtre_statut === "en-attente" ? "selected" : "" ?>>En attente</option>
                    </select>

                    <button type="submit" id="btn-filtrer">Filtrer</button>
                </form>

                <table id="projects-table">
                    <caption>Projets en cours</caption>
                    <thead>
                        <tr>
                            <th scope="col">Projet</th>
                            <th scope="col">Client</th>
                            <th scope="col">Contrat</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="projets-tbody">
                        <!-- Boucle sur les projets récupérés depuis la BDD -->
                        <?php foreach($projets as $projet): ?>
                            <tr>
                                <td><a href="project detail.html"><?= htmlspecialchars($projet["nom"]) ?></a></td>
                                <td><?= htmlspecialchars($projet["client"]) ?></td>
                                <td><?= htmlspecialchars($projet["contrat"]) ?></td>
                                <td><?= htmlspecialchars($projet["statut"]) ?></td>
                                <td>
                                    <a href="project detail.html?id=<?= $projet['id'] ?>">Voir</a> |
                                    <a href="project create.php?id=<?= $projet['id'] ?>">Éditer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><a href="project create.php">Créer un projet</a></p>
            </section>
        </main>

        <footer class="footer">
            <p>© Erika - ESIEA 2026 - Application de gestion de ticketing</p>
        </footer>
        <script src="../js/app.js"></script>
    </body>
</html>