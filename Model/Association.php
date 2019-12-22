<?php

namespace App\Model;

require_once(app_path('/Model/Structure.php'));

use App\Model\Structure;

class Association extends Structure {
    
    private $NB_DONATEURS;

    public function __construct($ID = null, $NOM = '', $RUE = '', $CP = null, $VILLE = '', $NB_DONATEURS = null)
    {
        parent::__construct($ID, $NOM, $RUE, $CP, $VILLE);
        $this->NB_DONATEURS = $NB_DONATEURS;
        $this->ESTASSO = true;
    }

    public function __get($property)
    {
        if(isset($this->{$property})) {
            return $this->{$property};
        }
    }

    public function __set($property, $value)
    {
        $this->{$property} = $value;
        return $this;
    }
}