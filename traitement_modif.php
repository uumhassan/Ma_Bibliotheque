<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un livre</title>
</head>

<body>
    <?php
    require_once 'includes/connexion.php';

    // Partie TRAITEMENT du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupère les données du formulaire
        $id_livre = $_POST['id_livre'];
        $titre = $_POST['titre'];
        $annee = $_POST['annee'];
        $id_auteur = $_POST['id_auteur'];

        // Validation minimale
        if (empty($titre)) {
            die("Le titre est obligatoire");
        }

        // Met à jour la BDD
        try {
            $stmt = $pdo->prepare("UPDATE livres SET titre = ?, annee_publication = ?, id_auteur = ? WHERE id_livre = ?");
            $stmt->execute([$titre, $annee, $id_auteur, $id_livre]);

            // Redirection après succès
            header('Location: index.php?success=1');
            exit;
        } catch (PDOException $e) {
            die("Erreur lors de la modification : " . $e->getMessage());
        }
    }

    // Partie AFFICHAGE du formulaire
    $id_livre = $_GET['id'] ?? null;
    if (!$id_livre) {
        header('Location: index.php');
        exit;
    }

    try {
        // Récupère le livre à modifier
        $stmt = $pdo->prepare("SELECT * FROM livres WHERE id_livre = ?");
        $stmt->execute([$id_livre]);
        $livre = $stmt->fetch();

        if (!$livre) {
            die("Livre non trouvé");
        }

        // Récupère tous les auteurs pour la liste déroulante
        $auteurs = $pdo->query("SELECT * FROM auteurs")->fetchAll();
    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
    ?>

    <h1>Modifier un livre</h1>

    <form method="post">
        <input type="hidden" name="id_livre" value="<?= $livre['id_livre'] ?>">

        <label>
            Titre :
            <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>
        </label><br>

        <label>
            Année :
            <input type="number" name="annee" value="<?= htmlspecialchars($livre['annee_publication']) ?>" required>
        </label><br>

        <label>
            Auteur :
            <select name="id_auteur" required>
                <?php foreach ($auteurs as $auteur): ?>
                    <option value="<?= $auteur['id_auteur'] ?>"
                        <?= ($auteur['id_auteur'] == $livre['id_auteur']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>

        <button type="submit">Enregistrer</button>
    </form>

    <a href="index.php">Retour</a>
</body>

</html>