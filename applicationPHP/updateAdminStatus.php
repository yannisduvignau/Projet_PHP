<!--
/**
    Auteurs : Clement Mourgue et Yannis Duvignau
    Date :  du xx/xx au xx/xx
    Description : Page d'accueil du site de vente de CD en ligne
*/
-->

<?php

// Vérifier si la variable de session 'admin' existe
if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = false;
}

// Inverser le statut administrateur
$_SESSION['admin'] = !$_SESSION['admin'];

// Retourner le nouveau statut pour mettre à jour le bouton côté client
echo ($_SESSION['admin'] ? 'Désactiver Admin' : 'Activer Admin');
?>
