<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>Panier</h1>

    <?php
    session_start();

    // Affiche le contenu du panier
    if (!empty($_SESSION['cart'])) {
        echo '<ul>';
        foreach ($_SESSION['cart'] as $item) {
            // Vérifie si l'élément est un tableau
            if (is_array($item)) {
                echo '<li> Titre:' . $item['name'] . ' - Prix: $' . $item['price'] . ' - Quantité: ' . $item['quantity'] . '</li>';
            } else {
                echo '<li> Erreur: élément de panier invalide </li>';
            }
        }
        echo '</ul>';
    } else {
        echo '<p>Le panier est vide.</p>';
    }
    ?>

    <!-- Ajoutez un lien pour vider le panier -->
    <br>
    <a href="vider_panier.php">Vider le panier</a>

    <!-- Ajoutez un lien pour revenir à la page principale -->
    <br>
    <a href="index.php">Retour à la page principale</a>
</body>
</html>
