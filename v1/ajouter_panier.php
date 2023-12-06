<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Validez et filtrez les données du formulaire
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $product_name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
    $product_price = filter_input(INPUT_POST, 'product_price', FILTER_VALIDATE_FLOAT);

    // Vérifiez si les données sont valides
    if ($product_id !== false && $product_name !== null && $product_price !== false) {
        // Initialise le panier s'il n'existe pas encore
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Vérifie si le produit est déjà dans le panier
        $product_exists = false;
        foreach ($_SESSION['cart'] as &$item) {
            // Vérifie si l'élément est un tableau et a une clé 'id'
            if (is_array($item) && isset($item['id']) && $item['id'] === $product_id) {
                $item['quantity']++;
                $product_exists = true;
                break;
            }
        }

        // Si le produit n'est pas encore dans le panier, l'ajoute
        if (!$product_exists) {
            $product = [
                'id' => $product_id,
                'name' => $product_name,
                'price' => $product_price,
                'quantity' => 1
            ];
            $_SESSION['cart'][] = $product;
        }

        // Redirige vers la page de visualisation du panier
        header('Location: regarder_panier.php');
        exit();
    } else {
        // Gestion d'erreur si les données ne sont pas valides
        echo 'Erreur dans les données du formulaire.';
    }
} else {
    // Redirige vers la page d'accueil si la requête n'est pas POST ou si 'add_to_cart' n'est pas défini
    header('Location: index.php');
    exit();
}
?>
