<!--
/**
    Auteurs : Clement Mourgue et Yannis Duvignau
    Description : suppression d'un cd
*/
-->

<?php
//connexion
include_once "../gestionBD/database.php";
//recup id dans lien
$id = $_GET['id'];
//requete de delete
$req = mysqli_query($connexion, "DELETE FROM CD WHERE id=$id");

echo '<script type="text/javascript">window.location = "./backofficeCds.php";</script>';

?>