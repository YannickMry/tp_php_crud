<?php

namespace App\Model;

require_once('Database.php');
require_once('Secteur.php');

use \PDO;
use App\Model\Database;
use App\Model\Secteur;
use Exception;

class SecteurManager {

    private $bdd;

    public function __construct() {
        $this->bdd = new Database();
    }

    /**
     * Permet de récupérer tous les secteurs stocké en BDD
     *
     * @return array
     */
    public function getAll(){
        
        $sql = 'SELECT * FROM secteur ORDER BY id ASC';
        $secteurs = $this->bdd->client->query($sql, PDO::FETCH_CLASS, Secteur::class)->fetchAll();
        foreach ($secteurs as $secteur) {
            $secteur->__set("STRUCTURES", (new StructureManager)->getStructures($secteur->__get("ID")));
        }
        return $secteurs;
    }

    /**
     * Permet de récupérer un secteur en BDD en fonction de l'ID passé en paramètre
     *
     * @param integer $id
     * @return Secteur
     */
    public function getOne(int $id){
        $sql = 'SELECT * FROM secteur WHERE id = :id';
        $query = $this->bdd->client->prepare($sql);
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, Secteur::class);
        $secteur = $query->fetch();
        $secteur->__set("STRUCTURES", (new StructureManager)->getStructures($secteur->__get("ID")));
        if($secteur === false){
            throw new Exception('Aucun secteur ne correspond à cet ID');
        }

        return $secteur;
    }

    public function insert(Secteur $secteur){
        $sql = 'INSERT INTO secteur (LIBELLE) VALUES (:libelle)';

        $query = $this->bdd->client->prepare($sql);
        $req = $query->execute([
            'libelle'   => $secteur->__get("LIBELLE")
        ]);
        if($req === false){
            throw new Exception("Impossible d'effectuer l'ajout de ce nouveau secteur");
        }
    }

    public function update(Secteur $secteur){
        $sql = 'UPDATE secteur SET LIBELLE = :libelle WHERE ID = :id';

        $query = $this->bdd->client->prepare($sql);
        $req = $query->execute([
            'id'        => $secteur->__get("ID"),
            'libelle'   => $secteur->__get("LIBELLE")
        ]);
        if($req === false){
            throw new Exception("Impossible d'effectuer une mise à jour sur l'enregistrement $secteur->__get('ID')");
        }
    }

    public function delete(int $id){
        $sql = 'DELETE FROM secteur WHERE id = ?';
        $query = $this->bdd->client->prepare($sql);
        $req = $query->execute([$id]);

        if($req === false){
            throw new Exception("Impossible de supprimer l'enregistrement $id dans la table secteur");
        }
    }

    /**
     * Permet de récupérer les secteurs d'une structure
     *
     * @param integer $id ID d'une structure
     * @return Secteur[]
     */
    public function getSecteurs(int $id){
        $sql = 'SELECT secteur.ID, secteur.LIBELLE 
                FROM secteurs_structures ss
                JOIN secteur ON ss.ID_SECTEUR = secteur.ID
                WHERE ss.ID_STRUCTURE = :id';
        $query = $this->bdd->client->prepare($sql);
        $query->execute(['id' => $id]);
        $secteurs = $query->fetchAll(PDO::FETCH_CLASS, Secteur::class);

        return $secteurs;
    }

    /**
     * Permet de récupérer tous les headers de la table secteur
     *
     * @return array
     */
    public function getHeaders(){
        
        $sql = 'SHOW COLUMNS FROM secteur';
        $data = [];

        foreach($this->bdd->client->query($sql, PDO::FETCH_OBJ) as $v){
            $data[] = $v->Field;
        }

        return $data;
    }

}