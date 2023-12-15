<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gestion.scss">
    <title>Modify</title>
</head>
<body>
    <?php

    //connexion
    include_once "../gestionBD/database.php";
    //recup l'id
    $id = $_GET['id'];
    //requete d'affichage
    $req = mysqli_query($connexion, "SELECT * FROM cd WHERE id = $id ");
    $row = mysqli_fetch_assoc($req);


    if(isset($_POST['button'])){
        //extraction des infos envoyé par POST
        extract($_POST);
        //vérifier que les champs ont été remplis
        if(isset($titre) && isset($genre) && isset($artiste) && isset($prixUnitaire)){
            //requte de modif
            $req = mysqli_query($connexion, "UPDATE cd SET titre = '$titre', genre = '$genre', artiste = '$artiste', prixUnitaire = '$prixUnitaire' WHERE id = '$id' ");
            if($req){
                header("Location: backoffice.php");
            }else {
                $message = "Employé non modifié";
            }
        }else {
            $message = "Veuillez remplir tous les champs !";
        }
    }
    ?>
    
    <div class="hero">
        <a href="backoffice.php" class="lienImportant">Return</a>
        <div class="form">
            <h2>Modifier le cd <?=$row['titre']?> de <?=$row['artiste']?></h2>
            <p class="erreur_message">
                <?php 
                if(isset($message)){
                    echo $message;
                }
                ?>
            </p><br>
            <form action="" method="POST">
                <label>Titre</label>
                <input type="text" name="titre" value="<?=$row['titre']?>">
                <label>Genre</label>
                <input type="text" name="genre" value="<?=$row['genre']?>">
                <label>Artiste</label>
                <input type="text" name="artiste" value="<?=$row['artiste']?>">
                <label>Prix Unitaire</label>
                <input type="text" name="prixUnitaire" value="<?=$row['prixUnitaire']?>">
                <input type="submit" value="Modifier" name="button">
            </form>
        </div>
    </div>
</body>
</html>