<?php

namespace App\Model;

require_once(app_path('Core/Manager.php'));
require_once('Model/Entreprise.php');
require_once('Model/Association.php');

use App\Core\Manager;
use App\Model\Entreprise;
use App\Model\Association;
use stdClass;
use \PDO;

class StructureManager extends Manager {

    const TABLE = 'structure';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Permet de récupérer toutes les structures stockées en BDD
     *
     * @return array
     */
    public function getAll()
    {
        $structures = $this->db->select(self::TABLE);

        foreach($structures as &$s){
            $s = $this->createEntrepriseOrAssociationObject($s);
        }

        return $structures;
    }

    /**
     * Permet de récupérer une structure en BDD en fonction de l'ID passé en paramètre
     *
     * @param integer $id
     * @return Entreprise|Association
     */
    public function getOne(int $id)
    {
        $structure = $this->db->select(self::TABLE, ['ID' => $id], 1);

        if($structure === false){
            echo 'Aucune structure ne correspond à cet ID';die();
        }

        return $this->createEntrepriseOrAssociationObject($structure);
    }

    /**
     * Permet de d'insérer une structure en BDD
     *
     * @param Structure $structure
     */
    public function insert($structure)
    {   
        if(
            $structure->NOM != null &&
            $structure->RUE != null &&
            $structure->CP != null &&
            $structure->VILLE != null
        ) {
            $last_insert_id = $this->db->insert(self::TABLE, [
                'ID'                => $structure->ID,
                'NOM'               => $structure->NOM,
                'RUE'               => $structure->RUE,
                'CP'                => $structure->CP,
                'VILLE'             => $structure->VILLE,
                'ESTASSO'           => $structure->ESTASSO == 'on' || $structure->ESTASSO == true  ? 1 : 0,
                'NB_DONATEURS'      => $structure->NB_DONATEURS,
                'NB_ACTIONNAIRES'   => $structure->NB_ACTIONNAIRES,
            ]);
    
            if($last_insert_id == false){
                echo "Impossible d'effectuer l'ajout de la structure " . $structure->NOM;die();
            }

        } else {
            echo "Champ(s) manquant(s)";die();
        }  
    }
    /**
     * Permet de modifier une structure en BDD
     *
     * @param Structure $structure
     */
    public function update($structure)
    {
        if(
            $structure->NOM != null &&
            $structure->RUE != null &&
            $structure->CP != null &&
            $structure->VILLE != null
        ) {

            $query = $this->db->update(self::TABLE, [
                'NOM'               => $structure->NOM,
                'RUE'               => $structure->RUE,
                'CP'                => $structure->CP,
                'VILLE'             => $structure->VILLE,
                'ESTASSO'           => $structure->ESTASSO == 'on' || $structure->ESTASSO == true  ? 1 : 0,
                'NB_DONATEURS'      => $structure->NB_DONATEURS,
                'NB_ACTIONNAIRES'   => $structure->NB_ACTIONNAIRES,
            ], ['ID' => $structure->ID]);
    
            if($query === false){
                echo "Impossible d'effectuer une mise à jour sur l'enregistrement $secteur->ID";die();
            }

        } else {
            echo "Champ(s) manquant(s)";die();
        }
        
    }

    /**
     * Permet de supprimer une structure en BDD en fonction de l'ID passé en paramètre
     *
     * @param integer $id
     */
    public function delete(int $id)
    {
        $query = $this->db->delete(self::TABLE, ['ID' => $id]);

        if($query === false){
            echo "Impossible de supprimer l'enregistrement $id dans la table structure";die();
        }
    }

    /**
     * Permet de récupérer les structures d'un secteur
     *
     * @param integer $id ID d'un secteur
     * @return array
     */
    public function getStructures(int $id)
    {
        $sql = 'SELECT structure.* 
                FROM secteurs_structures ss
                JOIN structure ON ss.ID_SECTEUR = structure.ID
                WHERE ss.ID_SECTEUR = :id';
        $query = $this->db->PDO->prepare($sql);
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
    public function createEntrepriseOrAssociationObject(stdClass $s)
    {
        if(intval($s->ESTASSO) === 1){
            $structure = new Association($s->ID, $s->NOM, $s->RUE, $s->CP, $s->VILLE, $s->NB_DONATEURS);
        } else {
            $structure = new Entreprise($s->ID, $s->NOM, $s->RUE, $s->CP, $s->VILLE, $s->NB_ACTIONNAIRES);
        }

        $structure->SECTEURS =  (new SecteurManager())->getSecteurs($s->ID);
        
        return $structure;
    }

}