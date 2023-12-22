<?php session_start();
/*
    Auteurs : Clement Mourgue et Yannis Duvignau
    Description : Suppresion du panier en cours
*/

// Vérifie si la variable de session 'cart' existe
if (isset($_SESSION['panier'])) {
    // Supprime la variable de session 'cart'
    unset($_SESSION['panier']);
}

// Redirige vers la page de visualisation du panier
header('Location: index.php');
exit();
?>