<?php 

include_once 'src/inc/partials/header.php';

require_once 'src/inc/classes/Contact.php';
require_once 'src/inc/classes/Sanitizer.php';

$contact = new Contact();
$sanitizer = new Sanitizer();
// $contact->hydrate(array(
//     'nom'=> 'o mana',
//     'prenom'=> 'o mana',
//     'photo'=> 'o mana',
//     'telephone1'=> 'o mana',
//     'telephone2'=> 'o mana',
//     'adresse'=> 'o mana',
//     'email_personnel'=> 'o mana',
//     'email_pro'=> 'o mana',
//     'genre'=> 0,
// ));

// $contact->insert();
$contact = $contact->findAll();

var_dump($contact);



?>			



<?php include_once 'src/inc/partials/footer.php';?>