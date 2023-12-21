<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gestion.scss">
    <title>Gestion des utilisateurs</title>
</head>
<body>
    <div class="hero">
        <a href="../index.php" class="lienImportant">Return</a>
        <a href="../connexion/pageInscription.php" style="position:absolute;right:9%;top:2.5%;color:#00A233;font-size:30px;font-weight:bold;text-decoration:none;">Ajoute un Utilisateur</a>
        <a href="../connexion/pageInscription.php" style="position:absolute;right:2%;top:2%;"><img src="../images/add.png" alt="Plus_to_add" style="height:50px;"></a>
        <a style="position:relative;top:13%;left:15%;color:#333;font-size:30px;font-weight:bold;">BIENVENUE dans le Backoffice du CD Store côté Users</a>
        <div class="container"style="border: 3px solid black;">
            <table >
                <tr id="items">
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Password</th>
                    <th>Pseudo</th>
                    <th>bool isAdmin</th>
                </tr>

                <?php
                //inclure la base donnée
                include_once "../gestionBD/creation_et_peuplement.php";
                // Récupération des variables
                $nomTableUser = $res[1];
                $connexion = $res[2];
                //requete pour afficher la liste des utilisateurs
                $req = mysqli_query($connexion, "SELECT * FROM $nomTableUser");
                if(mysqli_num_rows($req)==0){
                    //s'il n'y as pas de cd d'inscrit
                    echo "Il n'y as pas d'utilisateur d'inscrit";
                }else{
                    //si il y as des cds, afficher la liste de tous
                    while ($row=mysqli_fetch_assoc($req)) {
                        ?>
                        <?php if($_SESSION['pseudo'] == $row['pseudo'] && $_SESSION['login'] == $row['nom']){ // Si c'est notre profil
                            echo '<tr style="background-color:pink;">';
                        }
                        else {
                            echo '<tr>';
                        }
                        ?>
                            <td><?= $row['id']?></td>
                            <td><?= $row['nom']?></td>
                            <td><?= $row['pwd']?></td>
                            <td><?= $row['pseudo']?></td>
                            <td><?= $row['admin']?></td>
                            <?php if(!$row['admin'] || ($_SESSION['pseudo'] == $row['pseudo'] && $_SESSION['login'] == $row['nom'])){
                                echo '<td><a href="modifyUser.php?id='.$row['id'].'"><img src="../images/pen.png" alt="pen_to_modify"></a> </td>';
                            }
                            ?>
                            <td><a href="deleteUser.php?id=<?= $row['id']?>"><img src="../images/trash.png" alt="trash_to_delete"></a> </td>
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