<?php

namespace App\Model;

require_once(app_path('/Model/Structure.php'));

use App\Model\Structure;

class Association extends Structure {
    
    private $NB_DONATEURS;
    private $ESTASSO;

    public function __construct($ID, $nom, $rue, $cp, $ville, $NB_DONATEURS) {
        parent::__construct($ID, $nom, $rue, $cp, $ville);
        $this->NB_DONATEURS = $NB_DONATEURS;
        $this->ESTASSO = true;
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