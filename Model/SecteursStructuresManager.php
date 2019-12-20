<?php

namespace App\Model;

use PDO;
use App\Model\Database;
use App\Model\SecteurManager;

class SecteursStructuresManager {

    private $bdd;

    public function __construct() {
        $this->bdd = new Database();
    }

    // ? Est ce qu'il y a vraiment besoin de cette fonction ?
    public function getAll()
    {
        $sql = 'SELECT secteurs_structures.ID, secteur.LIBELLE, structure.NOM
        FROM secteurs_structures
        JOIN secteur ON secteurs_structures.ID_SECTEUR = secteur.ID
        JOIN structure ON secteurs_structures.ID_STRUCTURE = structure.ID
        ORDER BY secteur.LIBELLE';
        $secteursStructures = $this->bdd->client->query($sql)->fetchAll(PDO::FETCH_OBJ);
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