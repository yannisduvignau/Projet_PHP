<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ajouter_panier'])) {
        $produit_id = $_POST['produit_id'];
        $produit_titre = $_POST['produit_titre'];
        $produit_prix = $_POST['produit_prix'];
        $produit_qte = $_POST['produit_qte'];

        // Initialise le panier s'il n'existe pas encore
        if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }

        // Vérifie si le produit est déjà dans le panier
        $product_exists = false;
        foreach ($_SESSION['panier'] as &$item) {
            // Vérifie si l'élément est un tableau et a une clé 'id'
            if (is_array($item) && isset($item['id']) && $item['id'] === $produit_id) {
                $item['quantite'] = $item['quantite'] + $produit_qte;
                $product_exists = true;
                break;
            }
        }

        // Si le produit n'est pas encore dans le panier, l'ajoute
        if (!$product_exists) {
            $produit = [
                'id' => $produit_id,
                'titre' => $produit_titre,
                'prix' => $produit_prix,
                'quantite' => $produit_qte
            ];
            $_SESSION['cart'][] = $produit;
        }
    }
}

// Redirige vers la page de visualisation du panier
header('Location: regarder_panier.php');
exit();
?>
