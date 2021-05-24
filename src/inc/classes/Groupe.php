<?php


require_once './Model.php';

class Contact{ 
    private $id;
    private $nom;
    private $image;

    public function __construct($id,$nom,$image=NULL) {
        $this->table = 'groupe';

        $this->id = $id;
        $this->nom = $nom;
        $this->image = $image;
    }

    
    public function findByName($nom){
        return $this->findBy(['nom'=>$nom]);
    }

}

