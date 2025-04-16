<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un livre</title>
</head>

<body>
    <h1>Modifier un livre</h1>

    <form method="post" action="traitement_modif.php">
        <input type="hidden" name="id_livre" value="<?= $livre['id_livre'] ?>">

        <label>
            Titre :
            <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>
        </label><br>

        <label>
            Année de publication :
            <input type="number" name="annee" value="<?= htmlspecialchars($livre['annee_publication']) ?>" required>
        </label><br>

        <label>
            Auteur :
            <select name="id_auteur" required>
                <?php
                $auteurs = $pdo->query("SELECT * FROM auteurs");
                foreach ($auteurs as $auteur) {
                    $selected = ($auteur['id_auteur'] == $livre['id_auteur']) ? 'selected' : '';
                    echo '<option value="' . $auteur['id_auteur'] . '" ' . $selected . '>'
                        . htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom'])
                        . '</option>';
                }
                ?>
            </select>
        </label><br>

        <input type="submit" value="Enregistrer les modifications">
    </form>

    <a href="index.php">Retour à la liste</a>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un livre</title>
</head>

<body>
    <h1>Modifier un livre</h1>

    <form method="post" action="traitement_modif.php">
        <input type="hidden" name="id_livre" value="<?= $livre['id_livre'] ?>">

        <label>
            Titre :
            <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>
        </label><br>

        <label>
            Année de publication :
            <input type="number" name="annee" value="<?= htmlspecialchars($livre['annee_publication']) ?>" required>
        </label><br>

        <label>
            Auteur :
            <select name="id_auteur" required>
                <?php
                $auteurs = $pdo->query("SELECT * FROM auteurs");
                foreach ($auteurs as $auteur) {
                    $selected = ($auteur['id_auteur'] == $livre['id_auteur']) ? 'selected' : '';
                    echo '<option value="' . $auteur['id_auteur'] . '" ' . $selected . '>'
                        . htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom'])
                        . '</option>';
                }
                ?>
            </select>
        </label><br>

        <input type="submit" value="Enregistrer les modifications">
    </form>

    <a href="index.php">Retour à la liste</a>
</body>

</html>