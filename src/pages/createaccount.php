<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page d'inscription

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = htmlspecialchars($_POST["prenom"] ?? "");
    $nom = htmlspecialchars($_POST["nom"] ?? "");
    $email = htmlspecialchars($_POST["email"] ?? "");
    $role = htmlspecialchars($_POST["role"] ?? "");
    $mdp = htmlspecialchars($_POST["mot_de_passe"] ?? "");
    $message = "Compte créé avec succès pour " . $prenom . " " . $nom . " !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Ticketing</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="body-connexion">
    <div class="login-box">
        <img src="../assets/images/icon.png" alt="Icône utilisateur">
        <h2>Créer un compte</h2>
        <form id="createform" action="" method="POST">
            <label for="prenom">Prénom</label><br>
            <input id="prenom" name="prenom" type="text" placeholder="Prénom">
            <div id="prenom_error" class="error-text hidden">Le prénom est obligatoire.</div>
            <label for="nom">Nom</label><br>
            <input id="nom" name="nom" type="text" placeholder="Nom">
            <div id="nom_error" class="error-text hidden">Le nom est obligatoire.</div>
            <label for="email">Email</label><br>
            <input id="email" name="email" type="email" placeholder="email@exemple.com">
            <div id="email_error" class="error-text hidden">L'email est obligatoire.</div>
            <label for="role">Rôle</label><br>
            <select id="role" name="role">
                <option value="">Sélectionner un rôle</option>
                <option value="collaborateur">Collaborateur</option>
                <option value="client">Client</option>
                <option value="admin">Administrateur</option>
            </select>
            <div id="role_error" class="error-text hidden">Le rôle est obligatoire.</div>
            <label for="mot_de_passe">Mot de passe</label><br>
            <input id="mot_de_passe" name="mot_de_passe" type="password" placeholder="Mot de passe">
            <div id="mdp_error" class="error-text hidden">Le mot de passe est obligatoire.</div>
            <button type="submit">S'inscrire</button>
            <?php if ($message !== ""): ?>
                <div class="valid-text"><?= $message ?></div>
            <?php endif; ?>
            <div id="creation_valide" class="valid-text hidden">Votre compte a été créé avec succès.</div>
        </form>
        <br>
        <a href="index.php" class="forgot-link">Déjà un compte ? Se connecter</a>
    </div>
    <script src="../js/app.js"></script>
</body>
</html>
