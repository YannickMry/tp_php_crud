<?php

namespace App\Model;

require_once('Database.php');
require_once('Entreprise.php');
require_once('Association.php');

use \PDO;
use App\Model\Database;
use App\Model\Entreprise;
use App\Model\Association;

class StructureManager {

    private $data;
    private $bdd;

    public function __construct() {
        $this->bdd = new Database();
    }

    public function getAll(){
        
        $sql = 'SELECT * FROM structure';

        foreach($this->bdd->client->query($sql, PDO::FETCH_OBJ) as $v){

            if($v->ESTASSO == true){
                $structure = new Association($v->ID, $v->NOM, $v->RUE, $v->CP, $v->VILLE, $v->NB_DONATEURS);
            } else {
                $structure = new Entreprise($v->ID, $v->NOM, $v->RUE, $v->CP, $v->VILLE, $v->NB_ACTIONNAIRES);
            }

            $this->data[] = $structure;
        }
        
        return $this->data;
    }

    public function getHeaders(){
        
        $sql = 'SHOW COLUMNS FROM structure';

        foreach($this->bdd->client->query($sql, PDO::FETCH_OBJ) as $v){
            $this->data[] = $v->Field;
        }

        return $this->data;
    }

}