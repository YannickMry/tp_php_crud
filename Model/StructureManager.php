<?php

namespace App\Model;

require_once('Database.php');
require_once('Entreprise.php');
require_once('Association.php');

use \PDO;
use Exception;
use App\Model\Database;
use App\Model\Entreprise;
use App\Model\Association;
use stdClass;

class StructureManager {

    private $bdd;

    public function __construct() {
        $this->bdd = new Database();
    }

    /**
     * Permet de récupérer toutes les structures stocké en BDD
     *
     * @return array
     */
    public function getAll(){
        
        $sql = 'SELECT * FROM structure';

        $query = $this->bdd->client->query($sql);
        $structures = $query->fetchAll(PDO::FETCH_OBJ);
        

        foreach($structures as $s){
            
            $data[] = $this->createEntrepriseOrAssociationObject($s);
        }

        return $data;
    }

    /**
     * Permet de récupérer une structure en BDD en fonction de l'ID passé en paramètre
     *
     * @param integer $id
     * @return Entreprise|Association
     */
    public function getOne(int $id){
        $sql = 'SELECT * FROM structure WHERE id = :id';
        $query = $this->bdd->client->prepare($sql);
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_OBJ);
        $structure = $query->fetch();

        if($structure === false){
            throw new Exception('Aucune structure ne correspond à cet ID');
        }

        return $this->createEntrepriseOrAssociationObject($structure);
    }

    public function delete(int $id){
        $sql = 'DELETE FROM structure WHERE id = ?';
        $query = $this->bdd->client->prepare($sql);
        $req = $query->execute([$id]);

        if($req === false){
            throw new Exception("Impossible de supprimer l'enregistrement $id dans la table structure");
        }
    }

    /**
     * Permet de récupérer tous les headers de la table structure
     *
     * @return array
     */
    public function getHeaders(){
        
        $sql = 'SHOW COLUMNS FROM structure';

        foreach($this->bdd->client->query($sql, PDO::FETCH_OBJ) as $v){
            $data[] = $v->Field;
        }

        return $data;
    }

    /**
     * Permet de récupérer les structures d'un secteur
     *
     * @param integer $id ID d'un secteur
     * @return array
     */
    public function getStructures(int $id){
        $sql = 'SELECT structure.* 
                FROM secteurs_structures ss
                JOIN structure ON ss.ID_SECTEUR = structure.ID
                WHERE ss.ID_SECTEUR = :id';
        $query = $this->bdd->client->prepare($sql);
        $query->execute(['id' => $id]);
        $structures = $query->fetchAll(PDO::FETCH_OBJ);

        $data = [];
        foreach($structures as $s){
            
            $data[] = $this->createEntrepriseOrAssociationObject($s);
        }
        
        return $data;
    }

    /**
     * Permet de créer un objet Entreprise ou Association en fonction de l'objet stdClass envoyé en paramètre
     *
     * @param stdClass $s
     * @return Entreprise|Association
     */
    private function createEntrepriseOrAssociationObject(stdClass $s)
    {
        if($s->ESTASSO === '1'){
            $structure = new Association($s->ID, $s->NOM, $s->RUE, $s->CP, $s->VILLE, $s->NB_DONATEURS);
        } else {
            $structure = new Entreprise($s->ID, $s->NOM, $s->RUE, $s->CP, $s->VILLE, $s->NB_ACTIONNAIRES);
        }
        $structure->__set("SECTEURS", (new SecteurManager())->getSecteurs($s->ID));

        return $structure;
    }

}