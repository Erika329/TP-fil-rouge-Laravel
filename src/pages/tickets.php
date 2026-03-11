<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page liste des tickets

// Données statiques des tickets
$tickets = [
    [
        "id" => "#TK-001",
        "titre" => "Bug formulaire contact",
        "projet" => "Portail client",
        "statut" => "En cours",
        "priorite" => "Haute",
        "type" => "Inclus",
    ],
    [
        "id" => "#TK-002",
        "titre" => "Ajout export PDF",
        "projet" => "Intranet RH",
        "statut" => "En attente client",
        "priorite" => "Moyenne",
        "type" => "Facturable",
    ],
    [
        "id" => "#TK-003",
        "titre" => "Mise à jour logo",
        "projet" => "Portail client",
        "statut" => "Nouveau",
        "priorite" => "Basse",
        "type" => "Inclus",
    ],
];

// Récupération des filtres depuis l'URL via $_GET
$filtre_statut = $_GET["filtre-statut"] ?? "tous";
$filtre_projet = $_GET["filtre-projet"] ?? "tous";
$filtre_type   = $_GET["filtre-type"] ?? "tous";
?>
<!DOCTYPE html>
<!--Erika KAMDOM FOTSO 3A FISE-->
<!--TP Fil Rouge / Application de gestion de Ticket-->
<!--Page liste des tickets-->
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets - Ticketing</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="body-dash">
    <header>
        <div class="tableau_de_bord">
            <h1>Tickets</h1>
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
        <section aria-labelledby="liste-tickets">
            <h2 id="liste-tickets">Liste des tickets</h2>

            <!-- Formulaire de filtre en GET pour filtrer côté serveur -->
            <form id="filtre-tickets-form" action="" method="GET">
                <label for="recherche-ticket">Recherche</label>
                <!-- La valeur est conservée après rechargement grâce à $_GET -->
                <input id="recherche-ticket" name="recherche-ticket" type="search"
                    placeholder="Titre ou ID"
                    value="<?= htmlspecialchars($_GET['recherche-ticket'] ?? '') ?>">

                <label for="filtre-statut">Statut</label>
                <!-- "selected" est remis automatiquement sur le bon filtre après rechargement -->
                <select id="filtre-statut" name="filtre-statut">
                    <option value="tous" <?= $filtre_statut === "tous" ? "selected" : "" ?>>Tous</option>
                    <option value="nouveau" <?= $filtre_statut === "nouveau" ? "selected" : "" ?>>Nouveau</option>
                    <option value="en cours" <?= $filtre_statut === "en cours" ? "selected" : "" ?>>En cours</option>
                    <option value="termine" <?= $filtre_statut === "termine" ? "selected" : "" ?>>Terminé</option>
                    <option value="en attente client" <?= $filtre_statut === "en attente client" ? "selected" : "" ?>>En attente client</option>
                </select>

                <label for="filtre-projet">Projet</label>
                <select id="filtre-projet" name="filtre-projet">
                    <option value="tous" <?= $filtre_projet === "tous" ? "selected" : "" ?>>Tous</option>
                    <option value="portail client" <?= $filtre_projet === "portail client" ? "selected" : "" ?>>Portail client</option>
                    <option value="intranet rh" <?= $filtre_projet === "intranet rh" ? "selected" : "" ?>>Intranet RH</option>
                </select>

                <label for="filtre-type">Type</label>
                <select id="filtre-type" name="filtre-type">
                    <option value="tous" <?= $filtre_type === "tous" ? "selected" : "" ?>>Tous</option>
                    <option value="inclus" <?= $filtre_type === "inclus" ? "selected" : "" ?>>Inclus</option>
                    <option value="facturable" <?= $filtre_type === "facturable" ? "selected" : "" ?>>Facturable</option>
                </select>

                <button type="submit" id="btn-filtrer">Filtrer</button>
            </form>

            <table id="tickets-table">
                <caption>Tickets en cours</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Projet</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Priorité</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle sur le tableau $tickets avec application des filtres -->
                    <?php foreach($tickets as $ticket): ?>
                        <?php
                            // On saute la ligne si elle ne correspond pas au filtre statut
                            if ($filtre_statut !== "tous" && strtolower($ticket["statut"]) !== $filtre_statut) continue;
                            // On saute la ligne si elle ne correspond pas au filtre projet
                            if ($filtre_projet !== "tous" && strtolower($ticket["projet"]) !== $filtre_projet) continue;
                            // On saute la ligne si elle ne correspond pas au filtre type
                            if ($filtre_type !== "tous" && strtolower($ticket["type"]) !== $filtre_type) continue;
                        ?>
                        <tr>
                            <!-- htmlspecialchars pour sécuriser l'affichage -->
                            <td><?= htmlspecialchars($ticket["id"]) ?></td>
                            <td><?= htmlspecialchars($ticket["titre"]) ?></td>
                            <td><?= htmlspecialchars($ticket["projet"]) ?></td>
                            <td><?= htmlspecialchars($ticket["statut"]) ?></td>
                            <td><?= htmlspecialchars($ticket["priorite"]) ?></td>
                            <td><?= htmlspecialchars($ticket["type"]) ?></td>
                            <td><a href="ticket detail.html">Voir</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><a href="ticket create.php">Créer un ticket</a></p>
            <div id="notif-ticket" class="notif" style="display:none;"></div>
        </section>
    </main>
    <footer class="footer">
        <p>© Erika - ESIEA 2026 - Application de gestion de ticketing</p>
    </footer>
    <script src="../js/app.js" defer></script>
</body>
</html>