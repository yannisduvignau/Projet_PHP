<?php
session_start();

// Vérifiez l'authentification (ajoutez vos vérifications ici)
/* if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: index.php');
    exit();
} */

// Traitez les opérations de back-office (ajout/suppression de CD)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_cd'])) {
        $new_cd = simplexml_load_string($_POST['new_cd']);
        $cds = simplexml_load_file('xml/cds.xml');
        $cds->addChild('cd', $new_cd->asXML());
        $cds->asXML('xml/cds.xml');
    }

    if (isset($_POST['delete_cd'])) {
        $cd_to_delete = simplexml_load_string($_POST['cd_to_delete']);
        $xpath = $cd_to_delete->xpath('..');
        unset($xpath[0][0]);
        $cd_to_delete->asXML('xml/cds.xml');
    }
}

// Affichez le formulaire d'ajout de CD
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
        <label for="new_cd">New CD (XML format):</label>
        <textarea name="new_cd" rows="4" cols="50" required></textarea>
        <button type="submit" name="add_cd">Add CD</button>
    </form>

    <!-- Formulaire de suppression de CD -->
    <h2>Delete CD</h2>
    <form method="post" action="backoffice.php">
        <label for="cds_to_delete">Select CD to delete:</label>
        <select name="cd_to_delete" required>
            <?php
            // Charger la liste des CD actuels depuis le fichier XML
            $cds = simplexml_load_file('xml/cds.xml');

            // Afficher chaque CD dans la liste déroulante
            foreach ($cds->cd as $cd) {
                echo "<option value='" . htmlspecialchars($cd->asXML()) . "'>" . htmlspecialchars($cd->title) . "</option>";
            }
            ?>
        </select>
        <button type="submit" name="delete_cd">Delete CD</button>
    </form>

    <a href="index.php">Back to CD Store</a>
</body>
</html>