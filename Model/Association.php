<?php

namespace App\Model;

require_once('./Model/Structure.php');
use App\Model\Structure;

class Association extends Structure {
    
    private int $NB_DONATIONS;

    public function __construct() {
        parent::__construct();
    }

    public function get_NB_DONATIONS() {
        return $this->NB_DONATIONS;
    }

    public function set_NB_DONATIONS($NB_DONATIONS) {
        $this->NB_DONATIONS = $NB_DONATIONS;
    }
}