<?php


class Contact
{
    protected $id;
    protected $id_gpe;
    protected $id_contact;

    public function __construct($id, $idGroupe, $idContact)
    {
        $this->table = 'groupe_contact';

        $this->id = $id;
        $this->id_gpe = $idGroupe;
        $this->id_contact = $idContact;
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
}