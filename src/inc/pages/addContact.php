<?php
// session_start();


require_once 'src/inc/classes/Contact.php';
require_once 'src/inc/classes/Sanitizer.php';
require_once 'src/inc/classes/File.php';

$contact = new Contact();
$sanitizer = new Sanitizer();


if (!empty($_POST)) {


    $contact = new Contact;


    //  Recupération des valeurs venant de la requete
    $contactInfo = array(
        "nom" => Sanitizer::sanitizePost("nom"),
        "prenom" => Sanitizer::sanitizePost("prenom"),
        "telephone1" => Sanitizer::sanitizePost("telephone1"),
        "telephone2" => Sanitizer::sanitizePost("telephone2"),
        "email_pro" => Sanitizer::sanitizePost("email_pro"),
        "email_perso" => Sanitizer::sanitizePost("email_perso"),
        "adresse" => Sanitizer::sanitizePost("adresse"),
        "genre" => Sanitizer::sanitizePost("genre"),
    );


    // Ajout des valeurs aux attributs de contact
    $contact->hydrate($contactInfo);
    // Verification d'envoi de fichier puis mise à jour de la photo du contact
    if (!empty($_FILES["photo"]["name"])) {

        $file = new File($_FILES["photo"]["name"]);

        $uploadResult = $file->uploadFile();

        if (isset($uploadResult["upload"]) and !$uploadResult["upload"]) {
            $response = array(
                "status" => 404,
                "message" => $uploadResult['error']
            );

            header("location:/?status=-1&msg=".$response['message']);
            
            exit();
        } else {
            $filename = $uploadResult['file'];
            $contactInfo =  array_merge($contactInfo, array("photo" => $filename));
        }
    }
    $contact->hydrate($contactInfo);

    try {
        $contact->insert();
        header("location:/?status=1&msg=Contact enrégistré");
        exit();
    } catch (Exception $th) {
        // TODO : Enregistrer dans le journal

        header("location:/?status=-1&msg=Une erreur est survenue! Veuillez ressayer");
        exit();
    }
}


require_once 'src/inc/partials/header.php';
Message::showGetMsg();
require_once 'src/inc/partials/contact/addContact.php';

?>

<script>
const addFrom = document.querySelector('#addForm');
const progress = document.querySelector('.progress');
// Gere le chargement de fichier dans le navigateur
// C'est pour faire la preview 
// de ce à quoi son profil ressemblera
addFrom?.querySelector('input[type=file]').addEventListener('change', e => {

    const target = e.target;
    let file = target.files[0];
    if (file) {
        progress.classList.remove("d-none");
        const reader = new FileReader();

        reader.onload = (e) => {
            setTimeout(() => {
                progress.classList.add("d-none");
            }, 1000);

            target.previousElementSibling.querySelector('img').src = e.currentTarget.result;
        }

        reader.readAsDataURL(file);
    }

});
</script>