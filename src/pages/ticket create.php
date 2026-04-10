<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page création d'un ticket

// Connexion à la base de données
require_once __DIR__ . "/../config/database.php";

$message = "";

// Traitement du formulaire côté serveur
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = htmlspecialchars($_POST["titre"] ?? "");
    $projet_id = $_POST["projet"] ?? "";
    $description = htmlspecialchars($_POST["description"] ?? "");
    $priorite = $_POST["priorite"] ?? "moyenne";
    $type = $_POST["type"] ?? "inclus";
    $estimation = $_POST["estimation"] ?? null;
    $assignes = htmlspecialchars($_POST["assignes"] ?? "");
    $statut = $_POST["statut"] ?? "nouveau";

    // Validation côté serveur
    if (empty($titre) || empty($projet_id)) {
        $message = "erreur";
    } else {
        // Insertion dans la BDD
        $sql = "INSERT INTO tickets (titre, description, projet_id, priorite, type, estimation, assignes, statut)
                VALUES (:titre, :description, :projet_id, :priorite, :type, :estimation, :assignes, :statut)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":titre"       => $titre,
            ":description" => $description,
            ":projet_id"   => $projet_id,
            ":priorite"    => $priorite,
            ":type"        => $type,
            ":estimation"  => $estimation ?: null,
            ":assignes"    => $assignes,
            ":statut"      => $statut
        ]);
        $message = "Ticket \"" . $titre . "\" créé avec succès !";
    }
}

// Récupération des projets pour le select
$projets = $pdo->query("SELECT id, nom FROM projets")->fetchAll();
?>
<!DOCTYPE html>
<!-- partie html du tp, le php est intégré plus haut -->
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un ticket - Ticketing</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="body-dash">
<header>
    <div class="tableau_de_bord">
        <h1>Créer un ticket</h1>
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
    <section aria-labelledby="formulaire-ticket">
        <h2 id="formulaire-ticket">Formulaire de ticket</h2>

        <!-- Formulaire en POST pour envoyer les données au serveur -->
        <form class="ticket-form" action="" method="POST">

            <label for="titre">Titre</label>
            <input id="titre" name="titre" type="text" placeholder="Titre du ticket"
                value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>">
            <div id="titre_error" class="error-text hidden">Le titre est obligatoire.</div>

            <label for="projet">Projet</label>
            <!-- Les projets sont chargés dynamiquement depuis la BDD -->
            <select id="projet" name="projet">
                <option value="">Sélectionner un projet</option>
                <?php foreach($projets as $projet): ?>
                    <option value="<?= $projet['id'] ?>"
                        <?= ($_POST['projet'] ?? '') == $projet['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($projet['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div id="projet_error" class="error-text hidden">Le projet est obligatoire.</div>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="8" placeholder="Décrire la demande"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            <div id="description_error" class="error-text hidden">La description est obligatoire.</div>

            <label for="priorite">Priorité</label>
            <select id="priorite" name="priorite">
                <option value="basse" <?= ($_POST['priorite'] ?? '') === 'basse' ? 'selected' : '' ?>>Basse</option>
                <option value="moyenne" <?= ($_POST['priorite'] ?? '') === 'moyenne' ? 'selected' : '' ?>>Moyenne</option>
                <option value="haute" <?= ($_POST['priorite'] ?? '') === 'haute' ? 'selected' : '' ?>>Haute</option>
            </select>
            <div id="priorite_error" class="error-text hidden">La priorité est obligatoire.</div>

            <label for="type">Type</label>
            <select id="type" name="type">
                <option value="inclus" <?= ($_POST['type'] ?? '') === 'inclus' ? 'selected' : '' ?>>Inclus</option>
                <option value="facturable" <?= ($_POST['type'] ?? '') === 'facturable' ? 'selected' : '' ?>>Facturable</option>
            </select>
            <div id="type_error" class="error-text hidden">Le type est obligatoire.</div>

            <label for="estimation">Temps estimé (h)</label>
            <input id="estimation" name="estimation" type="number" min="0" step="0.5" placeholder="Ex: 2"
                value="<?= htmlspecialchars($_POST['estimation'] ?? '') ?>">
            <div id="estimation_error" class="error-text hidden">Le temps estimé est obligatoire.</div>

            <label for="assignes">Collaborateurs assignés</label>
            <input id="assignes" name="assignes" type="text" placeholder="Nom(s) séparé(s) par une virgule"
                list="collaborateurs-list"
                value="<?= htmlspecialchars($_POST['assignes'] ?? '') ?>">
            <datalist id="collaborateurs-list"></datalist>
            <div id="assignes_error" class="error-text hidden">Veuillez indiquer au moins un collaborateur.</div>

            <label for="statut">Statut</label>
            <select id="statut" name="statut">
                <option value="nouveau" <?= ($_POST['statut'] ?? '') === 'nouveau' ? 'selected' : '' ?>>Nouveau</option>
                <option value="en-cours" <?= ($_POST['statut'] ?? '') === 'en-cours' ? 'selected' : '' ?>>En cours</option>
                <option value="en-attente" <?= ($_POST['statut'] ?? '') === 'en-attente' ? 'selected' : '' ?>>En attente client</option>
                <option value="termine" <?= ($_POST['statut'] ?? '') === 'termine' ? 'selected' : '' ?>>Terminé</option>
                <option value="a-valider" <?= ($_POST['statut'] ?? '') === 'a-valider' ? 'selected' : '' ?>>À valider</option>
            </select>
            <div id="statut_error" class="error-text hidden">Le statut est obligatoire.</div>

            <button type="submit" id="btn-enregistrer">Enregistrer</button>

            <!-- Message de succès ou d'erreur affiché par PHP après traitement -->
            <?php if ($message !== "" && $message !== "erreur"): ?>
                <div class="valid-text"><?= $message ?></div>
            <?php elseif ($message === "erreur"): ?>
                <div class="error-text">Le titre et le projet sont obligatoires.</div>
            <?php endif; ?>

        </form>
    </section>
</main>

<footer class="footer">
    <p>© Erika - ESIEA 2026 - Application de gestion de ticketing</p>
</footer>

<script src="../js/app.js" defer></script>
</body>
</html>