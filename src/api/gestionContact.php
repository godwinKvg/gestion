<?php
require_once '../inc/classes/File.php';
require_once '../inc/classes/Contact.php';
require_once '../inc/classes/GrpeContact.php';
require_once '../inc/classes/Sanitizer.php';
require_once '../inc/classes/Config.php';

$contact = new Contact;
$groupeContact = new GrpeContact;


if (!empty($_POST)) {

    //  Recupération des valeurs venant de la requete
    $contactInfo = array(
        "id" => (int) Sanitizer::sanitizePost("id"),
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
    // var_dump($contact);

    // Verification d'envoi de fichier puis mise à jour de la photo du contact
    if (!empty($_FILES["photo"]["name"])) {

        $file = new File($_FILES["photo"]["name"]);

        $uploadResult = $file->uploadFile();

        if (!$uploadResult["upload"]) {
            $response = array(
                "status" => 404,
                "message" => $uploadResult['error']
            );

            sendResponse($response);
        } else {
            $filename = $uploadResult['file'];


            $oldValue = $contact->findBy(array("id" => $contact->getId()));

            if (isset($oldValue->photo) && !empty($oldValue->photo)) {
                try {
                    unlink(Config::UPLOAD_URL . $oldValue->photo);
                } catch (Exception $e) {
                    // TODO : Enregistrer dans le journal
                    // Example : La photo du contact ($currentContact->nom) avec l'id Sanitizer::sanitizeGet("id") n'a pas ete supprime ( $currentContact->photo)code($e);
                }
            }

            $contactInfo = array_merge($contactInfo, array("photo" => $filename));
        }
    }

    $contact->hydrate($contactInfo);
    $contact->update();

    $response = array(
        "status" => 200,
        "message" => json_encode($contactInfo)
    );

    sendResponse($response);
}

// REQUETE GET => Demande d'informations auprès de la base de données Ou Suppression

elseif (isset($_GET)) {

    // Rechercher Groupe par nom
    if (Sanitizer::sanitizeGet('action') === 'recherche' && !empty(Sanitizer::sanitizeGet('value'))) {
        $search = Sanitizer::sanitizeGet('value');

        $contacts = $contact->findByPhoneOrName($search);
        $response = array(
            "status" => 1,
            "message" => json_encode($contacts)
        );
        SendResponse($response);
    }

    // Renvoie la liste des contacts du groupe
    if (!empty($_GET['id']) && Sanitizer::sanitizeGet('action') === 'contacts') {

        $id = (int)Sanitizer::sanitizeGet('id');
        $contacts = $contact->findAllByGroupId($id);
        $response  = array(
            "status" => 200,
            "message" => json_encode($contacts)
        );
        sendResponse($response);
    }


    // SI DELETE alors on supprime l'élément. 
    // C'est un cas spécial de GET 
    // Normalement on pouvait utiliser la methode DETELE

    if (Sanitizer::sanitizeGet("action") === "delete") {
        $currentContact = $contact->findBy(array("id" => Sanitizer::sanitizeGet("id")));
        $nom = $currentContact->nom;
        if (!empty($currentContact->photo)) {
            try {

                unlink(Config::UPLOAD_URL . $currentContact->photo);
            } catch (Exception $e) {
                // TODO : Enregistrer dans le journal
                // Example : La photo du contact ($currentContact->nom) avec l'id Sanitizer::sanitizeGet("id") n'a pas ete supprime ( $currentContact->photo)
            }
        }

        $groupeContact->removeContact((int)Sanitizer::sanitizeGet("id"));

        $contact->delete((int)Sanitizer::sanitizeGet("id"));



        $response = array(
            "status" => 200,
            "message" => "Contact {" . $nom . "} deleted!"
        );

        sendResponse($response);
    }
}






function sendResponse($resp)
{
    http_response_code((int) $resp['status']);
    echo json_encode($resp);
    exit();
}