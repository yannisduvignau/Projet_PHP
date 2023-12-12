<?php session_start(); 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Simule le paiement (ajoute vos vérifications ici)
        if (isset($_POST['checkout'])) {
            $credit_card_number = $_POST['credit_card_number'];
            $expiration_date = $_POST['expiration_date'];

            // Effectue les vérifications nécessaires ici
            //On simulera le paiement en vérifiant la saisie des 16 chiffres et vérifiant que le dernier est identique au premier, et que la date de validité est supérieure à la date du jour + 3 mois.

            // Si tout est OK, affiche la confirmation
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
            border: 3px solid black;
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
            font-size: 2vw;
            font-family: sans-serif;
            color: white;
            text-shadow: 0px 0px 5px black;
            margin: 0;
            margin-top: 8%;
        }
        .arrow {
            position: absolute;
            top: 80%;
            left: 4%;
            width: 0; 
            height: 0; 
            border-top: 1.3vw solid transparent;
            border-bottom: 1.3vw solid transparent; 
            border-right:1.3vw solid white; 
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
            font-size: 1.1vw;
        }

        .card-expire {
            top: 82%;
            font-size: 1vw;
        }
        .bank-name {
            margin: 0;
            display: inline-block;
            padding: 2% 3%;
            padding-left: 2%;
            position: absolute;
            top: 10%;
            left: 0;
            font-size: 1.1vw;
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
        input{
            margin-bottom: 30px;
        }
        button{
            padding:10px 20px;
            background-color: black;
            color:white;
            /*font-weight: bold;*/
            font-size: 17px;
            position: relative;
            margin-top: 20px;
            left:40%;
            border-radius: 15px;
            cursor: pointer;
            border:none;
        }
        li{
            padding: 20px;
            box-shadow: 0px 3px 0px 0px #ccc;
        }
        .wrapper{
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 20px;
        }

        ul{
            grid-column: 1;
        }
        h3{
            grid-column: 1;
        }
        .container-placement{
            grid-column: 2;
            grid-row: 1;
        }
        .formulairePaiement{
            grid-column: 2;
        }
    </style>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Sélectionne les champs du formulaire
            const creditCardNumberInput = document.querySelector('input[name="credit_card_number"]');
            const expirationDateInput = document.querySelector('input[name="expiration_date"]');
            const cardNumberElement = document.querySelector('.card-number');
            const cardExpireElement = document.querySelector('.card-expire');
            const cardNameElement = document.querySelector('.card-name');

            // Écoute les événements de saisie sur le numéro de carte de crédit
            creditCardNumberInput.addEventListener('input', function () {
                // Obtene la valeur du champ
                let value = this.value;

                // Supprime tous les espaces de la valeur
                value = value.replace(/\s/g, '');

                // Limite le nombre de caractères à 16
                value = value.substr(0, 16);

                // Ajoute des espaces après chaque groupe de 4 chiffres
                value = value.replace(/(\d{4})/g, '$1 ').trim();

                // Met à jour la valeur du champ
                this.value = value;

                // Met à jour le numéro de carte sur la carte simulée
                cardNumberElement.textContent = value ? value.padEnd(16, '*').replace(/(.{4})/, '$1 ') : '0000 0000 0000 0000';
            });

            // Écoute les événements de saisie sur la date d'expiration
            expirationDateInput.addEventListener('input', function () {
                // Obtene la valeur du champ
                let value = this.value;

                // Supprime tous les caractères non numériques de la valeur
                value = value.replace(/\D/g, '');

                // Limite le nombre de caractères à 6 (MM/YYYY)
                value = value.substr(0, 6);

                // Ajoute le caractère "/" après les deux premiers chiffres
                value = value.replace(/(\d{2})(\d{0,4})/, '$1 / $2').trim();

                // Met à jour la valeur du champ
                this.value = value;

                // Met à jour la date d'expiration sur la carte simulée
                cardExpireElement.textContent = 'Expire ' + (value ? value : '00/00');
            });

            // Écoute les événements de saisie sur le nom et prénom
            document.querySelector('input[name="getName"]').addEventListener('input', function () {
                // Met à jour le nom sur la carte simulée
                cardNameElement.textContent = 'M ' + (this.value ? this.value : 'John Doe');
            });
        });
    </script>
</head>
<body>
    <img style="position:absolute;top:2%;right:5%;width:80px;height:auto;" src="images/logoCDIcon.png" alt="Logo"></img>
    <h1>Panier</h1>
        <?php
        

        // Affiche le contenu du panier
        if (!empty($_SESSION['panier'])) {
            $cptCds = 0;
            $prixTotal = 0;
            echo '<div class="wrapper">';
            echo '<ul>';
            foreach ($_SESSION['panier'] as $item) {
                // Vérifie si l'élément est un tableau
                if (is_array($item)) {
                    // Affichage contenu panier
                    echo '<li><img src="'.$item['image'].'" alt="titre" style="max-width:100px;">';
                    echo '<span style="margin-left:5%;"><b><i>Titre</i> :</b> ' . $item['titre'] . '&nbsp;&nbsp;&nbsp - <b>Prix :</b> $' . $item['prix'] . ' - <i>Quantité</i> : ' . $item['quantite'] . '</span><span style="margin-left:25%;"> <b>Sous-total :</b> $' . $item['prix']*$item['quantite'] . '</span></li>';
                    $cptCds += $item['quantite'];
                    $prixTotal += $item['prix']*$item['quantite'];
                } else {
                    echo '<li> Erreur: élément de panier invalide </li>';
                }
            }
            echo '</ul>';
            // Affichage total
            echo '<h3>Nombre de CD total : ' . $cptCds . '</br><span style="diplay:inline-block;">Prix total : $' . $prixTotal . '</h3>';
            

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
            echo '<p class="card-expire">Expire 00 / 00</p>';
            echo '<p class="bank-name">Bank 1337</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            //Formulaire
            echo '<form method="post" action="regarder_panier.php" class="formulairePaiement">';
            echo '<label for="getName">Nom et Prénom : </label></br>';
            echo '<input type="text" placeholder="NOM PRENOM" name="getName" required></br>';
            echo '<label for="credit_card_number" required minlength="12" maxlength="12">Credit Card Number : </label></br>';
            echo '<input type="text" placeholder="XXXX XXXX XXXX XXXX" name="credit_card_number" required></br>';
            echo "<label for='expiration_date'>Date d'expiration : </label></br>";
            echo '<input type="text" placeholder="MM / YYYY" name="expiration_date" required></br>';
            echo '<button type="submit" name="checkout" class="lienImportant">Valider</button>';
            echo '</form>';
            echo ' </div>';
            echo '</br></br></br>
            <!-- Ajoute un lien pour vider le panier -->
            <span><a href="vider_panier.php" class="lienImportant">Vider le panier</a></span>';
        } else {
            echo '<p>Le panier est vide.</p>';
        }
        ?>

    <!-- Ajoute un lien pour revenir à la page principale -->
    <span><a href="index.php" class="lienImportant">Retour à la page principale</a></span>
</body>
</html>
