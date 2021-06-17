<?php

require_once 'src/inc/classes/Groupe.php';

$groupe = new Groupe;

$groups = $groupe->findAll();

if (!empty($groups)) {

    require_once 'src/inc/partials/header.php';
    require_once 'src/inc/partials/groupe/groupList.php';

?>

<script src="src/public/js/groupe.js"></script>

<?php
} else {

    echo '<div class="container h-100 d-flex align-items-center flex-column justify-content-center">
        <h1>Liste vide</h1>
        <a href="/addGroupe" class="btn btn-primary">Ajouter Groupe</a>
    </div>';
}