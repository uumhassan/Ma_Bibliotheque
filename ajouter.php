<?php require_once 'includes/connexion.php'; ?>

<h2>Ajouter un livre</h2>
<form method="post" action="traitement_ajout.php">
    Titre : <input type="text" name="titre" required><br>
    Année : <input type="number" name="annee" required><br>
    Auteur :
    <select name="id_auteur" required>
        <?php
        $auteurs = $pdo->query("SELECT * FROM auteurs");
        foreach ($auteurs as $auteur) {
            echo '<option value="' . $auteur['id_auteur'] . '">';
            echo htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom']);
            echo '</option>';
        }
        ?>
    </select><br>
    <input type="submit" value="Ajouter">
</form>