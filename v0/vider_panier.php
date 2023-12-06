<?php
session_start();

// Vérifie si la variable de session 'cart' existe
if (isset($_SESSION['panier'])) {
    // Supprime la variable de session 'cart'
    unset($_SESSION['panier']);
}

// Redirige vers la page de visualisation du panier
header('Location: regarder_panier.php');
exit();
?>