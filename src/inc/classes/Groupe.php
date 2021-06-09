<?php

require_once 'Model.php';
class Groupe extends Model
{
    protected $id;
    protected $nom;
    protected $image;

    public function __construct()
    {
        $this->table = 'groupe';
    }


    public function findByName($nom)
    {
        return $this->findBy(['nom' => $nom]);
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
