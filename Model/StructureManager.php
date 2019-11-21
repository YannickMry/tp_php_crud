<?php

namespace App\Model;

require_once('Database.php');
require_once('Entreprise.php');
require_once('Association.php');

use App\Model\Database;
use App\Model\Entreprise;
use App\Model\Association;

class StructureManager{

    private $data;

    public function getAll(){
        $bdd = new Database();
        $sql = 'SELECT * FROM structure';

        foreach($bdd->client->query($sql) as $v){

            if($v['ESTASSO'] == true){
                $structure = new Association($v['NOM'], $v['RUE'], $v['CP'], $v['VILLE'], $v['NB_DONATEURS']);
            } else {
                $structure = new Entreprise($v['NOM'], $v['RUE'], $v['CP'], $v['VILLE'], $v['NB_ACTIONNAIRES']);
            }

            $this->data[] = $structure;
        }
        
        return $this->data;
    }

}