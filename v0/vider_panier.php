<!--
/**
    Auteurs : Clement Mourgue et Yannis Duvignau
    Date :  du xx/xx au xx/xx
    Description : Page d'accueil du site de vente de CD en ligne
*/
-->

<?php
session_start();

// Vérifie si la variable de session 'cart' existe
if (isset($_SESSION['panier'])) {
    // Supprime la variable de session 'cart'
    unset($_SESSION['panier']);
}

// Redirige vers la page de visualisation du panier
header('Location: index.php');
exit();
?>