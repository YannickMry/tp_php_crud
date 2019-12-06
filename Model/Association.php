<?php

namespace App\Model;

require_once(app_path('/Model/Structure.php'));

use App\Model\Structure;

class Association extends Structure {
    
    private $NB_DONATIONS;
    private $EST_ASSO;

    public function __construct($ID, $nom, $rue, $cp, $ville, $NB_DONATIONS) {
        parent::__construct($ID, $nom, $rue, $cp, $ville);
        $this->NB_DONATIONS = $NB_DONATIONS;
        $this->EST_ASSO = true;
    }

    public function get_NB_DONATIONS() {
        return $this->NB_DONATIONS;
    }

    public function set_NB_DONATIONS($NB_DONATIONS) {
        $this->NB_DONATIONS = $NB_DONATIONS;
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