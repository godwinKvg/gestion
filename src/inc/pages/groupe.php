<?php

require_once 'src/inc/classes/Groupe.php';
require_once 'src/inc/classes/Contact.php';

$groupe = new Groupe;
$contact = new COntact;

$contacts = $contact->findAll();
$groups = $groupe->findAll();

if (!empty($groups)) {

    require_once 'src/inc/partials/header.php';
    require_once 'src/inc/partials/groupe/groupList.php';
    require_once 'src/inc/partials/groupe/groupContacts.php';
    require_once 'src/inc/partials/groupe/addContactToGroup.php';


?>

<script src="src/public/js/groupe.js"></script>

<?php
} else {

    require_once 'src/inc/partials/header.php';

    echo '<div class="container h-100 d-flex align-items-center flex-column justify-content-center">
        <h1>Liste vide</h1>
        <a href="/addGroupe" class="btn btn-primary">Ajouter Groupe</a>
    </div>';
}