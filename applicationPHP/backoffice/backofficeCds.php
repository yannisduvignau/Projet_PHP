<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/gestion.css">
    <title>Gestion des cds</title>
</head>
<body>
    <div class="hero">
        <a href="../index.php" class="lienImportant">Return</a>
        <a href="addCd.php" style="position:absolute;right:9%;top:2.5%;color:#00A233;font-size:30px;font-weight:bold;text-decoration:none;">Ajoute un CD</a>
        <a href="addCd.php" style="position:absolute;right:2%;top:2%;"><img src="../images/add.png" alt="Plus_to_add" style="height:50px;"></a>
        <a style="position:relative;top:13%;left:15%;color:#333;font-size:30px;font-weight:bold;">BIENVENUE dans le Backoffice du CD Store côté CDs</a>
        <div class="container"style="border: 3px solid black;">
            <table >
                <tr id="items">
                    <th>Id</th>
                    <th>Titre</th>
                    <th>Genre</th>
                    <th>Artiste</th>
                    <th>Prix Unitaire</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>

                <?php
                //inclure la base donnée
                include_once "../gestionBD/creation_et_peuplement.php";
                // Récupération des variables
                $nomTableCds = $res[0];
                $connexion = $res[2];
                //requete pour afficher la liste des utilisateurs
                $req = mysqli_query($connexion, "SELECT * FROM $nomTableCds");
                if(mysqli_num_rows($req)==0){
                    //s'il n'y as pas de cd d'inscrit
                    echo "Il n'y as pas de cd d'inscrit";
                }else{
                    //si il y as des cds, afficher la liste de tous
                    while ($row=mysqli_fetch_assoc($req)) {
                        ?>
                        <tr>
                            <td><?= $row['id']?></td>
                            <td><?= $row['titre']?></td>
                            <td><?= $row['genre']?></td>
                            <td><?= $row['artiste']?></td>
                            <td><?= $row['prixUnitaire']?>€</td>
                            <td><a href="modifyCd.php?id=<?= $row['id']?>"><img src="../images/pen.png" alt="pen_to_modify"></a> </td>
                            <td><a href="deleteCd.php?id=<?= $row['id']?>"><img src="../images/trash.png" alt="trash_to_delete"></a> </td>
                        </tr>
                        <?php
                    }
                }


                ?>


            </table>
        </div>
    </div>
</body>
</html>