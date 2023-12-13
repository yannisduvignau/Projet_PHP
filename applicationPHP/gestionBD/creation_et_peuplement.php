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

// Requête de création de la table utilisateur
$sql = "CREATE TABLE IF NOT EXISTS Utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    pseudo VARCHAR(50) NOT NULL,
    pwd VARCHAR(100) NOT NULL,
    admin BOOLEAN NOT NULL
)";

if ($connexion->query($sql) === TRUE) {
    echo "Table Utilisateur créée avec succès\n";
} else {
    echo "Erreur lors de la création de la table\n";
}


// Requête de création de la table CD
$sql = "CREATE TABLE IF NOT EXISTS CD (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(50) NOT NULL,
    genre VARCHAR(50) NOT NULL,
    artiste VARCHAR(50) NOT NULL,
    prixUnitaire INTEGER NOT NULL,
    image VARCHAR(100) NOT NULL
)";

if ($connexion->query($sql) === TRUE) {
    echo "Table CD créée avec succès\n";
} else {
    echo "Erreur lors de la création de la table\n";
}

//////////////////////////////////////////////
///         Peuplement des tables          ///
/////////////////////////////////////////////


/////////////////////////////
///   Table Utilisateur   ///
/////////////////////////////

// Nom de la table à vérifier
$nomTable = "utilisateur";

// Requête pour compter le nombre de lignes dans la table
$resultat = $connexion->query("SELECT COUNT(*) as total FROM $nomTable");
$row = $resultat->fetch_assoc();
$totalLignes = $row['total'];

// Vérifier si la table est vide
if ($totalLignes == 0) {
    // La table est vide
    // Requête d'insertion de données dans la table utilisateur
    $sql = "INSERT INTO utilisateur (nom, pseudo, pwd,admin)
    VALUES ('Doe', 'John_Doe', 'booba',1)";

    if ($connexion->query($sql) === TRUE) {
        echo "Données ajoutées avec succès";
    } else {
        echo "Erreur lors de l'ajout des données  ";
    }
}else{
    echo "La table n'est pas vide";
}

/////////////////////////////
///        Table CD       ///
/////////////////////////////

// Nom de la table à vérifier
$nomTable = "cd";

// Requête pour compter le nombre de lignes dans la table
$resultat = $connexion->query("SELECT COUNT(*) as total FROM $nomTable");
$row = $resultat->fetch_assoc();
$totalLignes = $row['total'];

// Vérifier si la table est vide
if ($totalLignes == 0) {
    // La table est vide
    // Requête d'insertion de données dans la table cd
    $sql = "INSERT INTO cd (titre, genre, artiste,prixUnitaire,image) VALUES
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
        echo "Données ajoutées avec succès";
    } else {
        echo "Erreur lors de l'ajout des données";
    }
}else{
    echo "La table n'est pas vide";
}

// Fermer la connexion
$connexion->close();
?>
