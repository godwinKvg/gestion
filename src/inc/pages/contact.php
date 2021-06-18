<?php

require_once 'src/inc/classes/Contact.php';

$contact = new Contact();

$contacts = $contact->findAll();

if (!empty($contacts)) {


    require_once 'src/inc/partials/header.php';
    Message::showGetMsg();

    require_once 'src/inc/partials/contact/contactList.php';
    require_once 'src/inc/partials/contact/updateContact.php';
    require_once 'src/inc/partials/contact/contactGroups.php';

?>

<script src="src/public/js/contact.js"></script>

<?php
} else {

    require_once 'src/inc/partials/header.php';

    echo '<div class="container h-100 d-flex align-items-center flex-column justify-content-center">
        <h1>Liste vide</h1>
        <a href="/?p=addContact" class="btn btn-primary">Ajouter Contact</a>
    </div>';
}