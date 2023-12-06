<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_qte = $_POST['product_qte'];

        // Initialise le panier s'il n'existe pas encore
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Vérifie si le produit est déjà dans le panier
        $product_exists = false;
        foreach ($_SESSION['cart'] as &$item) {
            // Vérifie si l'élément est un tableau et a une clé 'id'
            if (is_array($item) && isset($item['id']) && $item['id'] === $product_id) {
                $item['quantity'] = $item['quantity'] + $product_qte;
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
                'quantity' => $product_qte
            ];
            $_SESSION['cart'][] = $product;
        }
    }
}

// Redirige vers la page de visualisation du panier
header('Location: regarder_panier.php');
exit();
?>
