<?php
//connexion
include_once "../gestionBD/database.php";
//recup id dans lien
$id = $_GET['id'];
//requete de delete
$req = mysqli_query($connexion, "DELETE FROM CD WHERE id=$id");
//redirection vers page
//header("Location: backoffice.php");
echo '<script type="text/javascript">window.location = "./backoffice.php";</script>';

?>