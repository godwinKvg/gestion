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

    // echo json_encode($groupeInfo);


    // Ajout des valeurs aux attributs de groupe
    $groupe->hydrate($groupeInfo);
    // var_dump($groupe);

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


            $oldValue = $groupe->findBy(array("id" => $groupe->getId()));



            if (isset($oldValue->image) && !empty($oldValue->image)) {
                try {
                    if (!unlink(Config::UPLOAD_URL . $oldValue->image)) {

                        $response = array(
                            "status" => -1,
                            "message" => "Une erreur est survenue! Veuillez réessayer"
                        );
                        // $response = array(
                        //     "status" => 1,
                        //     "message" => json_encode($groupeInfo)
                        // );

                        sendResponse($response);
                    }
                } catch (Exception $e) {
                    // TODO : Enregistrer dans le journal

                    echo json_encode($e);
                    // return;
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
            $gpeC->removeContactFromGroup($idContact, $idGroupe);

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
    if (Sanitizer::sanitizeGet("action") === "delete") {
        $currentContact = $groupe->findBy(array("id" => Sanitizer::sanitizeGet("id")));

        $nom = $currentContact->nom;
        if (isset($currentContact->image) && !empty($currentContact->image)) {
            // try {
            if (!unlink(Config::UPLOAD_URL . $currentContact->image)) {

                $response = array(
                    "status" => -1,
                    "message" => "Error : Groupe with id " . Sanitizer::sanitizeGet("id") . " not deleteted!"
                );

                sendResponse($response);
            }
            // } catch (Exception $e) {
            // TODO : Enregistrer dans le journal
            // }
        }
        $gpeC->removeGroupe((int)Sanitizer::sanitizeGet("id"));
        $groupe->delete((int)Sanitizer::sanitizeGet("id"));


        $response = array(
            "status" => 1,
            "message" => "Groupe {" . $nom . "} a ete supprime!"
        );

        sendResponse($response);
    }

    // Renvoie 
    else {
        $response =
            array(
                "status" => 1,
                "message" => json_encode($groupe->find((int)Sanitizer::sanitizeGet("id")))

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