<?php

require_once 'Model.php';

class Contact extends Model
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $photo;
    protected $telephone1;
    protected $telephone2;
    protected $adresse;
    protected $email_perso;
    protected $email_pro;
    protected $genre;


    public function __construct()
    {
        $this->table = 'contact';
    }



    public function findByName($nom)
    {
        $nom = Sanitizer::sanitize($nom);
        return $this->findBy(['nom' => $nom]);
    }

    public function findByPhone($telephone)
    {
        $telephone = Sanitizer::sanitize($telephone);
        $sql = "SELECT * FROM {$this->table} WHERE telephone1=$telephone OR telephone2=$telephone";
        return $this->requete($sql)->fetch();
    }

    // public static function getGroups($id){
    //     $sql = "SELECT * FROM {$this->table}, groupe_contact WHERE telephone1=$telephone OR telephone2=$telephone";
    //     return $this->requete($sql)->fetch();
    // }

    /**
     * Get the value of Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @return  self
     */

    public function setId($id)
    {

        $this->id = (int) Sanitizer::sanitize($id);

        return $this;
    }

    /**
     * Get the value of Nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of Nom
     *
     * @return  self
     */

    public function setNom($nom)
    {

        $this->nom = Sanitizer::sanitize($nom);

        return $this;
    }

    /**
     * Get the value of Prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of Prenom
     *
     * @return  self
     */

    public function setPrenom($prenom)
    {

        $this->prenom = Sanitizer::sanitize($prenom);

        return $this;
    }

    /**
     * Get the value of Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of Photo
     *
     * @return  self
     */

    public function setPhoto($photo)
    {

        $this->photo = Sanitizer::sanitize($photo);

        return $this;
    }

    /**
     * Get the value of Telephone1
     */
    public function getTelephone1()
    {
        return $this->telephone1;
    }

    /**
     * Set the value of Telephone1
     *
     * @return  self
     */

    public function setTelephone1($telephone1)
    {

        $this->telephone1 = Sanitizer::sanitize($telephone1);

        return $this;
    }

    /**
     * Get the value of Telephone2
     */
    public function getTelephone2()
    {
        return $this->telephone2;
    }

    /**
     * Set the value of Telephone2
     *
     * @return  self
     */

    public function setTelephone2($telephone2)
    {

        $this->telephone2 = Sanitizer::sanitize($telephone2);

        return $this;
    }

    /**
     * Get the value of Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of Adresse
     *
     * @return  self
     */

    public function setAdresse($adresse)
    {

        $this->adresse = Sanitizer::sanitize($adresse);

        return $this;
    }

    /**
     * Get the value of Email_perso
     */
    public function getEmail_perso()
    {
        return $this->email_perso;
    }

    /**
     * Set the value of Email_perso
     *
     * @return  self
     */

    public function setEmail_perso($email_perso)
    {

        $this->email_perso = Sanitizer::sanitize($email_perso);

        return $this;
    }

    /**
     * Get the value of Email_pro
     */
    public function getEmail_pro()
    {
        return $this->email_pro;
    }

    /**
     * Set the value of Email_pro
     *
     * @return  self
     */

    public function setEmail_pro($email_pro)
    {

        $this->email_pro = Sanitizer::sanitize($email_pro);

        return $this;
    }

    /**
     * Get the value of Genre
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of Genre
     *
     * @return  self
     */

    public function setGenre($genre)
    {

        $this->genre = Sanitizer::sanitize($genre);

        return $this;
    }
}