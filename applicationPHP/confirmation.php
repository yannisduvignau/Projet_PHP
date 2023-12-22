<!--
/**
    Auteurs : Clément Mourgue et Yannis Duvignau
    Description : Page de confirmation (validation du paiement)
*/
-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de votre achat</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <style>
        body {
            text-align: center;
        }
        .container{
            width: 300px;
            height: 50vh;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
            text-align: center;
        }
        .top{
            height: 25vh;
            width: 100%;
            background-color: #333;
            color: white;
            border-radius: 10px 10px 0 0;
        }
        img{
            font-size: 40px;
            margin-top: 7vh;
            width: 20%;
        }
        h3{
            margin-top: 20px;
        }
        p{
            margin-top: 5vh;
            padding: 0 10px;
            color: #333;
        }
    </style>
</head>
<body>
    <img style="position:absolute;top:-2%;right:5%;width:80px;height:auto;" src="images/logoCDIcon.png" alt="Logo"></img>
    <h1 style="margin-top:10vh;">Commande confirmée !</h1>
    <p>Merci pour votre achat. Votre commande a été confirmée.</p>
    <img style="top: 20%; left: 40%;margin-top:5%;" src="images/shopping.gif" width="20%" height="auto" alt="shopping image"></img></br>
    <a id="backToIndex" class="lienImportant" href="vider_panier.php">Retour au CD Store</a>
</body>
</html>
