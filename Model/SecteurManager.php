<?php

namespace App\Model;

require_once('Database.php');
require_once('Secteur.php');

use \PDO;
use App\Model\Database;
use App\Model\Secteur;

class SecteurManager {

    private $data;
    private $bdd;

    public function __construct() {
        $this->bdd = new Database();
    }

    public function getAll(){
        
        $sql = 'SELECT * FROM secteur';

        foreach($this->bdd->client->query($sql, PDO::FETCH_OBJ) as $v){
            $this->data[] = new Secteur($v->ID, $v->LIBELLE);
        }
        return $this->data;
    }

    public function getHeaders(){
        
        $sql = 'SHOW COLUMNS FROM secteur';

        foreach($this->bdd->client->query($sql, PDO::FETCH_OBJ) as $v){
            $this->data[] = $v->Field;
        }

        return $this->data;
    }

}