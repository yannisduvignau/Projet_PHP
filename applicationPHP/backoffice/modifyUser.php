<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gestion.scss">
    <title>Modify User</title>
</head>
<body>
    <?php

    //connexion
    include_once "../gestionBD/creation_et_peuplement.php";
    // Récupération des variables
    $nomTableUser = $res[1];
    $connexion = $res[2];
    //recup l'id
    $id = $_GET['id'];
    //requete d'affichage
    $req = mysqli_query($connexion, "SELECT * FROM $nomTableUser WHERE id = $id ");
    $row = mysqli_fetch_assoc($req);


    if(isset($_POST['button'])){
        //extraction des infos envoyé par POST
        extract($_POST);
        //vérifier que les champs ont été remplis
        if(isset($nom) && isset($pwd) && isset($pseudo) && isset($admin)){
            //requte de modif
            $req = mysqli_query($connexion, "UPDATE $nomTableUser SET nom = '$nom', pwd = '$pwd', pseudo = '$pseudo' WHERE id = $id ");
            if($req){
                //header("Location: backofficeCds.php");
                echo '<script type="text/javascript">window.location = "./backofficeUsers.php";</script>';
            }else {
                $message = "User non modifié";
            }
        }else {
            $message = "Veuillez remplir tous les champs !";
        }
    }
    ?>
    
    <div class="hero">
        <a href="backofficeCds.php" class="lienImportant">Return</a>
        <div class="form">
            <h2>Modifier l'utilisateur <?=$row['nom']?> aka <?=$row['pseudo']?></h2>
            <p class="erreur_message">
                <?php 
                if(isset($message)){
                    echo $message;
                }
                ?>
            </p><br>
            <form action="" method="POST">
                <label>Nom</label>
                <input type="text" name="nom" value="<?=$row['nom']?>" required>
                <label>Mot de passe</label>
                <input type="text" name="pwd" value="<?=$row['pwd']?>" required>
                <label>Pseudo</label>
                <input type="text" name="pseudo" value="<?=$row['pseudo']?>" required>
                <input type="submit" value="Modifier" name="button">
            </form>
        </div>
    </div>
</body>
</html>