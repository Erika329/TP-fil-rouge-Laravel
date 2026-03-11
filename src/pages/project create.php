<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page création / édition d'un projet

// Connexion à la base de données
require_once __DIR__ . "/../config/database.php";

$message = "";

// Traitement du formulaire côté serveur
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST["nom-projet"] ?? "");
    $client_id = $_POST["client"] ?? "";
    $contrat = $_POST["contrat"] ?? "forfait";
    $taux = $_POST["taux"] ?? null;
    $statut = $_POST["statut"] ?? "actif";

    // Validation côté serveur
    if (empty($nom) || empty($client_id)) {
        $message = "erreur";
    } else {
        // Insertion dans la BDD
        $sql = "INSERT INTO projets (nom, client_id, contrat, taux, statut)
                VALUES (:nom, :client_id, :contrat, :taux, :statut)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nom"       => $nom,
            ":client_id" => $client_id,
            ":contrat"   => $contrat,
            ":taux"      => $taux ?: null,
            ":statut"    => $statut
        ]);
        $message = "Projet \"" . $nom . "\" enregistré avec succès !";
    }
}

// Récupération des clients pour le select
$clients = $pdo->query("SELECT id, nom FROM clients")->fetchAll();
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
                        <li><a href="profile.php">Profil</a></li>
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
                    <input id="nom-projet" name="nom-projet" type="text" placeholder="Nom du projet"
                        value="<?= htmlspecialchars($_POST['nom-projet'] ?? '') ?>">
                    <div id="nom_projet_error" class="error-text hidden">Le nom du projet est obligatoire.</div>

                    <label for="client">Client</label>
                    <!-- Les clients sont chargés dynamiquement depuis la BDD -->
                    <select id="client" name="client">
                        <option value="">Sélectionner un client</option>
                        <?php foreach($clients as $client): ?>
                            <option value="<?= $client['id'] ?>"
                                <?= ($_POST['client'] ?? '') == $client['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($client['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="client_error" class="error-text hidden">Le client est obligatoire.</div>

                    <label for="contrat">Type de contrat</label>
                    <select id="contrat" name="contrat">
                        <option value="forfait" <?= ($_POST['contrat'] ?? '') === 'forfait' ? 'selected' : '' ?>>Forfait</option>
                        <option value="regie" <?= ($_POST['contrat'] ?? '') === 'regie' ? 'selected' : '' ?>>Régie</option>
                    </select>
                    <div id="contrat_error" class="error-text hidden">Le contrat est obligatoire.</div>

                    <label for="taux">Taux horaire</label>
                    <input id="taux" name="taux" type="number" min="0" step="1" placeholder="Ex: 80"
                        value="<?= htmlspecialchars($_POST['taux'] ?? '') ?>">
                    <div id="taux_error" class="error-text hidden">Le taux horaire est obligatoire.</div>

                    <label for="statut">Statut</label>
                    <select id="statut" name="statut">
                        <option value="actif" <?= ($_POST['statut'] ?? '') === 'actif' ? 'selected' : '' ?>>Actif</option>
                        <option value="termine" <?= ($_POST['statut'] ?? '') === 'termine' ? 'selected' : '' ?>>Terminé</option>
                        <option value="en-attente" <?= ($_POST['statut'] ?? '') === 'en-attente' ? 'selected' : '' ?>>En attente</option>
                    </select>

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
                        <div class="error-text">Le nom du projet et le client sont obligatoires.</div>
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