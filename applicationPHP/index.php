<?php session_start(); ?>
<!-- Nécesssaire à cet emplacement pour ne pas provoquer d'erreur
/**
    Auteurs : Clement Mourgue et Yannis Duvignau
    Date :  du xx/xx au xx/xx
    Description : Page d'accueil du site de vente de CD en ligne
*/
-->

<!-- en php
/*$is_admin = false;
session_start();

if (isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/fct_php/database.php";

    $sql = "SELECT * FROM register WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($_SESSION["user_id"]==1) {
        $is_admin = true;
    }
}*/

-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD Store</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <!-- Si connecté -->
    <?php if(isset($_SESSION['login']) && isset($_SESSION['pseudo'])/* && isset($_SESSION['pwd']) */)
    {
        echo '<script>console.log("Connecté");</script>';
        echo '<p style="position:absolute;top:4%;right:12%;">'.$_SESSION['pseudo'].'</p>';
        echo '<a href="connexion/logout.php" class="lienImportant" style="position:absolute;top:2%;">Déconnexion</a>';
        if($_SESSION['admin']){
            echo '<a id="adminButton" href="backoffice/backoffice.php" class="lienImportant" style="visibility:visible;position:absolute;top:2%;left:13%">Aller au BackOffice</a>';
        }
    }
    else {
        echo '<script>console.log("Non connecté");</script>';
    }
    ?>

    <!-- Si easteregg pour mode amdin <a id="adminButton" href="backoffice/backoffice.php" class="lienImportant" style="visibility:hidden;position:absolute;top:2%;">Aller au BackOffice</a> -->
    <a href="connexion/pageConnexion.php"><img style="position:absolute;top:2%;right:5%;width:80px;height:auto;" src="images/logoCDIcon.png" alt="Logo" href="connexion/pageConnexion.php"></img></a>
    <h1>CD Store</h1>
    <p>=> Un site web de vente de CD (oui, oui, ça existe encore !) en ligne</p>
    <!-- Ajoutez le lien vers la page du panier -->
    <span><a href="regarder_panier.php" class="lienImportant">Voir le panier</a></span>
    <span style="position:absolute;left:80%;"><a id="btnTri" style="padding:10px 40px;" onclick="document.querySelector('#btnTri').style.transition='all 0s';document.querySelector('#btnTri').style.visibility='hidden';document.querySelector('#formTri').style.visibility='visible';" class="lienImportant">Trier</a></span>
    <form id="formTri" style="visibility:hidden;" method="post" aciton="./index.php">
    <select name="tri">
        <option value="">Trier par ...</option>
        <option value="auteur">Par auteur</option>
        <option value="titre">Par titre</option>
        <option value="prix">Par prix</option>
        <option value="genre">Par genre</option>
    </select>
    <select name="sens">
        <option value="">Ordre ...</option>
        <option value="asc">Croissant</option>
        <option value="desc">Décroissant</option>
    </select>
    <input type="submit" value="Appliquer les filtres" class="lienImportant"/>
    </form>
    <br/><br/>
    <!-- Ajoutez une div pour afficher la réponse de la requête AJAX -->
    <div id="resultat"></div>
    <div class="cd-container">

        <?php
        //inclure la base donnée
        //include_once "gestionBD/database.php"; // déjà inclus dans le peuplement
        // Constituer la base de données
        include_once "gestionBD/creation_et_peuplement.php";
        // Récupération des variables
        $nomTableCds = $res[0];
        $nomTableUser = $res[1];
        $connexion = $res[2];
        //requete pour afficher la liste des cds
        if (isset($_POST['tri']) && isset($_POST['sens'])) {
            if($_POST['tri']=="auteur"){
                if ($_POST['sens']=="asc") {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds ORDER BY artiste ASC");
                }
                else if ($_POST['sens']=="desc") {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds ORDER BY artiste DESC");
                }
                else {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds");
                }
            }
            else if($_POST['tri']=="titre"){
                if ($_POST['sens']=="asc") {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds ORDER BY titre ASC");
                }
                else if ($_POST['sens']=="desc") {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds ORDER BY titre DESC");
                }
                else {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds");
                }
            }
            else if($_POST['tri']=="prix"){
                if ($_POST['sens']=="asc") {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds ORDER BY prixUnitaire ASC");
                }
                else if ($_POST['sens']=="desc") {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds ORDER BY prixUnitaire DESC");
                }
                else {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds");
                }
            }
            else if($_POST['tri']=="genre"){
                if ($_POST['sens']=="asc") {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds ORDER BY genre ASC");
                }
                else if ($_POST['sens']=="desc") {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds ORDER BY genre DESC");
                }
                else {
                    $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds");
                }
            }
            else {
                $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds");
            }
        }
        else {
            $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds");
        }
        if(mysqli_num_rows($req)==0){
            //s'il n'y as pas de cd d'inscrit
            echo "Il n'y as pas de cd d'inscrit";
        }else{
            //si il y as des cds, afficher la liste de tous
            while ($row=mysqli_fetch_assoc($req)) {
                echo '<div class="disque">';
                echo '<div class="cd">';
                echo '<a class="btn-link" onclick="showDetails(\'' . $row['id'] . '\')">Voir les détails</a>';
                echo '<img src="' . $row['image'] . '" alt="' . $row['titre'] . '">';
                echo '<br>' . $row['titre'] . '<br>' . $row['artiste'] . '<br>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <script>
        function showDetails(cdData) {
            // Utiliser AJAX pour obtenir les détails du CD côté serveur
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "get_cd_details.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Mettre à jour le modal avec les détails reçus du serveur
                    displayModal(xhr.responseText);
                }
            };
            xhr.send("cd_id=" + cdData);
        }

        function displayModal(cdDetails) {
            // Créer un élément modal
            var modal = document.createElement('div');
            modal.classList.add('modal');

            // Remplir le contenu modal avec les détails du CD
            var modalContent = document.createElement('div');
            modalContent.classList.add('modal-content');

            modalContent.innerHTML = cdDetails;

            modal.appendChild(modalContent);

            // Ajouter le modal au document
            document.body.appendChild(modal);

            // Rotation et BorderRadius
            var modalImg = document.querySelector('.modal-content img');
            if (modalImg) {
                modalImg.addEventListener('mouseenter', function() {
                    this.style.animationPlayState = 'running';
                    this.style.borderRadius = '100%'; // Changer la valeur selon vos besoins
                });

                modalImg.addEventListener('mouseleave', function() {
                    this.style.animationPlayState = 'paused';
                });
            }
        }

        function closeModal() {
            var modal = document.querySelector('.modal');
            if (modal) {
                modal.remove();
            }
        }

        function toggleAdmin() {
            // Faire une requête AJAX pour mettre à jour le statut administrateur côté serveur
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "updateAdminStatus.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Mettre à jour le bouton et éventuellement effectuer d'autres actions côté client
                    document.getElementById("adminButton").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>

    <!-- Pour EasterEgg de passage en mode admin -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/egg.js/1.0/egg.min.js"></script>
    <script type="text/javascript">
    var adminBool = false;
    
    var egg1 = new Egg();
    egg1.addCode("a,d,m,i,n", function() {
        console.log("AdminActif");
        alert('!!! Vous êtes passés en mode ADMIN !!!');
        document.querySelector("#adminButton").style.visibility = 'visible';
        adminBool=true;
    }, "AdminMode");

    egg1.listen();

    var egg2 = new Egg();
    egg2.addCode("q,u,i,t", function() {
        if (adminBool) {
            console.log("AdminInactif");
            document.querySelector("#adminButton").style.visibility = 'hidden';
            alert('Vous n`êtes plus en mode ADMIN');
            adminBool=false;
        }
        else {
            console.log("AdminDéjàInactif");
        }
    }, "NotAdminMode");

    egg2.listen();
    </script> -->
</body>
</html>
