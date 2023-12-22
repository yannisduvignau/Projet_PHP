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

            input[type=radio]{
                transition: 0.1s all linear;
            }

            input[type=radio]:hover{
                border: black;
            }

            input[type=radio]:checked{
                border: 6px solid purple;
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

    <img style="position:absolute;top:2%;right:5%;width:80px;height:auto;" src="../images/logoCDIcon.png" alt="Logo"></img>
    <h1>CD Store</h1>
    <p>=> Un site web de vente de CD (oui, oui, ça existe encore !) en ligne</p>
    <br/><br/><br/><br/>
    <form action="inscription.php" method="post">
        Votre login : 
        <?php if(isset($_POST['login'])){
            echo '<input type="text" name="login" value="'.$_POST['login'].'" required>';
        }
        else {
            echo '<input type="text" name="login" required>';
        } ?>
        <br/> <br/>
        Votre mot de passe : 
        <input type="password" name="pwd" required>
        <br/> <br/>
        Votre pseudo : 
        <input type="text" name="pseudo" required>
        <br/> <br/>
        Êtes-vous admin ? 
        <select name="admin">
            <option value="0">Non</option>
            <option value="1">Oui</option>
        </select>
        <br/> <br/>
        <input type="submit" value="S'inscrire" class="lienImportant">
    </form>
    <br/><br/>
    <button type="button" class="lienImportant" onclick="window.location='pageConnexion.php';" style="position:absolute;left:45%;">Se connecter</button>
            <br/><br/>
    <button type="button" class="lienImportant" onclick="window.location='../index.php';">Retour à la page principale</button>
</body>
</html>