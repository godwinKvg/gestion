<?php
require_once 'Config.php';
class File
{
    private $file;
    private $extensions = ['JPEG', 'PNG', 'JPG', 'SVG'];
    private $target_dir = Config::UPLOAD_URL;
    private $fileToUpload = 'photo';

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Cette fonction permet de défint un nom normalisé pour le fichier
     */
    private function randomizeFileName()
    {
        $number = rand(111, 9999);

        $dateString = 'photo_' . $number . date('Y_m_d_H_i_s_u') . $this->file;

        return $dateString;
    }

    /**
     * permet de télécharger (upload) un ficher vers le serveur
     */
    public  function uploadFile()
    {
        $uploadOk = true;

        $upperExtensions = [];
        foreach ($this->extensions as $i) {
            $upperExtensions[] = strtoupper($i);
        }

        // On normalise le nom du fichier
        $fileNameRand = $this->randomizeFileName(basename($_FILES[$this->fileToUpload]["name"]));

        // $this->target_dir le dossier qui va contenir les fichier
        $target_file =  $this->target_dir . $fileNameRand;


        // Obtenir l'extension du fichiers
        $imageFileType = strtoupper(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérifier que cette extension est acceptable
        if (!in_array($imageFileType, $upperExtensions)) {
            // $uploadOk = false;
            return array(
                "upload" => false,
                "error" => "Extension Invalide!"
            );
        }

        // TODO: TRES IMPORTANT : Il reste à vérifier si le fichier est une image ou non

        // Vérifier la taille du fichier
        if ($_FILES[$this->fileToUpload]["size"] > 30000000) {
            // $uploadOk = false;
            return array(
                "upload" => false,
                "error" => "Taille de l'image trop grande!"
            );
        }

        // Si y a pas de problèmes
        if ($uploadOk) {
            // echo $target_file;
            // Déplacer le fichier vers son emplacement sur le serveur
            $upload = move_uploaded_file($_FILES[$this->fileToUpload]["tmp_name"], $target_file);


            if ($upload)
                return array(
                    "file" => $fileNameRand,
                    "upload" => $upload
                );
        }


        return array(
            "upload" => false,
            "error" => "L'image n'a pas pu être enregistrée! Veuillez réessayer"
        );
    }
}
