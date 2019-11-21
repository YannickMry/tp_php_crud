<?php

namespace App\Model;

require_once('./Model/Structure.php');
use App\Model\Structure;

class Entreprise extends Structure {

    private $NB_ACTIONNAIRES;
    private $EST_ASSO;


    public function __construct($nom, $rue, $cp, $ville, $NB_ACTIONNAIRES) {
        parent::__construct($nom, $rue, $cp, $ville);
        $this->$NB_ACTIONNAIRES = $NB_ACTIONNAIRES;
        $this->EST_ASSO = false;
    }

    public function get_NB_ACTIONNAIRES() {
        return $this->NB_DONATIONS;
    }

    public function set_NB_ACTIONNAIRES($NB_ACTIONNAIRES) {
        $this->NB_ACTIONNAIRES = $NB_ACTIONNAIRES;
    }

    /**
     * Get the value of EST_ASSO
     */ 
    public function get_EST_ASSO()
    {
        return $this->EST_ASSO;
    }

    /**
     * Set the value of EST_ASSO
     *
     * @return  self
     */ 
    public function set_EST_ASSO($EST_ASSO)
    {
        $this->EST_ASSO = $EST_ASSO;

        return $this;
    }
}