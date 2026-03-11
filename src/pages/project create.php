<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page création / édition d'un projet

require_once __DIR__ . "/../services/ProjectService.php";

$message = "";

// Traitement du formulaire côté serveur
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ps = new ProjectService($_POST);
    $nouveau_projet = $ps->set_new_project();

    // Validation côté serveur
    if (empty($nouveau_projet["nom"])) {
        $message = "erreur";
    } else {
        $message = "Projet \"" . $nouveau_projet["nom"] . "\" enregistré avec succès !";
    }
}
?>
<!DOCTYPE html>
<!--Erika KAMDOM FOTSO 3A FISE-->
<!--TP Fil Rouge / Application de gestion de Ticket-->
<!--Page création / édition d'un projet-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Créer ou modifier un projet - Ticketing</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body class="body-dash">
        <header>
            <div class="tableau_de_bord">
                <h1>Créer / Modifier un projet</h1>
                <nav class="Navigation_principale">
                    <ul>
                        <li><a href="dashboard.html">Tableau de bord</a></li>
                        <li><a href="projects.php">Projets</a></li>
                        <li><a href="tickets.php">Tickets</a></li>
                        <li><a href="ticket create.php">Créer un ticket</a></li>
                        <li><a href="clients.html">Clients</a></li>
                        <li><a href="profile.html">Profil</a></li>
                        <li><a href="settings.html">Paramètres</a></li>
                    </ul>
                </nav>
                <button id="logout" class="logout-btn"><a href="index.php">Déconnexion</a></button>
            </div>
        </header>

        <main>
            <section aria-labelledby="formulaire-projet">
                <h2 id="formulaire-projet">Formulaire projet</h2>

                <!-- Formulaire en POST pour envoyer les données au serveur -->
                <form id="projectform" class="project-form" action="" method="POST">

                    <label for="nom-projet">Nom du projet</label>
                    <!-- La valeur est conservée après rechargement grâce à $_POST -->
                    <input id="nom-projet" name="nom-projet" type="text" placeholder="Nom du projet"
                        value="<?= htmlspecialchars($_POST['nom-projet'] ?? '') ?>">
                    <div id="nom_projet_error" class="error-text hidden">Le nom du projet est obligatoire.</div>

                    <label for="client">Client</label>
                    <!-- "selected" est remis automatiquement sur le bon choix après rechargement -->
                    <select id="client" name="client">
                        <option value="">Sélectionner un client</option>
                        <option value="nova" <?= ($_POST['client'] ?? '') === 'nova' ? 'selected' : '' ?>>Agence Nova</option>
                        <option value="orion" <?= ($_POST['client'] ?? '') === 'orion' ? 'selected' : '' ?>>Clinique Orion</option>
                    </select>
                    <div id="client_error" class="error-text hidden">Le client est obligatoire.</div>

                    <label for="contrat">Contrat (heures incluses)</label>
                    <input id="contrat" name="contrat" type="number" min="0" step="1" placeholder="Ex: 50"
                        value="<?= htmlspecialchars($_POST['contrat'] ?? '') ?>">
                    <div id="contrat_error" class="error-text hidden">Le contrat est obligatoire.</div>

                    <label for="taux">Taux horaire (heures sup.)</label>
                    <input id="taux" name="taux" type="number" min="0" step="1" placeholder="Ex: 80"
                        value="<?= htmlspecialchars($_POST['taux'] ?? '') ?>">
                    <div id="taux_error" class="error-text hidden">Le taux horaire est obligatoire.</div>

                    <label for="periode">Période de validité</label>
                    <input id="periode" name="periode" type="text" placeholder="Ex: 2026"
                        value="<?= htmlspecialchars($_POST['periode'] ?? '') ?>">
                    <div id="periode_error" class="error-text hidden">La période est obligatoire.</div>

                    <label for="collaborateurs">Collaborateurs</label>
                    <input id="collaborateurs" name="collaborateurs" type="text" placeholder="Nom(s) séparé(s) par une virgule"
                        value="<?= htmlspecialchars($_POST['collaborateurs'] ?? '') ?>">
                    <div id="collaborateurs_error" class="error-text hidden">Les collaborateurs sont obligatoires.</div>

                    <label for="description-projet">Description</label>
                    <textarea id="description-projet" name="description-projet" rows="8"
                        placeholder="Contexte du projet"><?= htmlspecialchars($_POST['description-projet'] ?? '') ?></textarea>
                    <div id="description_projet_error" class="error-text hidden">La description est obligatoire.</div>

                    <button type="submit">Enregistrer</button>

                    <!-- Message de succès ou d'erreur affiché par PHP après traitement -->
                    <?php if ($message !== "" && $message !== "erreur"): ?>
                        <div class="valid-text"><?= $message ?></div>
                    <?php elseif ($message === "erreur"): ?>
                        <div class="error-text">Le nom du projet est obligatoire.</div>
                    <?php endif; ?>

                </form>
            </section>
        </main>

        <footer class="footer">
            <p>© Erika - ESIEA 2026 - Application de gestion de ticketing</p>
        </footer>
        <script src="../js/app.js"></script>
    </body>
</html>