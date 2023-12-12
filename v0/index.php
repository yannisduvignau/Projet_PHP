<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD Store</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <img style="position:absolute;top:2%;right:5%;width:80px;height:auto;" src="images/logoCDIcon.png" alt="Logo"></img>
    <h1>CD Store</h1>
    <p>=> Un site web de vente de CD (oui, oui, ça existe encore !) en ligne</p>
    <!-- Ajoutez le lien vers la page du panier -->
    <span><a href="regarder_panier.php" class="lienImportant">Voir le panier</a></span>
    <span style="position:absolute;left:80%;"><a style="padding:10px 40px;" href="#" class="lienImportant">Filtrer</a></span>
    <br/><br/>
    <!-- Ajoutez une div pour afficher la réponse de la requête AJAX -->
    <div id="resultat"></div>
    <div class="cd-container">
        <?php
        
        $cds = simplexml_load_file('xml/cds.xml');
        //Affichage de tous les CDs
        foreach ($cds as $cd) {
            $cd_data = base64_encode($cd->asXML());
            // test
            echo '<div class="disque">';
            echo '<div class="cd">';
            echo '<a class="btn-link" onclick="showDetails(\'' . $cd_data . '\')">Voir les détails</a>';
            echo '<img src="' . $cd->image . '" alt="' . $cd->titre . '">';
            echo '<br>' . $cd->titre . '<br>' . $cd->artiste . '<br>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <script>
        function showDetails(cdData) {
            var cd = new DOMParser().parseFromString(atob(cdData), 'application/xml');

            // Crée un élément modal
            var modal = document.createElement('div');
            modal.classList.add('modal');

            // Remplit le contenu modal
            var modalContent = document.createElement('div');
            modalContent.classList.add('modal-content');

            // Extrait les détails du CD
            var id = cd.querySelector('id')? cd.querySelector('id').textContent : 'N/A';;
            var titre = cd.querySelector('titre') ? cd.querySelector('titre').textContent : 'N/A';
            var image = cd.querySelector('image') ? cd.querySelector('image').textContent : '';
            var artiste = cd.querySelector('artiste') ? cd.querySelector('artiste').textContent : 'N/A';
            var genre = cd.querySelector('genre') ? cd.querySelector('genre').textContent : 'N/A';
            var prixUnitaire = cd.querySelector('prixUnitaire') ? cd.querySelector('prixUnitaire').textContent : 'N/A';

            modalContent.innerHTML = `
                <span class="close" onclick="closeModal()">&times;</span>
                <h1>${titre}</h1>
                ${image ? `<img src="${image}" alt="${titre}">` : ''}
                <p>Auteur: ${artiste}</p>
                <p>Genre: ${genre}</p>
                <a class="price"> $${prixUnitaire}</a>
                <!-- <div class="cercleCd"></div> -->
                <form method="POST" action="ajouter_panier.php">
                    <input type="hidden" name="produit_id" value=${id}>
                    <input type="hidden" name="produit_image" value=${image}>
                    <input type="hidden" name="produit_titre" value=${titre}>
                    <input type="hidden" name="produit_prix" value=${prixUnitaire}>
                    <input type="number" name="produit_qte" value="1" step="1" style="box-shadow:3px 3px 3px #33333350">
                    <button type="submit" name="ajouter_panier" class="btn-link">Ajouter au panier</button>
                </form>
                <!-- Ajoutez d'autres détails ici -->
            `;

            modal.appendChild(modalContent);

            // Ajoute le modal au document
            document.body.appendChild(modal);

            // Rotation et BorderRadius
            document.querySelector('.modal-content img').addEventListener('mouseenter', function() {
                this.style.animationPlayState = 'running';
                this.style.borderRadius = '100%'; // Changer la valeur selon vos besoins
            });

            document.querySelector('.modal-content img').addEventListener('mouseleave', function() {
                this.style.animationPlayState = 'paused';
            });
        }

        function closeModal() {
            var modal = document.querySelector('.modal');
            if (modal) {
                modal.remove();
            }
        }

    </script>
</body>
</html>
