<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once 'includes/connexion.php';

    if (isset($_GET['id'])) {
        try {
            $stmt = $pdo->prepare("DELETE FROM livres WHERE id_livre = ?");
            $stmt->execute([$_GET['id']]);
            header('Location: index.php?success=suppression');
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    } else {
        header('Location: index.php');
    }
    ?>
</body>

</html>