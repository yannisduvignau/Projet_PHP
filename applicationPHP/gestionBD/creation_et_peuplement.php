<!--
/**
    Auteurs : Clement Mourgue et Yannis Duvignau
    Date :  du xx/xx au xx/xx
    Description : Création et peuplement des données de base dans une base de données créer préalablement
*/
-->

<?php
//connexion
include_once "database.php";


//////////////////////////////////////////////
///          Création des tables          ///
/////////////////////////////////////////////

$nomTableUser = "Utilisateur";
$nomTableCds = "CD";

// Requête de création de la table utilisateur
$sql = "CREATE TABLE IF NOT EXISTS $nomTableUser (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    pwd VARCHAR(100) NOT NULL,
    admin BOOLEAN NOT NULL
)";

if ($connexion->query($sql) === TRUE) {
    echo '<script type="text/javascript">console.log("Table Utilisateur créée avec succès ou déjà existante");</script>';
} else {
    echo '<script type="text/javascript">console.log("Erreur lors de la création de la table");</script>';
}


// Requête de création de la table CD
$sql = "CREATE TABLE IF NOT EXISTS $nomTableCds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(50) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    artiste VARCHAR(50) NOT NULL,
    prixUnitaire DECIMAL(65,2) NOT NULL,
    image VARCHAR(100) NOT NULL
)";

if ($connexion->query($sql) === TRUE) {
    echo '<script type="text/javascript">console.log("Table Utilisateur créée avec succès ou déjà existante");</script>';
} else {
    echo '<script type="text/javascript">console.log("Erreur lors de la création de la table");</script>';
}

//////////////////////////////////////////////
///         Peuplement des tables          ///
/////////////////////////////////////////////


/////////////////////////////
///   Table Utilisateur   ///
/////////////////////////////

// Nom de la table à vérifier

// Requête pour compter le nombre de lignes dans la table
$resultat = $connexion->query("SELECT COUNT(*) AS total FROM $nomTableUser");
$row = mysqli_fetch_assoc($resultat);
$totalLignes = $row['total'];

// Vérifier si la table est vide
if ($totalLignes == 0) {
    // La table est vide
    // Requête d'insertion de données dans la table utilisateur
    $sql = "INSERT INTO $nomTableUser (nom, pseudo, pwd,admin)
    VALUES ('Doe', 'John_Doe', 'booba',1)";

    if ($connexion->query($sql) === TRUE) {
        echo '<script type="text/javascript">console.log("Données ajoutées avec succès");</script>';
    } else {
        echo '<script type="text/javascript">console.log("Erreur lors de l`ajout des données");</script';
    }
}else{
    echo '<script type="text/javascript">console.log("La table n`est pas vide");</script>';
}

/////////////////////////////
///        Table CD       ///
/////////////////////////////

// Nom de la table à vérifier
$nomTable = "CD";

// Requête pour compter le nombre de lignes dans la table
$resultat = $connexion->query("SELECT COUNT(*) as total FROM $nomTableCds");
$row = mysqli_fetch_assoc($resultat);
$totalLignes = $row['total'];

// Vérifier si la table est vide
if ($totalLignes == 0) {
    // La table est vide
    // Requête d'insertion de données dans la table cd
    $sql = "INSERT INTO $nomTableCds (titre, genre, artiste,prixUnitaire,image) VALUES
    ('Ultra', 'Rap', 'Booba',9.99,'images/pochette1.jpg'),
    ('Monument', 'Rap', 'Alkpote',10.99,'images/pochette2.jpg'),
    ('Arretez-le', 'Rap', '1plike140',11.99,'images/pochette3.jpg'),
    ('DRILL FR', 'Rap', 'Gazo',18.99,'images/pochette4.jpg'),
    ('Platinium', 'Rap', 'PLK',26.99,'images/pochette5.jpg'),
    ('Cicatrices', 'Rap', 'Zola',16.99,'images/pochette6.jpg'),
    ('Illmatic', 'Rap', 'Nas',4.99,'images/pochette7.jpg'),
    ('The R.E.D. Album', 'Rap', 'Game',8.99,'images/pochette8.jpg'),
    ('Le Monde Chico', 'Rap', 'PNL',4.99,'images/pochette9.jpg'),
    ('Trinity', 'Rap', 'Laylow',9.99,'images/pochette10.jpg'),
    ('Mental', 'Rap', 'PLK',11.99,'images/pochette11.jpg'),
    ('Feu (réédition)', 'Rap', 'Nekfeu',49.99,'images/pochette12.jpg'),
    ('J.O.$ | Chronique', 'Rap', 'Josman',46.99,'images/pochette13.jpg'),
    ('Memoria', 'Rap', 'Jazzy Bazz',12.99,'images/pochette14.png'),
    ('Masque Blanc', 'Rap', 'S.Pri Noir',9.99,'images/pochette15.jpg')";

if ($connexion->query($sql) === TRUE) {
    echo '<script type="text/javascript">console.log("Données ajoutées avec succès");</script>';
} else {
    echo '<script type="text/javascript">console.log("Erreur lors de l`ajout des données");</script>';
}
}else{
echo '<script type="text/javascript">console.log("La table n`est pas vide");</script>';
}

// Fermer la connexion
//$connexion->close();
$res = [$nomTableCds,$nomTableUser,$connexion];

return $res;
?>
