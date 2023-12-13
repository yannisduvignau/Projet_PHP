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

    if(isset($_POST['button'])){
        //extraction des infos envoyé par POST
        extract($_POST);
        //vérifier que les champs ont été remplis
        if(isset($titre) && isset($genre) && isset($artiste) && isset($prixUnitaire) && isset($image)){
            //requte de modif
            $req = mysqli_query($connexion, "INSERT INTO cd (titre, genre, artiste,prixUnitaire,image) VALUES('$titre', '$genre', '$artiste',$prixUnitaire,'$image')");
            if($req){
                header("Location: backoffice.php");
            }else {
                $message = "CD non ajouté";
            }
        }else {
            $message = "Veuillez remplir tous les champs !";
        }
    }
    ?>
    
    <div class="hero">
        <a href="backoffice.php" class="button-return">Return</a>
        <div class="form">
            <h2>Ajouter un cd</h2>
            <p class="erreur_message">
                <?php 
                if(isset($message)){
                    echo $message;
                }
                ?>
            </p><br>
            <form action="" method="POST">
                <label>Titre</label>
                <input type="text" name="titre">
                <label>Genre</label>
                <input type="text" name="genre" >
                <label>Artiste</label>
                <input type="text" name="artiste">
                <label>Prix Unitaire</label>
                <input type="text" name="prixUnitaire" >
                <label>Image</label>
                <input type="text" name="image" placeholder="chemin/vers/votre/image">
                <input type="submit" value="Ajouter" name="button">
            </form>
        </div>
    </div>
</body>
</html>