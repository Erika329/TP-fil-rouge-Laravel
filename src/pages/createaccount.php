<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Page d'inscription

// Connexion à la base de données
require_once __DIR__ . "/../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = htmlspecialchars($_POST["prenom"] ?? "");
    $nom = htmlspecialchars($_POST["nom"] ?? "");
    $email = htmlspecialchars($_POST["email"] ?? "");
    $role = htmlspecialchars($_POST["role"] ?? "");
    $mdp = $_POST["mot_de_passe"] ?? "";

    if (empty($prenom) || empty($nom) || empty($email) || empty($role) || empty($mdp)) {
        $message = "erreur";
    } else {
        // Vérification si l'email existe déjà en BDD
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email");
        $stmt->execute([":email" => $email]);

        if ($stmt->fetch()) {
            $message = "Un compte existe déjà avec cet email.";
        } else {
            // Hachage du mot de passe avant insertion
            $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

            // Insertion dans la BDD
            $sql = "INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe, role)
                    VALUES (:prenom, :nom, :email, :mdp, :role)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":prenom" => $prenom,
                ":nom"    => $nom,
                ":email"  => $email,
                ":mdp"    => $mdp_hash,
                ":role"   => $role
            ]);
            $message = "Compte créé avec succès pour " . $prenom . " " . $nom . " !";
        }
    }
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
            <input id="prenom" name="prenom" type="text" placeholder="Prénom"
                value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
            <div id="prenom_error" class="error-text hidden">Le prénom est obligatoire.</div>
            <label for="nom">Nom</label><br>
            <input id="nom" name="nom" type="text" placeholder="Nom"
                value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
            <div id="nom_error" class="error-text hidden">Le nom est obligatoire.</div>
            <label for="email">Email</label><br>
            <input id="email" name="email" type="email" placeholder="email@exemple.com"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <div id="email_error" class="error-text hidden">L'email est obligatoire.</div>
            <label for="role">Rôle</label><br>
            <select id="role" name="role">
                <option value="">Sélectionner un rôle</option>
                <option value="collaborateur" <?= ($_POST['role'] ?? '') === 'collaborateur' ? 'selected' : '' ?>>Collaborateur</option>
                <option value="client" <?= ($_POST['role'] ?? '') === 'client' ? 'selected' : '' ?>>Client</option>
                <option value="admin" <?= ($_POST['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Administrateur</option>
            </select>
            <div id="role_error" class="error-text hidden">Le rôle est obligatoire.</div>
            <label for="mot_de_passe">Mot de passe</label><br>
            <input id="mot_de_passe" name="mot_de_passe" type="password" placeholder="Mot de passe">
            <div id="mdp_error" class="error-text hidden">Le mot de passe est obligatoire.</div>
            <button type="submit">S'inscrire</button>
            <!-- Message de succès ou d'erreur affiché par PHP après traitement -->
            <?php if ($message !== "" && $message !== "erreur"): ?>
                <div class="valid-text"><?= $message ?></div>
            <?php elseif ($message === "erreur"): ?>
                <div class="error-text">Tous les champs sont obligatoires.</div>
            <?php endif; ?>
            <div id="creation_valide" class="valid-text hidden">Votre compte a été créé avec succès.</div>
        </form>
        <br>
        <a href="index.php" class="forgot-link">Déjà un compte ? Se connecter</a>
    </div>
    <script src="../js/app.js"></script>
</body>
</html>