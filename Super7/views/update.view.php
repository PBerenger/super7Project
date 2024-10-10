<?php
ob_start();
$authManager = new AuthManager();
$authManager->startSession();
$userController = new UserController();
?>

<h2 class="titreUpdate">Modifier les informations</h2>

<div class="form-container-update">
    <?php if (isset($utilisateur)) : ?>
        <form method="POST" enctype="multipart/form-data" action="<?= URL ?>update">
            <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($utilisateur['id_user']); ?>">
            <input type="hidden" name="currentImage" value="<?php echo htmlspecialchars($utilisateur['image_name'] ?? 'default.jpg'); ?>">

            <div class="inputBx">
                <input type="text" name="nom" placeholder="Entrez votre nom" value="<?php echo htmlspecialchars($utilisateur['u_lname'] ?? ''); ?>" required><br>
            </div>
            <div class="inputBx">
                <input type="text" name="prenom" placeholder="Entrez votre Prénom" value="<?php echo htmlspecialchars($utilisateur['u_fname'] ?? ''); ?>" required><br>
            </div>
            <div class="inputBx">
                <input type="email" name="email" placeholder="Entrez votre Mail" value="<?php echo htmlspecialchars($utilisateur['u_email'] ?? ''); ?>" required><br>
            </div>
            <div class="inputBx">
                <input type="text" name="telephone" placeholder="Votre numéro de téléphone" value="<?php echo htmlspecialchars($utilisateur['u_phone'] ?? ''); ?>" required><br>
            </div>
            <div class="inputBx">
                <input type="date" name="dateNaissance" value="<?php echo htmlspecialchars($utilisateur['u_Date_Birth'] ?? ''); ?>" required>
            </div>
            <div class="inputBx">
                <input type="password" id="passwordSaisie" oninput="verifPassword()" name="password" placeholder="Mot de passe">
                <button type="button" id="togglePassword">
                    <img class="eyePSW" src="../public/images/all/eyesOpen.png" alt="Afficher le mot de passe">
                </button>
            </div>
            <select id="genre" name="genre" required>
                <option value="" disabled selected>Genre</option>
                <option value="masculin">Masculin</option>
                <option value="féminin">Féminin</option>
                <option value="autre">Autre</option>
            </select>
            <?php if (isset($_SESSION['id_user']) && $userController->isAdmin()) : ?>
                <select name="role" required>
                    <option value="" disabled selected>Rôle</option>
                    <option value='admin'>Admin</option>
                    <option value='non-admin'>Non-Admin</option>
                </select><br>
            <?php endif; ?>
            <div class="inputBx">
                <label for="file-upload" class="parcourir">Télécharger une image de profil</label>
                <input id="file-upload" type="file" name="image" /><br>
            </div>
            <div class="inputBx">
                <input type="submit" value="Mettre à jour">
            </div>
        </form>
    <?php else : ?>
        <p>Utilisateur non trouvé.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . "/template.php";
