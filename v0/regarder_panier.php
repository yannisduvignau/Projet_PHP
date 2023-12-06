<?php session_start(); ?>
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
    

    // Affiche le contenu du panier
    if (!empty($_SESSION['panier'])) {
        $cptCds = 0;
        $prixTotal = 0;
        echo '<ul>';
        foreach ($_SESSION['panier'] as $item) {
            // Vérifie si l'élément est un tableau
            if (is_array($item)) {
                // Affichage contenu panier
                echo '<li> Titre : ' . $item['titre'] . ' - Prix : $' . $item['prix'] . ' - Quantité : ' . $item['quantite'] . '<span style="diplay:inline-block;margin-left: 40px;">Sous-total : $' . $item['price']*$item['quantity'] . '</span></li>';
                $cptCds += $item['quantite'];
                $prixTotal += $item['prix']*$item['quantite'];
            } else {
                echo '<li> Erreur: élément de panier invalide </li>';
            }
        }
        echo '</ul>';
        // Affichage total
        echo '<h3>NB ITEM TOTAL : ' . $cptCds . '<span style="diplay:inline-block;margin-left: 20px;">PRIX TOTAL : $' . $prixTotal . '</h3>';
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
