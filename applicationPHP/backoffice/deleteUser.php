<!--
/**
    Auteurs : Clement Mourgue et Yannis Duvignau
    Description : suppression d'un utilisateur
*/
-->

<?php
//connexion
include_once "../gestionBD/creation_et_peuplement.php";
// Récupération des variables
$nomTableUser = $res[1];
$connexion = $res[2];
//recup id dans lien
$id = $_GET['id'];
//requete de delete
$req = mysqli_query($connexion, "DELETE FROM $nomTableUser WHERE id=$id");

echo '<script type="text/javascript">window.location = "./backofficeUsers.php";</script>';

?>