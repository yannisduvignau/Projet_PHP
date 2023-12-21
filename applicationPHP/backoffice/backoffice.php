<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD Store</title>
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

    <br/>
    <br/><br/><br/>
    <br/><br/><br/>
    <br/><br/><br/>
    <br/><br/>
    <a class="lienImportant" href="backOfficeCds.php">backoffice cds</a>
    <br/><br/>
    <br/><br/><br/>
    <br/><br/><br/>
    <br/><br/>
    <a class="lienImportant" href="backOfficeUsers.php">backoffice users</a>
</body>
</html>