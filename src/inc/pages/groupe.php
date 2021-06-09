<?php

require_once 'src/inc/classes/Groupe.php';

$groupe = new Groupe();

$groups = $groupe->findAll();

if (!empty($groups)) {

        require_once 'src/inc/groupe/groupList.php';

?>

    <script>
        const GROUPE_API_URL = 'src/api/gestionGroupe.php';
        const IMAGE_DIRECTORY = "/upload/";
        const PUBLIC_DIRECTORY = "src/public/images/groupe.png";

        let deleteAlert = document.querySelector('#deleteAlert');
        querySelectorAll('.alert').forEach(elt => {
            elt.ClassList.add('show');
        })


        const progress = document.querySelector('.progress');


        // Fonctions appélées dans ContactList



        function supprimerGroupe(id) {
            if (confirm("Voulez vous vraiment supprimer ce groupe ?"))

                fetch(CONTACT_API_URL + "?action=delete&id=" + id)
                .then(data => data.json())
                .then(data => {
                    if (data.status === 200) {
                        console.log(data.message);
                        document.querySelector("#row" + id).remove();
                    }
                })
                .catch(err => console.log(err));
        }
    </script>

<?php
} else {

    echo '<div class="container h-100 d-flex align-items-center flex-column justify-content-center">
        <h1>Liste vide</h1>
        <a href="/addGroupe" class="btn btn-primary">Ajouter Groupe</a>
    </div>';
}
