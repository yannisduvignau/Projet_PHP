<?php
// get_cd_details.php

$cdId = $_POST['cd_id'];  // Assurez-vous de valider et nettoyer cette valeur côté serveur

// Inclure la base de données et effectuer la requête pour obtenir les détails du CD
include_once "gestionBD/database.php";

$nomTableUser = "Utilisateur";
$nomTableCds = "CD";

$sql = "SELECT * FROM $nomTableCds WHERE id = $cdId";
$result = mysqli_query($connexion, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    // Générer le HTML des détails du CD
    $id = $row['id'];
    $titre = $row['titre'];
    $image = $row['image'];
    $artiste = $row['artiste'];
    $genre = $row['genre'];
    $prixUnitaire = $row['prixUnitaire'];

    echo '
        <span class="close" onclick="closeModal()">&times;</span>
        <h1> '. $titre . '</h1>
        ' . ($image ? '<img src="./chargerImage.php?chemImage=' . $image . '&sizeX=300&sizeY=300" alt="'.$titre.'">' : '') . '
        <p>Auteur: '.$artiste.'</p>
        <p>Genre: '.$genre.'</p>
        <p class="price">Prix : '.$prixUnitaire.'</p>
        <form method="POST" action="ajouter_panier.php">
            <input type="hidden" name="produit_id" value="'.$id.'">
            <input type="hidden" name="produit_image" value="'.$image.'">
            <input type="hidden" name="produit_titre" value="'.$titre.'">
            <input type="number" style="visibility:hidden;" name="produit_prix" value="'.$prixUnitaire.'"><br/>
            <input type="number" name="produit_qte" value="1" step="1" style="box-shadow:3px 3px 3px #33333350">
            <button type="submit" name="ajouter_panier" class="btn-link">Ajouter au panier</button>
        </form>
    ';
} else {
    // Gérer le cas où le CD n'est pas trouvé
    echo "Détails du CD non disponibles.";
}
?>
