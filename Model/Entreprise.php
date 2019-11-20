<?php

namespace App\Model;

require_once('./Model/Structure.php');
use App\Model\Structure;

class Entreprise extends Structure {

    private int $NB_ACTIONNAIRES;

    public function __construct() {
        parent::__construct();
    }

    public function get_NB_ACTIONNAIRES() {
        return $this->NB_DONATIONS;
    }

    public function set_NB_ACTIONNAIRES($NB_ACTIONNAIRES) {
        $this->NB_ACTIONNAIRES = $NB_ACTIONNAIRES;
    }
}