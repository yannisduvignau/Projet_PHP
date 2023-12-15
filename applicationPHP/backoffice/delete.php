<?php
//connexion
include_once "../gestionBD/database.php";
//recup id dans lien
$id = $_GET['id'];
//requete de delete
$req = mysqli_query($connexion, "DELETE FROM cd WHERE id=$id");
//redirection vers page
header("Location: backoffice.php");
?>