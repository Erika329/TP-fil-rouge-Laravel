<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page profil utilisateur

$message_profil = "";
$message_mdp = "";

// Traitement du formulaire de mise à jour du profil
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "profil") {
    $prenom = htmlspecialchars($_POST["prenom"] ?? "");
    $nom = htmlspecialchars($_POST["nom"] ?? "");
    $email = htmlspecialchars($_POST["email"] ?? "");

    if (empty($prenom) || empty($nom) || empty($email)) {
        $message_profil = "erreur";
    } else {
        $message_profil = "Profil mis à jour pour " . $prenom . " " . $nom . " !";
    }
}

// Traitement du formulaire de modification du mot de passe
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "mdp") {
    $ancien_mdp = $_POST["ancien-mdp"] ?? "";
    $nouveau_mdp = $_POST["nouveau-mdp"] ?? "";

    if (empty($ancien_mdp) || empty($nouveau_mdp)) {
        $message_mdp = "erreur";
    } else {
        $message_mdp = "Mot de passe modifié avec succès !";
    }
}
?>
<!DOCTYPE html>
<!--Erika KAMDOM FOTSO 3A FISE-->
<!--TP Fil Rouge / Application de gestion de Ticket-->
<!--Page profil utilisateur-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil - Ticketing</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body class="body-dash">
        <header>
            <div class="tableau_de_bord">
                <h1>Profil utilisateur</h1>
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
            <section aria-labelledby="infos-profil">
                <h2 id="infos-profil">Informations générales</h2>
                <ul>
                    <!-- Données statiques en attendant la BDD -->
                    <li>Nom : Erika K.</li>
                    <li>Rôle : Collaborateur</li>
                    <li>Email : erika@exemple.fr</li>
                    <li>Client associé : Agence Nova</li>
                </ul>
            </section>

            <section aria-labelledby="edition-profil">
                <h2 id="edition-profil">Mettre à jour</h2>
                <!-- Formulaire en POST avec champ action pour distinguer les deux formulaires -->
                <form action="" method="POST">
                    <input type="hidden" name="action" value="profil">
                    <label for="prenom">Prénom</label>
                    <!-- La valeur est conservée après rechargement grâce à $_POST -->
                    <input id="prenom" name="prenom" type="text" placeholder="Prénom"
                        value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
                    <label for="nom">Nom</label>
                    <input id="nom" name="nom" type="text" placeholder="Nom"
                        value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="email@exemple.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <button type="submit">Enregistrer</button>
                    <!-- Message de succès ou d'erreur affiché par PHP après traitement -->
                    <?php if ($message_profil !== "" && $message_profil !== "erreur"): ?>
                        <div class="valid-text"><?= $message_profil ?></div>
                    <?php elseif ($message_profil === "erreur"): ?>
                        <div class="error-text">Tous les champs sont obligatoires.</div>
                    <?php endif; ?>
                </form>
            </section>

            <section aria-labelledby="securite">
                <h2 id="securite">Sécurité</h2>
                <!-- Formulaire en POST avec champ action pour distinguer les deux formulaires -->
                <form action="" method="POST">
                    <input type="hidden" name="action" value="mdp">
                    <label for="ancien-mdp">Ancien mot de passe</label>
                    <input id="ancien-mdp" name="ancien-mdp" type="password" placeholder="Ancien mot de passe">
                    <label for="nouveau-mdp">Nouveau mot de passe</label>
                    <input id="nouveau-mdp" name="nouveau-mdp" type="password" placeholder="Nouveau mot de passe">
                    <button type="submit">Modifier</button>
                    <!-- Message de succès ou d'erreur affiché par PHP après traitement -->
                    <?php if ($message_mdp !== "" && $message_mdp !== "erreur"): ?>
                        <div class="valid-text"><?= $message_mdp ?></div>
                    <?php elseif ($message_mdp === "erreur"): ?>
                        <div class="error-text">Les deux champs sont obligatoires.</div>
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