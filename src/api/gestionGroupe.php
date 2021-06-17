<?php
require_once '../inc/classes/File.php';
require_once '../inc/classes/Groupe.php';
require_once '../inc/classes/Sanitizer.php';
require_once '../inc/classes/Config.php';

$groupe = new Groupe;


if (!empty($_POST) ) {

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
                "status" => 404,
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
                        "status" => 404,
                        "message" => "Une erreur est survenue! Veuillez réessayer"
                    );
                    // $response = array(
                    //     "status" => 200,
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
        "status" => 200,
        "message" => json_encode($groupeInfo)
    );

    sendResponse($response);
}

// REQUETE GET => Demande d'informations auprès de la base de données Ou Suppression

if (isset($_GET)) {


    // SI DELETE alors on supprime l'élément. 
    // C'est un cas spécial de GET 
    // Normalement on pouvait utiliser la methode DETELE
    if (!empty($_GET['idC'])) {
        $id = (int)Sanitizer::sanitizeGet('idC');
        $groups = $groupe->findAllByContactId(44);
        $response  = array(
                "status" => 200,
                "message" => json_encode($groups)
            );
        sendResponse($response);
    }
    if (!empty($_GET['action']) and strtolower(Sanitizer::sanitizeGet("action")) === "delete") {
        $currentContact = $groupe->findBy(array("id" => Sanitizer::sanitizeGet("id")));
    
        $nom = $currentContact->nom;
        if (isset($currentContact->image) && !empty($currentContact->image)) {
            // try {


            if (!unlink(Config::UPLOAD_URL . $currentContact->image)) {

                $response = array(
                    "status" => 404,
                    "message" => "Error : Groupe with id " . Sanitizer::sanitizeGet("id") . " not deleteted!"
                );

                sendResponse($response);
            }
            // } catch (Exception $e) {
            // TODO : Enregistrer dans le journal
            // }
        }

        $groupe->delete((int)Sanitizer::sanitizeGet("id"));


        $response = array(
            "status" => 200,
            "message" => "Groupe " . $nom . " a ete supprime!"
        );

        sendResponse($response);
    }

    // Sinon on renvoie la ressource demandée
    else {
        $response =
            array(
                "status" => 200,
                "message" => json_encode($groupe->find((int)Sanitizer::sanitizeGet("id")))

            );

        sendResponse($response);
    }
}

// Recuperation des contacts d'un groupe




/*
* Recieve array
* Examples  $response = array(
            "status" => 200,
            "message" => "Groupe " . $nom . " a ete supprime!"
        );
*/

function sendResponse($resp)
{
    http_response_code((int) $resp['status']);
    echo json_encode($resp);
    exit();
}