<?php session_start();

if(isset($_SESSION['login']) && isset($_SESSION['pseudo']))
{
    echo '<script>alert("Vous étiez déjà connecté et vous avez donc été déconnecté de votre ancien profil pour pouvoir en créer un nouveau.");</script>';
    // On déconnecte et réinitialise la session
    // On détruit les variables de notre session
    session_unset ();

    // On détruit notre session
    session_destroy ();
}

// Inclusion de la base de données
include_once "../gestionBD/creation_et_peuplement.php";
// Récupération des variables
$nomTableUser = $res[1];
$connexion = $res[2];

// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd']) && isset($_POST['pseudo']) && isset($_POST['admin'])) {
    $idLogin = $_POST['login'];
    $pwdLogin = $_POST['pwd'];
    $pseudo = $_POST['pseudo'];
    $isAdmin = $_POST['admin'];

    // Requête pour compter le nombre de lignes dans la table
    $resultat = $connexion->query("SELECT COUNT(*) as total FROM $nomTableUser WHERE nom = '$idLogin' AND pwd = '$pwdLogin'");
    $row = mysqli_fetch_assoc($resultat);
    $totalLignes = $row['total'];

    // Vérifier si l'enregistrement n'est pas déjà présent
    if ($totalLignes == 0) {

        $sql = "INSERT INTO $nomTableUser (nom,pseudo,pwd,admin) VALUES ('$idLogin','$pseudo','$pwdLogin',$isAdmin);";

        if ($connexion->query($sql) === TRUE) {
            echo '<script type="text/javascript">console.log("Données ajoutées avec succès");</script>
            <script>alert("Données ajoutées avec succès");</script>';
        } else {
            echo '<script type="text/javascript">console.log("Erreur lors de l`ajout des données. Attention le pseudo doit être unique");</script>
            <script>alert("Erreur lors de l`ajout des données. Attention le pseudo doit être unique");</script>';
        }
    }else{
        echo '<script type="text/javascript">console.log("Profil déjà présent");</script>';
    }

    echo '
    <form action="login.php" method="post" style="visibility:hidden;">
        <input type="text" name="login" value="'.$idLogin.'">
        <input type="password" name="pwd" value="'.$pwdLogin.'">
        <input type="text" name="pseudo" value="'.$pseudo.'">
        <input type="number" name="admin" value="'.$isAdmin.'">
    </form>';
    echo '<script>document.querySelector("form").submit();</script>';
}
else
{
    echo '<body onLoad="alert(\'Information manquante...\')">';
        // puis on le redirige vers la page d'accueil
        echo '<meta http-equiv="refresh" content="0;URL=pageInscription.php">';
}
?>