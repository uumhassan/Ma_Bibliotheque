<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un livre</title>
</head>

<body>
    <h2>Ajouter un livre</h2>
    <form method="post" action="traitement_ajout.php">
        Titre: <input type="text" name="titre" required><br>
        Année: <input type="number" name="annee" required><br>
        Auteur:
        <select name="id_auteur" required>
            <?php foreach ($auteurs as $auteur): ?>
                <option value="<?= $auteur['id_auteur'] ?>">
                    <?= htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input type="submit" value="Ajouter">
    </form>
</body>

</html>