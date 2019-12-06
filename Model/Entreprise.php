<?php

namespace App\Model;

require_once('./Model/Structure.php');
use App\Model\Structure;

class Entreprise extends Structure {

    private $NB_ACTIONNAIRES;
    private $ESTASSO;

    public function __construct($ID, $nom, $rue, $cp, $ville, $NB_ACTIONNAIRES) {
        parent::__construct($ID, $nom, $rue, $cp, $ville);
        $this->$NB_ACTIONNAIRES = $NB_ACTIONNAIRES;
        $this->ESTASSO = false;
    }

    public function get_NB_ACTIONNAIRES() {
        return $this->NB_DONATIONS;
    }

    public function set_NB_ACTIONNAIRES($NB_ACTIONNAIRES) {
        $this->NB_ACTIONNAIRES = $NB_ACTIONNAIRES;
    }

    /**
     * Get the value of ESTASSO
     */ 
    public function get_ESTASSO()
    {
        return $this->ESTASSO;
    }

    /**
     * Set the value of ESTASSO
     *
     * @return  self
     */ 
    public function set_ESTASSO($ESTASSO)
    {
        $this->ESTASSO = $ESTASSO;

        return $this;
    }
}