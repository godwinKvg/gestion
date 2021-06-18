<?php
require_once '../inc/classes/File.php';
require_once '../inc/classes/Groupe.php';
require_once '../inc/classes/Sanitizer.php';
require_once '../inc/classes/GrpeContact.php';
require_once '../inc/classes/Config.php';

$groupe = new Groupe;

$gpeC = new GrpeContact;

if (!empty($_POST)) {

    //  Recupération des valeurs venant de la requete
    $groupeInfo = array(
        "id" => (int) Sanitizer::sanitizePost("id"),
        "nom" => Sanitizer::sanitizePost("nom"),
    );

    // Ajout des valeurs aux attributs de groupe
    $groupe->hydrate($groupeInfo);

    // Verification d'envoi de fichier puis mise à jour de la image du groupe
    if (!empty($_FILES["photo"]["name"])) {

        $file = new File($_FILES["photo"]["name"]);

        $uploadResult = $file->uploadFile();

        if (!$uploadResult["upload"]) {
            $response = array(
                "status" => -1,
                "message" => $uploadResult['error']
            );

            sendResponse($response);
        } else {
            $filename = $uploadResult['file'];


            $currentGroupe = $groupe->findBy(array("id" => $groupe->getId()));



            if (!empty($currentGroupe->image)) {
                try {

                    unlink(Config::UPLOAD_URL . $currentGroupe->photo);
                } catch (Exception $e) {
                    // TODO : Enregistrer dans le journal
                    // Example : La photo du Groupe ($currentGroupe->nom) avec l'id Sanitizer::sanitizeGet("id") n'a pas ete supprime ( $currentGroupe->photo)
                }
            }
            $groupeInfo = array_merge($groupeInfo, array("image" => $filename));
        }
    }

    $groupe->hydrate($groupeInfo);
    $groupe->update();

    $response = array(
        "status" => 1,
        "message" => json_encode($groupeInfo)
    );

    sendResponse($response);
}

// REQUETE GET => Demande d'informations auprès de la base de données Ou Suppression

if (isset($_GET)) {

    // Rechercher Groupe par nom

    if (Sanitizer::sanitizeGet('action') === 'recherche' && !empty(Sanitizer::sanitizeGet('value'))) {
        $search = Sanitizer::sanitizeGet('value');

        $groups = $groupe->findAllByName($search);
        $response = array(
            "status" => 1,
            "message" => json_encode($groups)
        );
        SendResponse($response);
    }





    if (!empty($_GET['idC']) && !empty($_GET['idG']) && !empty($_GET['action'])) {
        $idContact = Sanitizer::sanitizeGet('idC');
        $idGroupe = Sanitizer::sanitizeGet('idG');
        $action = Sanitizer::sanitizeGet('action');

        // Suppression d'un contact d'un groupe donne
        if ($action === "delete") {

            try {

                $gpeC->removeContactFromGroup($idContact, $idGroupe);
            } catch (Exception $ex) {
                // TODO : Enregistrer dans le journal
                // echo $ex;
            }

            $response = array(
                "status" => 1,
                "message" => "Le Contact a ete retire du groupe!"
            );
            SendResponse($response);
        }

        // Ajout d'un contact a un groupe donne
        else if ($action === "add") {

            $donnees = array(
                "id_gpe" => $idGroupe,
                "id_contact" => $idContact
            );

            $result = $gpeC->findBy($donnees);
            // var_dump($result);

            if ($result) {
                $response = array(
                    "status" => -1,
                    "message" => "Le contact existe deja dans le groupe!"
                );
                SendResponse($response);
            }

            $gpeC->hydrate($donnees);
            $gpeC->insert();

            $response = array(
                "status" => 1,
                "message" => "Le contact a ete bien ajoute au groupe!"
            );
            SendResponse($response);
        }
    }

    // Renvoie la liste des groupes du contact
    if (!empty($_GET['idC']) && Sanitizer::sanitizeGet('action') === 'groups') {
        $id = (int)Sanitizer::sanitizeGet('idC');
        $groups = $groupe->findAllByContactId($id);
        $response  = array(
            "status" => 1,
            "message" => json_encode($groups)
        );
        sendResponse($response);
    }


    // SI DELETE alors on supprime l'élément. 
    // C'est un cas spécial de GET 
    // Normalement on pouvait utiliser la methode DETELE
    if (Sanitizer::sanitizeGet("action") === "delete" && Sanitizer::sanitizeGet('id') !== null) {

        $currentGroupe = $groupe->findBy(array("id" => Sanitizer::sanitizeGet("id")));

        $nom = $currentGroupe->nom;

        if (!empty($currentGroupe->image)) {
            try {
                unlink(Config::UPLOAD_URL . $currentGroupe->image);
            } catch (Exception $e) {
                // TODO : Enregistrer dans le journal
                // Example : La photo du Groupe ($currentGroupe->nom) avec l'id Sanitizer::sanitizeGet("id") n'a pas ete supprime ( $currentGroupe->image)
            }
        }


        $gpeC->removeGroupe((int)Sanitizer::sanitizeGet("id"));
        $groupe->delete((int)Sanitizer::sanitizeGet("id"));


        $response = array(
            "status" => 1,
            "message" => "Groupe {" . $nom . "} a ete supprime!"
        );

        sendResponse($response);
    }
}




/*
* Recieve array
* Examples  $response = array(
            "status" => 1,
            "message" => "Groupe " . $nom . " a ete supprime!"
        );
*/

function sendResponse($resp)
{
    // http_response_code((int) $resp['status']);
    echo json_encode($resp);
    exit();
}