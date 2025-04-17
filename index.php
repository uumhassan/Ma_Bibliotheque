    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ma Bibliothèque</title>
    </head>

    <body>
        <h1>Ma Bibliothèque</h1>
        <div>
            <!-- Lien vers la page d'ajout -->
            <a href="ajouter.php">Ajouter un livre</a>
            <!-- Lien vers la page de modification -->
            <a href='modifier.php?id=<?= $livre['id_livre'] ?>">'>Modifier</a> |
            <!-- Lien vers la page de suppression-->
            <a href="supprimer.php?id=<?= $livre['id_livre'] ?>"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">Supprimer</a>
            <a href="auteurs/index.php">Gérer les auteurs</a>
        </div>

        <table border="1">
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>

            <?php
            // Connexion à la BDD
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=mabibliotheque', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connexion réussie!";

                // Jointure avec la table auteurs
                $livres = $pdo->query("
                    SELECT 
                        l.id_livre, 
                        l.titre, 
                        l.annee_publication, 
                        l.statut,
                        a.nom, 
                        a.prenom, 
                        a.nationalite
                    FROM livres l
                    JOIN auteurs a ON l.id_auteur = a.id_auteur
                    ORDER BY l.titre
                ");

                if ($livres->rowCount() > 0) {
                    while ($livre = $livres->fetch()) {
                        echo "
                        <tr>
                            <td>" . htmlspecialchars($livre['titre']) . "</td>
                            <td>" . htmlspecialchars($livre['prenom']) . ' ' . htmlspecialchars($livre['nom']) . "</td>
                            <td>" . htmlspecialchars($livre['annee_publication']) . "</td>
                            <td>" . htmlspecialchars($livre['statut']) . "</td>
                            <td>
                                <a href='modifier.php?id=" . $livre['id_livre'] . "'>Modifier</a> |
                                <a href='supprimer.php?id=" . $livre['id_livre'] . "'
                                onclick=\"return confirm('Êtes-vous sûr ?')\">Supprimer</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun livre trouvé</td></tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='5'>Erreur : " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </table>
    </body>

    </html>