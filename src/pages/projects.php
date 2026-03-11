<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page liste des projets

// Données statiques des projets
$projets = [
    [
        "nom" => "Portail client",
        "client" => "Agence Nova",
        "contrat" => "50h / an",
        "heures_restantes" => "18h",
        "statut" => "Actif",
    ],
    [
        "nom" => "Intranet RH",
        "client" => "Clinique Orion",
        "contrat" => "30h / an",
        "heures_restantes" => "5h",
        "statut" => "Inactif",
    ],
    [
        "nom" => "Refonte site web",
        "client" => "Agence Nova",
        "contrat" => "20h / an",
        "heures_restantes" => "12h",
        "statut" => "Actif",
    ],
];

// Récupération des filtres depuis l'URL via $_GET
$filtre_client = $_GET["filtre-statut"] ?? "tous";
$filtre_statut = $_GET["filtre-projet"] ?? "tous";
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
                        <li><a href="ticket create.html">Créer un ticket</a></li>
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
                    <!-- La valeur est conservée après rechargement grâce à $_GET -->
                    <input id="recherche-projet" name="recherche-projet" type="search"
                        placeholder="Nom du projet"
                        value="<?= htmlspecialchars($_GET['recherche-projet'] ?? '') ?>">

                    <label for="filtre-statut">Client</label>
                    <!-- "selected" est remis automatiquement sur le bon filtre après rechargement -->
                    <select id="filtre-statut" name="filtre-statut">
                        <option value="tous" <?= $filtre_client === "tous" ? "selected" : "" ?>>Tous</option>
                        <option value="agence nova" <?= $filtre_client === "agence nova" ? "selected" : "" ?>>Agence Nova</option>
                        <option value="clinique orion" <?= $filtre_client === "clinique orion" ? "selected" : "" ?>>Clinique Orion</option>
                    </select>

                    <label for="filtre-projet">Statut</label>
                    <select id="filtre-projet" name="filtre-projet">
                        <option value="tous" <?= $filtre_statut === "tous" ? "selected" : "" ?>>Tous</option>
                        <option value="actif" <?= $filtre_statut === "actif" ? "selected" : "" ?>>Actif</option>
                        <option value="inactif" <?= $filtre_statut === "inactif" ? "selected" : "" ?>>Inactif</option>
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
                            <th scope="col">Heures restantes</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="projets-tbody">
                        <!-- Boucle sur le tableau $projets avec application des filtres -->
                        <?php foreach($projets as $projet): ?>
                            <?php
                                // On saute la ligne si elle ne correspond pas au filtre client
                                if ($filtre_client !== "tous" && strtolower($projet["client"]) !== $filtre_client) continue;
                                // On saute la ligne si elle ne correspond pas au filtre statut
                                if ($filtre_statut !== "tous" && strtolower($projet["statut"]) !== $filtre_statut) continue;
                            ?>
                            <tr>
                                <!-- htmlspecialchars pour sécuriser l'affichage -->
                                <td><a href="project detail.html"><?= htmlspecialchars($projet["nom"]) ?></a></td>
                                <td><?= htmlspecialchars($projet["client"]) ?></td>
                                <td><?= htmlspecialchars($projet["contrat"]) ?></td>
                                <td><?= htmlspecialchars($projet["heures_restantes"]) ?></td>
                                <td><?= htmlspecialchars($projet["statut"]) ?></td>
                                <td>
                                    <a href="project detail.html">Voir</a> |
                                    <a href="project create.html">Éditer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><a href="project create.html">Créer un projet</a></p>
            </section>
        </main>

        <footer class="footer">
            <p>© Erika - ESIEA 2026 - Application de gestion de ticketing</p>
        </footer>
        <script src="../js/app.js"></script>
    </body>
</html>