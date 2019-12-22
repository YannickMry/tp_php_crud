<?php

namespace App\Model;

require_once(app_path('Core/Manager.php'));
require_once(app_path('Model/SecteurManager.php'));
require_once(app_path('Model/StructureManager.php'));

use App\Core\Manager;
use App\Model\SecteurManager;
use App\Model\StructureManager;
use \PDO;

class SecteursStructuresManager extends Manager {

    const TABLE = 'secteurs_structures';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function getAll()
    {
        $sql = 'SELECT ss.*, se.LIBELLE SECTEUR, st.NOM STRUCTURE, se.ID ID_SECTEUR, st.ID ID_STRUCTURE
        FROM secteurs_structures ss
        JOIN secteur se ON ss.ID_SECTEUR = se.ID
        JOIN structure st ON ss.ID_STRUCTURE = st.ID
        ORDER BY se.LIBELLE';

        $result = $this->db->PDO->query($sql)->fetchAll(PDO::FETCH_OBJ);

        $secteurs_structures = [];

        foreach($result as $r) {
            $secteur = (new SecteurManager)->getOne($r->ID_SECTEUR);
            $structure = (new StructureManager)->getOne($r->ID_STRUCTURE);
            $secteurs_structures[] = new SecteursStructures($r->ID, $secteur, $structure);
        }

        return $secteurs_structures;
    }

    public function getOne(int $id)
    {
        $sql = 'SELECT ss.*, se.LIBELLE SECTEUR, st.NOM STRUCTURE, se.ID ID_SECTEUR, st.ID ID_STRUCTURE
        FROM secteurs_structures ss
        JOIN secteur se ON ss.ID_SECTEUR = se.ID
        JOIN structure st ON ss.ID_STRUCTURE = st.ID
        WHERE ss.ID = :ID
        ORDER BY se.LIBELLE';

        $query = $this->db->PDO->prepare($sql);
        $query->execute(['ID' => $id]);
        $result = $query->fetch(PDO::FETCH_OBJ);

        if($result == false || $result == null) {
            return null;
        }

        $secteur = (new SecteurManager)->getOne($result->ID_SECTEUR);
        $structure = (new StructureManager)->getOne($result->ID_STRUCTURE);
        return new SecteursStructures($result->ID, $secteur, $structure);
    }

    public function getOneBySecteurAndStructure(int $ID_SECTEUR, int $ID_STRUCTURE)
    {
        $sql = 'SELECT ss.*, se.LIBELLE SECTEUR, st.NOM STRUCTURE, se.ID ID_SECTEUR, st.ID ID_STRUCTURE
        FROM secteurs_structures ss
        JOIN secteur se ON ss.ID_SECTEUR = se.ID
        JOIN structure st ON ss.ID_STRUCTURE = st.ID
        WHERE ss.ID_SECTEUR = :ID_SECTEUR AND ss.ID_STRUCTURE = :ID_STRUCTURE
        ORDER BY se.LIBELLE';

        $query = $this->db->PDO->prepare($sql);
        $query->execute([
            'ID_SECTEUR' => $ID_SECTEUR, 
            'ID_STRUCTURE' => $ID_STRUCTURE
        ]);
        $result = $query->fetch(PDO::FETCH_OBJ);

        if($result == false || $result == null) {
            return null;
        }

        $secteur = (new SecteurManager)->getOne($result->ID_SECTEUR);
        $structure = (new StructureManager)->getOne($result->ID_STRUCTURE);
        return new SecteursStructures($result->ID, $secteur, $structure);
    }

    public function insert($ss)
    {
        if($this->getOneBySecteurAndStructure($ss->secteur->ID, $ss->structure->ID) != null) {
            echo "Relation Secteur/Structure déjà existante";die();
        } else {

            if(
                $ss->ID != null &&
                $ss->structure->ID != null &&
                $ss->secteur->ID != null
            ) {

                $query = $this->db->insert(self::TABLE, [
                    'ID' => $ss->ID,
                    'ID_STRUCTURE' => $ss->structure->ID,
                    'ID_SECTEUR' => $ss->secteur->ID,
                ]);

                if($query === false){
                    echo "Impossible d'effectuer l'ajout de ce nouveau secteur";die();
                }
            } else {
                echo "Champ(s) manquant(s)";die();
            }
            
        }  
    }

    public function update($ss)
    {
        $existing_ss = $this->getOneBySecteurAndStructure($ss->secteur->ID, $ss->structure->ID);

        if($existing_ss->ID != $ss->ID) {

            echo "Relation Secteur/Structure déjà existante";die();

        } else {

            if(
                $ss->ID != null &&
                $ss->ID_SECTEUR != null &&
                $ss->ID_STRUCTURE != null
            ) {

                $query = $this->db->update(self::TABLE, [
                    'ID_SECTEUR' => $ss->ID_SECTEUR,
                    'ID_STRUCTURE' => $ss->ID_STRUCTURE
                ], ['ID' => $ss->ID]);

                if($query === false){
                    echo "Impossible d'effectuer la modification";die();
                }

            } else {
                echo "Champ(s) manquant(s)";die();
            }

            
        }  
    }

    public function delete(int $id)
    {
        $query = $this->db->delete(self::TABLE, ['ID' => $id]);

        if($query === false){
            echo "Impossible de supprimer l'enregistrement $id dans la table secteurs_structures";die();
        }
    }
}