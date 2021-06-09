<?php

require_once 'Database.php';
abstract class Model extends Database
{
    private $pdo;
    protected $table;

    /**
     * Méthode qui exécutera les requêtes
     * 
     * @param string $sql Requête SQL à exécuter
     * @param array $attributes Attributs à ajouter à la requête 
     * @return PDOStatement|false 
     */


    public function requete(string $sql, array $attributs = null)
    {
        $this->pdo = Database::getInstance();

        // Si il y a des attributs
        if ($attributs !== null) {

            // Requête préparée
            $query = $this->pdo->prepare($sql);
            $query->execute($attributs);

            return $query;
        } else {

            // Requête simple
            return $this->pdo->query($sql);
        }
    }

    public function findLimit($premier, $parPage)
    {
        $sql = "SELECT * FROM $this->table LIMIT :premier, :parpage";
        $req = $this->pdo->prepare($sql);
        $req->bindValue(':premier', $premier, PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = ?", array($id))->fetch();
    }

    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    /**
     * Supprimer en base de données
     *
     * @param integer $id
     * @param string $table
     * @return void
     */
    public function delete(int $id)
    {
        $this->requete("DELETE FROM {$this->table} WHERE id = ?", array($id));
    }

    public function findBy(array $criteres)
    {
        $champs = array();
        $valeurs = array();

        foreach ($criteres as $champ => $valeur) {

            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }



        $liste_champs = implode(' AND ', $champs);



        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetch();
    }

    public function update()
    {
        $champs = [];
        $valeurs = [];

        foreach ($this as $champ => $valeur) {


            if ($valeur !== null && $champ != 'pdo' && $champ != 'table') {

                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }

        $valeurs[] = $this->id;

        $liste_champs = implode(', ', $champs);

        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }

    /**
     * Insert en base de données
     *
     * @return void
     */
    public function insert()
    {
        $champs = array();
        $inter = array();
        $valeurs = array();

        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ != 'pdo' && $champ != 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ')VALUES(' . $liste_inter . ')', $valeurs);
    }

    /**
     * Permet de récupérer le setter correspondant
     *
     * @param [type] $donnees
     * @return void
     */
    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value) {

            $setter = 'set' . ucfirst($key);


            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }
}
