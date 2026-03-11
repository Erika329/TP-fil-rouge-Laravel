<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page détail d'un ticket

// Connexion à la base de données
require_once __DIR__ . "/../config/database.php";

// Récupération de l'id du ticket depuis l'URL
$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: tickets.php");
    exit;
}

// Récupération du ticket depuis la BDD
$stmt = $pdo->prepare("SELECT tickets.*, projets.nom AS projet
                        FROM tickets
                        JOIN projets ON tickets.projet_id = projets.id
                        WHERE tickets.id = :id");
$stmt->execute([":id" => $id]);
$ticket = $stmt->fetch();

// Si le ticket n'existe pas, on redirige vers la liste
if (!$ticket) {
    header("Location: tickets.php");
    exit;
}
?>
<!DOCTYPE html>
<!--Erika KAMDOM FOTSO 3A FISE-->
<!--TP Fil Rouge / Application de gestion de Ticket-->
<!--Page détail d'un ticket-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détail du ticket - Ticketing</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body class="body-dash">
        <header>
            <div class="tableau_de_bord">
                <h1>Détail du ticket</h1>
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
            <section aria-labelledby="resume-ticket">
                <h2 id="resume-ticket">Résumé</h2>
                <ul>
                    <!-- Données récupérées depuis la BDD -->
                    <li>ID : <?= htmlspecialchars("#TK-" . str_pad($ticket["id"], 3, "0", STR_PAD_LEFT)) ?></li>
                    <li>Titre : <?= htmlspecialchars($ticket["titre"]) ?></li>
                    <li>Projet : <?= htmlspecialchars($ticket["projet"]) ?></li>
                    <li>Statut : <?= htmlspecialchars($ticket["statut"]) ?></li>
                    <li>Priorité : <?= htmlspecialchars($ticket["priorite"]) ?></li>
                    <li>Type : <?= htmlspecialchars($ticket["type"]) ?></li>
                    <li>Estimation : <?= htmlspecialchars($ticket["estimation"]) ?>h</li>
                </ul>
            </section>

            <section aria-labelledby="description-ticket">
                <h2 id="description-ticket">Description</h2>
                <p><?= htmlspecialchars($ticket["description"]) ?></p>
            </section>

            <section aria-labelledby="collaborateurs-ticket">
                <h2 id="collaborateurs-ticket">Collaborateurs assignés</h2>
                <ul>
                    <!-- Assignés séparés par des virgules -->
                    <?php foreach(explode(",", $ticket["assignes"]) as $assigne): ?>
                        <li><?= htmlspecialchars(trim($assigne)) ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section aria-labelledby="actions-ticket">
                <h2 id="actions-ticket">Actions</h2>
                <ul>
                    <li><a href="ticket create.php">Modifier le ticket</a></li>
                    <li><a href="tickets.php">Retour à la liste</a></li>
                </ul>
            </section>
        </main>

        <footer class="footer">
            <p>© Erika - ESIEA 2026 - Application de gestion de ticketing</p>
        </footer>
        <script src="../js/app.js"></script>
    </body>
</html>