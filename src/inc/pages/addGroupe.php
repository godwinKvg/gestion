<?php
// session_start();


require_once 'src/inc/classes/Groupe.php';
require_once 'src/inc/classes/Sanitizer.php';
require_once 'src/inc/classes/File.php';

$groupe = new Groupe();
$sanitizer = new Sanitizer();



if (!empty($_POST)) {


    $groupe = new Groupe;

    $nom = Sanitizer::sanitizePost("nom");
    //  Recupération des valeurs venant de la requete
    $groupe->setNom($nom);

    // Si le groupe existe deja on lui envoie une erreur
    $groupeExists = $groupe->findBy(array(
        "nom" => $nom
    ));

    if (!empty($groupeExists)) {
        header("location:?status=-1&msg=Groupe existe deja");
        exit();
    }


    // Verification d'envoi de fichier puis mise à jour de la photo du groupe
    if (!empty($_FILES["photo"]["name"])) {

        $file = new File($_FILES["photo"]["name"]);

        $uploadResult = $file->uploadFile();
        // var_dump($uploadResult);

        // exit();

        if (!$uploadResult["upload"]) {

            header("location:?status=-1&msg=" . $uploadResult['error']);
            exit();
        } else {
            $filename = $uploadResult['file'];
            $groupe->setImage($filename);
        }
    } else {
        header("location:?status=-1&msg=Veuillez ajouter l'image du groupe");
        exit();
    }

    try {
        if ($groupe->getImage()) {
            $groupe->insert();
            header("location:?status=1&msg=Groupe Crée. Félicitations!!!!");
            exit();
        } else {
            echo $ex;
            header("location:?status=-1&msg=L'image n'a pas pu etre enregistre!");
            exit();
        }
    } catch (Exception $ex) {
        // TODO : Enregistrer dans le journal
        echo $ex;
        header("location:?status=-1&msg=Une erreur est survenue! Veuillez ressayer");
        exit();
    }
}


require_once 'src/inc/partials/header.php';
Message::showGetMsg();

require_once 'src/inc/partials/groupe/addGroupe.php';

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