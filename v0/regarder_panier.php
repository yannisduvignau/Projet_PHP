<?php session_start(); 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Simulez le paiement (ajoutez vos vérifications ici)
        if (isset($_POST['checkout'])) {
            $credit_card_number = $_POST['credit_card_number'];
            $expiration_date = $_POST['expiration_date'];

            // Effectuez les vérifications nécessaires ici
            //On simulera le paiement en vérifiant la saisie des 16 chiffres et vérifiant que le dernier est identique au premier, et que la date de validité est supérieure à la date du jour + 3 mois.

            // Si tout est OK, affichez la confirmation
            header('Location: confirmation.php');
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <style>
        input[type="text"]{
            outline: none;
            border: 3px solid #ccc;
            padding: 10px 20px;
        }
        input[type="text"]:focus{
            border: 3px solid #555;
        }
        /*Carte de crédit*/
        .container-placement{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card-container {
            box-sizing: border-box;
            background: #34495e;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            position: relative;
            box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.1); 
            border-bottom: 6px solid #2c3e50;
            border-right: 6px solid #2c3e50;
            transition: 0.5s transform, 0.5s box-shadow;
        }

        .card-container:hover {
            transform: scale(1.1) rotate(3deg);
            box-shadow: 10px 10px 10px 5px rgba(0,0,0,0.3); 
        }

        .card {
            position: relative;
            padding-top: 60%;
            overflow: hidden;
        }
        .chip {
            position: absolute;
            top: 35%;
            left: 5%;
            height: 23%;
        }

        .contactless {
            position: absolute;
            top: 40%;
            left: 20%;
            height: 15%;
            transform: rotate(90deg);
        }

        .visa {
            position: absolute;
            bottom: 5%;
            right: 5%;
            height: 30%;
        }
        .card-number {
            position: absolute;
            top: 50%;
            left: 5%;
            font-size: 1.7rem;
            font-family: sans-serif;
            color: white;
            text-shadow: 0px 0px 5px black;
        }
        .arrow {
            position: absolute;
            top: 80%;
            left: 5%;
            width: 0; 
            height: 0; 
            border-top: 15px solid transparent;
            border-bottom: 15px solid transparent; 
            border-right:15px solid white; 
        }
        .card-name, .card-expire {
            position: absolute;
            left: 10%;
            font-family: sans-serif;
            color: white;
            text-transform: uppercase;
            text-shadow: 0px 0px 3px black;
        }

        .card-name {
            top: 74%;
            font-size: 0.9rem;
        }

        .card-expire {
            top: 82%;
            font-size: 0.8rem;
        }
        .bank-name {
            margin: 0;
            display: inline-block;
            padding: 8px 10px;
            padding-left: 2%;
            position: absolute;
            top: 10%;
            left: 0;
            font-size: 1rem;
            font-family: sans-serif;
            color: black;
            font-weight: bold;
            background-color: white;
            min-width: 30%;
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
        }
        .card::before {
            content: "";
            position: absolute;
            display: inline-block;
            background-color: white;
            width: 50%;
            height: 5%;
            left: 0;
            top: 26%;
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
            opacity: 0.5;
        }

        .card::after {
            content: "";
            position: absolute;
            display: block;
            background-color: white;
            width: 200px;
            height: 200px;
            right: -75px;
            top:-75px;
            border-radius: 50%;
            opacity: 0.05;
        }
        
    </style>
</head>
<body>
    <img style="position:absolute;top:2%;right:5%;width:80px;height:auto;" src="images/logoCDIcon.png" alt="Logo"></img>
    <h1>Panier</h1>
    
    <?php
    

    // Affiche le contenu du panier
    if (!empty($_SESSION['panier'])) {
        $cptCds = 0;
        $prixTotal = 0;
        echo '<ul>';
        foreach ($_SESSION['panier'] as $item) {
            // Vérifie si l'élément est un tableau
            if (is_array($item)) {
                // Affichage contenu panier
                echo '<li> Titre : ' . $item['titre'] . ' - Prix : $' . $item['prix'] . ' - Quantité : ' . $item['quantite'] . '<span style="diplay:inline-block;margin-left: 40px;">Sous-total : $' . $item['prix']*$item['quantite'] . '</span></li>';
                $cptCds += $item['quantite'];
                $prixTotal += $item['prix']*$item['quantite'];
            } else {
                echo '<li> Erreur: élément de panier invalide </li>';
            }
        }
        echo '</ul>';
        // Affichage total
        echo '<h3>NB ITEM TOTAL : ' . $cptCds . '<span style="diplay:inline-block;margin-left: 20px;">PRIX TOTAL : $' . $prixTotal . '</h3>';
        

        // Formulaire de paiement simulé
        //Carte de paiement
        echo '<div class="container-placement">';
        echo '<div class="card-container">';
        echo '<div class="card">';
        echo '<img class="chip" src="images/chip.png"/>';
        echo '<img class="contactless" src="images/wifi.png"/>';
        echo '<img class="visa"src="images/visa.png"/>';
        echo '<p class="card-number">0000 0000 0000 0000</p>';
        echo '<div class="arrow"></div>';
        echo '<p class="card-name">M John Doe</p>';
        echo '<p class="card-expire">Expire 00/00</p>';
        echo '<p class="bank-name">Bank 1337</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        //Formulaire
        echo '<form method="post" action="regarder_panier.php">';
        echo '<label for="getName">Nom et Prénom(NOM PRENOM) : </label>';
        echo '<input type="text" name="getName" required><br>';
        echo '<label for="credit_card_number" required minlength="12" maxlength="12">Credit Card Number : </label>';
        echo '<input type="text" placeholder="XXXX XXXX XXXX XXXX" name="credit_card_number" required><br/>';
        echo '<label for="expiration_date">Expiration Date (MM/YYYY) : </label>';
        echo '<input type="text" name="expiration_date" required><br>';
        echo '<button type="submit" name="checkout">Checkout</button>';
        echo '</form>';
    
    } else {
        echo '<p>Le panier est vide.</p>';
    }
    ?>

    <!-- Ajoutez un lien pour vider le panier -->
    <br><br/>
    <a href="vider_panier.php" class="lienImportant">Vider le panier</a>

    <!-- Ajoutez un lien pour revenir à la page principale -->
    <br><br/>
    <a href="index.php" class="lienImportant">Retour à la page principale</a>
</body>
</html>
