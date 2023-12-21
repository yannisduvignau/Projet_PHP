<?php session_start ();
if(isset($_SESSION['login']) && isset($_SESSION['pseudo']))
{
    echo '<script>alert("Vous étiez déjà connecté et vous avez donc été déconnecté de votre ancien profil.");</script>';
    // On déconnecte et réinitialise la session
    // On détruit les variables de notre session
    session_unset ();

    // On détruit notre session
    session_destroy ();

    // On relance la sesion
    session_start();
}

// Inclusion de la base de données
include_once "../gestionBD/creation_et_peuplement.php";
// Récupération des variables
$nomTableUser = $res[1];
$connexion = $res[2];

// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])) {
    $idLogin = $_POST['login'];
    $pwdLogin = $_POST['pwd'];

    $sql = "SELECT * FROM $nomTableUser WHERE nom = '$idLogin' AND pwd = '$pwdLogin'";
    $result = mysqli_query($connexion, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // Enregistrement dans la session
        $_SESSION['login'] = $idLogin;
        $_SESSION['admin'] = $row['admin'];
        $_SESSION['pseudo'] = $row['pseudo'];
        // Pour test
        echo '<script>alert("Connexion réussie en tant que '.$_SESSION['login'].'  '.$_SESSION['admin'].'   '.$_SESSION['pseudo'].'");</script>';

        // Connecté donc redirection vers la page principale
        //echo '<script>window.location="../index.php";</script>';
        echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
    }
    else
    {
        // Non présent dans les utilisateurs
        echo '<body onLoad="alert(\'Membre non reconnu...\')">';
        // puis on le redirige vers la page d'accueil
        echo '<meta http-equiv="refresh" content="0;URL=pageInscription.php">';
    }
}
else
{
    //header('location: pageInscription.php');
    echo '<script>window.location="pageInscription.php";</script>';
}
?>