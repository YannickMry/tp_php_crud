<?php

namespace App\Model;

require_once(app_path('Core/Manager.php'));

use App\Core\Manager;
use \PDO;

class SecteursStructuresManager extends Manager {

    const TABLE = 'secteurs_structures';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function getAll()
    {
        $sql = 'SELECT ss.ID, se.LIBELLE SECTEUR, st.NOM STRUCTURE
        FROM secteurs_structures ss
        JOIN secteur se ON ss.ID_SECTEUR = se.ID
        JOIN structure st ON ss.ID_STRUCTURE = st.ID
        ORDER BY se.LIBELLE';
        $secteursStructures = $this->db->PDO->query($sql)->fetchAll(PDO::FETCH_OBJ);
        $data = [];
        // ? 
        // foreach($secteursStructures as $k => $secteurStructure){
        //     $secteurM = new SecteurManager();
        //     $structureM = new StructureManager();

        //     $data[$k][] = $secteurM->getOne($secteurStructure->ID_SECTEUR);
        //     $data[$k][] = $structureM->getOne($secteurStructure->ID_STRUCTURE);
        // }
        return $secteursStructures;
    }

    public function update()
    {

    }
}