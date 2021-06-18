<?php

require_once 'Model.php';
require_once 'GrpeContact.php';
class Groupe extends Model
{
    protected $id;
    protected $nom;
    protected $image;

    public function __construct()
    {
        $this->table = 'groupe';
    }


    public function findAllByName($nom)
    {
        $nom = strtolower(Sanitizer::sanitize($nom));
        $sql = "SELECT * FROM {$this->table} WHERE LOWER(nom) LIKE '%$nom%'";
        return $this->requete($sql)->fetchAll();
    }

    public function findAllByContactId(int $id)
    {
        // $gpeContact = new GrpeContact;
        $sql = "SELECT g.* FROM {$this->table} g, contact_groupe gc WHERE gc.id_gpe=g.id AND gc.id_contact={$id}";



        return $this->requete($sql)->fetchAll();
    }



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
     * Get the value of Id
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of Id
     *
     * @return  self
     */

    public function setNom($nom)
    {

        $this->nom = Sanitizer::sanitize($nom);

        return $this;
    }

    /**
     * Get the value of Id
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of Id
     *
     * @return  self
     */

    public function setImage($image)
    {
        $this->image = Sanitizer::sanitize($image);
    }
}