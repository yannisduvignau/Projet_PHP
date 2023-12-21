<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CD Store</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <style>
            form{
                text-align:center;
                font-family: 'Open Sans', sans-serif;
            }
        </style>
    </head>
<body>
    <?php if(isset($_SESSION['login']) && isset($_SESSION['pseudo'])/* && isset($_SESSION['pwd']) */)
    {
        echo '<script>console.log("Déjà connecté");</script>';
        echo '<p style="position:absolute;top:4%;right:12%;">'.$_SESSION['pseudo'].'</p>';
        echo '<a href="logout.php" class="lienImportant" style="position:absolute;top:2%;">Déconnexion</a>';
        if($_SESSION['admin']){
            echo '<a id="adminButton" href="../backoffice/backoffice.php" class="lienImportant" style="visibility:visible;position:absolute;top:2%;left:13%">Aller au BackOffice</a>';
        }
    }
    else {
        echo '<script>console.log("Non connecté");</script>';
    }
    ?>
    <!-- ?php
    if(isset($_SESSION['login']) && isset($_SESSION['pseudo']))
    {
        echo '<script>alert("Vous étiez déjà connecté et vous avez donc été déconnecté.");</script>';
        // On déconnecte et réinitialise la ession
        // On détruit les variables de notre session
        session_unset ();

        // On détruit notre session
        session_destroy ();
    }
    ?> -->


    <img style="position:absolute;top:2%;right:5%;width:80px;height:auto;" src="../images/logoCDIcon.png" alt="Logo"></img>
    <h1>CD Store</h1>
    <p>=> Un site web de vente de CD (oui, oui, ça existe encore !) en ligne</p>
    <br/><br/>
    <form action="login.php" method="post">
        Votre login : 
        <input type="text" name="login" required>
        <br/> <br/>
        Votre mot de passe : 
        <input type="password" name="pwd" required>
        <br/> <br/>
        <input type="submit" value="Connexion" class="lienImportant">
    </form>
    <br/><br/>
    <button type="button" class="lienImportant" onclick="window.location='pageInscription.php';" style="position:absolute;left:45%;">S'inscrire</button>
            <br/><br/>
    <button type="button" class="lienImportant" onclick="window.location='../index.php';">Retour à la page principale</button>
</body>
</html>