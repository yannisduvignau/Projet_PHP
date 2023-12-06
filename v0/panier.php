<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajoutez le CD au panier
    if (isset($_POST['add_to_cart'])) {
        $cd = simplexml_load_string($_POST['cd']);
        $_SESSION['cart'][] = $cd;
    }

    // Simulez le paiement (ajoutez vos vérifications ici)
    if (isset($_POST['checkout'])) {
        $credit_card_number = $_POST['credit_card_number'];
        $expiration_date = $_POST['expiration_date'];

        // Effectuez les vérifications nécessaires ici

        // Si tout est OK, affichez la confirmation
        header('Location: confirmation.php');
        exit();
    }
}

// Affichez le contenu du panier
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>

    <?php
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cd) {
            echo '<div>';
            echo '<img src="' . $cd->image . '" alt="' . $cd->title . '">';
            echo '<h2>' . $cd->title . '</h2>';
            echo '<p>' . $cd->artist . '</p>';
            echo '</div>';
        }

        // Formulaire de paiement simulé
        echo '<form method="post" action="panier.php">';
        echo '<label for="credit_card_number">Credit Card Number:</label>';
        echo '<input type="text" name="credit_card_number" required>';
        echo '<label for="expiration_date">Expiration Date (MM/YYYY):</label>';
        echo '<input type="text" name="expiration_date" required>';
        echo '<button type="submit" name="checkout">Checkout</button>';
        echo '</form>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
    ?>

    <a href="index.php">Back to CD Store</a>
</body>
</html>
