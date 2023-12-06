<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD Store</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>CD Store</h1>
    <p>=> Un site web de vente de CD (oui, oui, ça existe encore !) en ligne</p>
    <!-- Ajoutez le lien vers la page du panier -->
    <a href="regarder_panier.php">Voir le panier</a>
    <!-- Ajoutez une div pour afficher la réponse de la requête AJAX -->
    <div id="resultat"></div>
    <div class="cd-container">
        <?php
        session_start();
        $cds = simplexml_load_file('xml/cds.xml');
        //Affichage de tous les CDs
        foreach ($cds as $cd) {
            $cd_data = base64_encode($cd->asXML());
            echo '<div class="cd">';
            echo '<a class="btn-link" onclick="showDetails(\'' . $cd_data . '\')">Voir les détails</a>';
            echo '<img src="' . $cd->image . '" alt="' . $cd->title . '">';
            echo '<br>' . $cd->title . '<br>' . $cd->artist . '<br>';
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
            var title = cd.querySelector('title') ? cd.querySelector('title').textContent : 'N/A';
            var image = cd.querySelector('image') ? cd.querySelector('image').textContent : '';
            var artist = cd.querySelector('artist') ? cd.querySelector('artist').textContent : 'N/A';
            var genre = cd.querySelector('genre') ? cd.querySelector('genre').textContent : 'N/A';
            var price = cd.querySelector('price') ? cd.querySelector('price').textContent : 'N/A';

            modalContent.innerHTML = `
                <span class="close" onclick="closeModal()">&times;</span>
                <h1>${title}</h1>
                ${image ? `<img src="${image}" alt="${title}">` : ''}
                <p>Artist: ${artist}</p>
                <p>Genre: ${genre}</p>
                <a class="price"> $${price}</a>
                <form method="POST" action="ajouter_panier.php">
                    <input type="hidden" name="product_id" value=${id}>
                    <input type="hidden" name="product_name" value=${title}>
                    <input type="hidden" name="product_price" value=${price}>
                    <button type="submit" name="add_to_cart" class="btn-link">Ajouter au panier</button>
                </form>
                <!-- Ajoutez d'autres détails ici -->
            `;

            modal.appendChild(modalContent);

            // Ajoute le modal au document
            document.body.appendChild(modal);
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
