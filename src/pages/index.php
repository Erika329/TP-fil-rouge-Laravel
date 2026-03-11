<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page de connexion

// Traitement PHP côté serveur 
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifiant = htmlspecialchars($_POST["identifiant"] ?? "");
    $motdepasse = htmlspecialchars($_POST["mot_de_passe"] ?? "");
    $message = "Connexion demandée";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Application de gestion des tickets</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body class="body-connexion">
        <div class="login-box">
            <img src="../assets/images/icon.png" alt="Icône utilisateur">
            <h2>Connexion</h2>
            <?php if ($message !== ""): ?>
            <div class="valid-text"><?= $message ?></div>
            <?php endif; ?>

            <form id="submitform" action="" method="POST">
                <label for="identifiant">Identifiant</label><br>
                <input id="identifiant" name="identifiant" type="text" placeholder="Identifiant">
                <div id="identifiant_error" class="error-text hidden">L'identifiant est obligatoire.</div>
                <label for="mot_de_passe">Mot de passe</label><br>
                <input id="mot_de_passe" name="mot_de_passe" type="password" placeholder="Mot de passe">
                <div id="mdp_error" class="error-text hidden">Le mot de passe est obligatoire.</div>
                <button type="submit">Connexion</button>
                <div id="connexion_valide" class="valid-text hidden">Connexion réussi</div>
            </form>
            <br>
            <a href="forgot-password.php" class="forgot-link">Mot de passe oublié?</a>
            <br>
            <a href="createaccount.php" class="forgot-link">Créer un compte</a>
        </div>
        <script src="../js/app.js"></script>
    </body>
</html>
