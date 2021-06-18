<?php

require_once 'Model.php';

class GrpeContact extends Model
{
    protected $id;
    protected $id_gpe;
    protected $id_contact;




    public function __construct($id = null, $idGroupe = null, $idContact = null)
    {
        $this->table = 'contact_groupe';

        $this->id = $id;
        $this->id_gpe = $idGroupe;
        $this->id_contact = $idContact;
    }


    public function removeContactFromGroup(int $idContact, int $idGroupe)
    {
        // $gpeContact = new GrpeContact;
        $sql = "DELETE FROM {$this->table}  WHERE id_gpe={$idGroupe} AND id_contact={$idContact}";

        return $this->requete($sql)->fetch();
    }

    public function removeGroupe(int $id)
    {
        $sql = "DELETE FROM {$this->table}  WHERE id_gpe={$id}";

        return $this->requete($sql)->fetch();
    }


    public function removeContact(int $id)
    {
        $sql = "DELETE FROM {$this->table}  WHERE id_contact={$id}";

        return $this->requete($sql)->fetch();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId_gpe()
    {
        return $this->id_gpe;
    }

    public function setId_gpe($id_gpe)
    {
        $this->id_gpe = $id_gpe;
    }

    public function getId_contact()
    {
        return $this->id_contact;
    }

    public function setId_contact($id_contact)
    {
        $this->id_contact = $id_contact;
    }
}