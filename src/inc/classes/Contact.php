<?php


require_once 'Model.php';

class Contact extends Model{ 
    private $id;
    private $nom;
    private $prenom;
    private $photo;
    private $telephone1;
    private $telephone2;
    private $adresse;
    private $email_personnel;
    private $email_pro;
    private $genre;


// $contact->hydrate(array(
//     'nom'=>$_POST['nom'],
//     'prenom'=>$_POST['prenom'],
//     'photo'=>$_POST['photo'],
//     'telephone1'=>$_POST['telephone1'],
//     'telephone2'=>$_POST['telephone2'],
//     'adresse'=>$_POST['adresse'],
//     'email_personnel'=>$_POST['email_personnel'],
//     'email_pro'=>$_POST['email_pro'],
//     'genre'=>$_POST['genre'],
// ));

    public function __construct() {
        $this->table = 'contact';
    }

    // private function beautifyFetch($data){
    //     return new this(
    //         $data['id'],
    //         $data['nom'],
    //         $data['prenom'],
    //         $data['photo'],
    //         $data['telephone1'],
    //         $data['telephone2'],
    //         $data['adresse'],
    //         $data['email_personnel'],
    //         $data['email_pro'],
    //         $data['genre'],

    //     )
    // }

    public function findByName($nom){
        return $this->findBy(['nom'=>$nom]);
    }
    
    public function findByPhone($telephone){

        $sql = "SELECT * FROM {$this->table} WHERE telephone1=$telephone OR telephone2=$telephone"; 
        return $this->requete($sql)->fetch();
    }



    /**
     * Get the value of Id
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set the value of Id
     *
     * @return  self
     */

    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

     /**
     * Get the value of Nom
     */
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * Set the value of Nom
     *
     * @return  self
     */
    
    public function setNom($Nom)
    {
        $this->Nom = $Nom;

        return $this;
    }

     /**
     * Get the value of Prenom
     */
    public function getPrenom()
    {
        return $this->Prenom;
    }

    /**
     * Set the value of Prenom
     *
     * @return  self
     */
    
    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;

        return $this;
    }

     /**
     * Get the value of Photo
     */
    public function getPhoto()
    {
        return $this->Photo;
    }

    /**
     * Set the value of Photo
     *
     * @return  self
     */
    
    public function setPhoto($Photo)
    {
        $this->Photo = $Photo;

        return $this;
    }

     /**
     * Get the value of Telephone1
     */
    public function getTelephone1()
    {
        return $this->Telephone1;
    }

    /**
     * Set the value of Telephone1
     *
     * @return  self
     */
    
    public function setTelephone1($Telephone1)
    {
        $this->Telephone1 = $Telephone1;

        return $this;
    }

     /**
     * Get the value of Telephone2
     */
    public function getTelephone2()
    {
        return $this->Telephone2;
    }

    /**
     * Set the value of Telephone2
     *
     * @return  self
     */
    
    public function setTelephone2($Telephone2)
    {
        $this->Telephone2 = $Telephone2;

        return $this;
    }

     /**
     * Get the value of Adresse
     */
    public function getAdresse()
    {
        return $this->Adresse;
    }

    /**
     * Set the value of Adresse
     *
     * @return  self
     */
    
    public function setAdresse($Adresse)
    {
        $this->Adresse = $Adresse;

        return $this;
    }

     /**
     * Get the value of Email_perso
     */
    public function getEmail_perso()
    {
        return $this->Email_perso;
    }

    /**
     * Set the value of Email_perso
     *
     * @return  self
     */
    
    public function setEmail_perso($Email_perso)
    {
        $this->Email_perso = $Email_perso;

        return $this;
    }

     /**
     * Get the value of Email_pro
     */
    public function getEmail_pro()
    {
        return $this->Email_pro;
    }

    /**
     * Set the value of Email_pro
     *
     * @return  self
     */
    
    public function setEmail_pro($Email_pro)
    {
        $this->Email_pro = $Email_pro;

        return $this;
    }

     /**
     * Get the value of Genre
     */
    public function getGenre()
    {
        return $this->Genre;
    }

    /**
     * Set the value of Genre
     *
     * @return  self
     */
    
    public function setGenre($Genre)
    {
        $this->Genre = $Genre;

        return $this;
    }
}