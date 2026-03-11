<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page de connexion

// Connexion à la base de données
require_once __DIR__ . "/../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifiant = htmlspecialchars($_POST["identifiant"] ?? "");
    $motdepasse = $_POST["mot_de_passe"] ?? "";

    if (empty($identifiant) || empty($motdepasse)) {
        $message = "erreur";
    } else {
        // Recherche de l'utilisateur par email en BDD
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute([":email" => $identifiant]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($motdepasse, $utilisateur["mot_de_passe"])) {
            // Connexion réussie, redirection vers le dashboard
            header("Location: dashboard.html");
            exit;
        } else {
            $message = "Identifiant ou mot de passe incorrect.";
        }
    }
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

            <form id="submitform" action="" method="POST">
                <label for="identifiant">Email</label><br>
                <input id="identifiant" name="identifiant" type="email" placeholder="test@email.com"
                    value="<?= htmlspecialchars($_POST['identifiant'] ?? '') ?>">
                <div id="identifiant_error" class="error-text hidden">L'identifiant est obligatoire.</div>
                <label for="mot_de_passe">Mot de passe</label><br>
                <input id="mot_de_passe" name="mot_de_passe" type="password" placeholder="Mot de passe">
                <div id="mdp_error" class="error-text hidden">Le mot de passe est obligatoire.</div>
                <button type="submit">Connexion</button>
                <!-- Message d'erreur affiché par PHP après traitement -->
                <?php if ($message !== "" && $message !== "erreur"): ?>
                    <div class="error-text"><?= $message ?></div>
                <?php elseif ($message === "erreur"): ?>
                    <div class="error-text">Tous les champs sont obligatoires.</div>
                <?php endif; ?>
                <div id="connexion_valide" class="valid-text hidden">Connexion réussie</div>
            </form>
            <br>
            <a href="forgot-password.php" class="forgot-link">Mot de passe oublié ?</a>
            <br>
            <a href="createaccount.php" class="forgot-link">Créer un compte</a>
        </div>
        <script src="../js/app.js"></script>
    </body>
</html>