<?php

namespace App\Model;

require_once('./Model/Structure.php');
use App\Model\Structure;

class Entreprise extends Structure {

    private $NB_ACTIONNAIRES;
    private $ESTASSO;

    public function __construct($ID, $NOM, $RUE, $CP, $VILLE, $NB_ACTIONNAIRES) {
        parent::__construct($ID, $NOM, $RUE, $CP, $VILLE);
        $this->NB_ACTIONNAIRES = $NB_ACTIONNAIRES;
        $this->ESTASSO = false;
    }

    public function __get($property) {
        if(isset($this->{$property})) {
            return $this->{$property};
        }
    }

    public function __set($property, $value){
        $this->{$property} = $value;
        return $this;
    }

}