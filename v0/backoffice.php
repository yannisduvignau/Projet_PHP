<!--
/**
    Auteurs : Clement Mourgue et Yannis Duvignau
    Date :  du xx/xx au xx/xx
    Description : Page d'accueil du site de vente de CD en ligne
*/
-->

<?php

// Vérifiez l'authentification (ajoutez vos vérifications ici)
/* if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: index.php');
    exit();
} */

// Traitez les opérations de back-office (ajout/suppression de CD)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_cd'])) {
        $cds = simplexml_load_file('xml/cds.xml');
        
        // Création d'un nouvel élément CD
        $new_cd = $cds->addChild('cd');
        
        // Ajout des attributs du CD
        $new_cd->addChild('id', $_POST['id']);
        $new_cd->addChild('genre', $_POST['genre']);
        $new_cd->addChild('titre', $_POST['titre']);
        $new_cd->addChild('artiste', $_POST['artiste']);
        $new_cd->addChild('prixUnitaire', $_POST['prixUnitaire']);
        $new_cd->addChild('image', $_POST['image']);

        $cds->asXML('xml/cds.xml');
        echo "CD added successfully!";
    }

    if (isset($_POST['delete_cd'])) {
        $cd_to_delete = $_POST['cd_to_delete'];
        $cds = simplexml_load_file('xml/cds.xml');
    
        // Recherchez l'élément à supprimer parmi les éléments existants et supprimez-le
        foreach ($cds->cd as $cd) {
            if ($cd->id == $cd_to_delete) {
                $dom = dom_import_simplexml($cd);
                $dom->parentNode->removeChild($dom);
                $cds->asXML('xml/cds.xml');
                echo "CD deleted successfully!";
                break; // Arrêtez la boucle après avoir trouvé et supprimé l'élément
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office</title>
</head>
<body>
    <h1>Back Office</h1>

    <!-- Formulaire d'ajout de CD -->
    <h2>Add CD</h2>
    <form method="post" action="backoffice.php">
        <label for="id">ID:</label>
        <input type="text" name="id" required>
        <br>
        <label for="genre">Genre:</label>
        <input type="text" name="genre" required>
        <br>
        <label for="titre">Titre:</label>
        <input type="text" name="titre" required>
        <br>
        <label for="artiste">Artiste:</label>
        <input type="text" name="artiste" required>
        <br>
        <label for="prixUnitaire">Prix Unitaire:</label>
        <input type="text" name="prixUnitaire" required>
        <br>
        <label for="image">Image:</label>
        <input type="text" name="image" required>
        <br>
        <button type="submit" name="add_cd">Ajouter un CD</button>
    </form>

    <!-- Formulaire de suppression de CD -->
    <h2>Delete CD</h2>
    <form method="post" action="backoffice.php">
        <label for="cd_to_delete">Select CD to delete:</label>
        <select name="cd_to_delete" required>
            <?php
            // Charger la liste des CD actuels depuis le fichier XML
            $cds = simplexml_load_file('xml/cds.xml');

            // Afficher chaque CD dans la liste déroulante
            foreach ($cds->cd as $cd) {
                echo "<option value='" . $cd->id . "'>" . htmlspecialchars($cd->titre) . " " .htmlspecialchars($cd->artiste) . "</option>";
            }
            ?>
        </select>
        <button type="submit" name="delete_cd">Delete CD</button>
    </form>

    <a href="index.php">Back to CD Store</a>
</body>
</html>
