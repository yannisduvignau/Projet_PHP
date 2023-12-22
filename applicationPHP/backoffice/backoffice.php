<?php session_start(); ?>

<!--
/**
    Auteurs : Clement Mourgue et Yannis Duvignau
    Description : choix du backoffice (cd ou utilisateur)
*/
-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Backoffice CD Store</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php if(isset($_SESSION['login']) && isset($_SESSION['pseudo']))
    {
        echo '<script>console.log("Connecté");</script>';
        echo '<p style="position:absolute;top:4%;right:12%;">'.$_SESSION['pseudo'].'</p>';
        echo '<a href="../connexion/logout.php" class="lienImportant" style="position:absolute;top:2%;">Déconnexion</a>';
    }
    else {
        echo '<script>console.log("Non connecté");</script>';
    }
    ?>

    <!-- Si easteregg pour mode amdin <a id="adminButton" href="backoffice/backoffice.php" class="lienImportant" style="visibility:hidden;position:absolute;top:2%;">Aller au BackOffice</a> -->
    <a href="../connexion/pageConnexion.php"><img style="position:absolute;top:2%;right:5%;width:80px;height:auto;" src="../images/logoCDIcon.png" alt="Logo" href="connexion/pageConnexion.php"></img></a>
    <div style="display:unset !important;position:absolute;top:50%;left:40%;width:600px;">
        <span><a class="lienImportant" href="backOfficeCds.php">backoffice cds</a></span>
        <span><a class="lienImportant" href="backOfficeUsers.php">backoffice users</a></span>
    </div>
</body>
</html>