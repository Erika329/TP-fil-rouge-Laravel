<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page mot de passe oublié

$message="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars($_POST["email"] ?? "");
    $message="Mot de passe oublié";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - Ticketing</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="body-connexion">
    <div class="login-box">
        <img src="../assets/images/icon.png" alt="Icône utilisateur">
        <h2>Mot de passe oublié</h2>
        <?php if ($message !== ""): ?>
        <div class="valid-text"><?= $message ?></div>
        <?php endif; ?>
        <form id="forgotform" action="" method="POST">
            <label for="email">Email</label><br>
            <input id="email" name="email" type="email" placeholder="email@exemple.com">
            <div id="email_error" class="error-text hidden">L'email est obligatoire.</div>
            <button type="submit">Envoyer le lien</button>
            <div id="mail_valide" class="valid-text hidden">Un mail vous a été envoyé.</div>
        </form>
        <br>
        <a href="index.php" class="forgot-link">Retour à la connexion</a>
    </div>
    <script src="../js/app.js"></script>
</body>
</html>
