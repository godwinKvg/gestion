<?php


class Contact
{
    protected $id;
    protected $idGroupe;
    protected $idContact;

    public function __construct($id, $idGroupe, $idContact)
    {
        $this->table = 'groupe';

        $this->id = $id;
        $this->idGroupe = $idGroupe;
        $this->idContact = $idContact;
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
