<?php

namespace App\Model;

class Structure {

    protected $ID;
    protected $NOM;
    protected $RUE;
    protected $CP;
    protected $VILLE;
    protected $SECTEURS;
    protected $ESTASSO;

    public function __construct(int $ID = null, string $NOM = '', string $RUE = '', string $CP = null, string $VILLE = '')
    {
        $this->ID = $ID;
        $this->NOM = $NOM;
        $this->RUE = $RUE;
        $this->CP = $CP;
        $this->VILLE = $VILLE;
    }

    public function __get($property) {
        return $this->{$property};
    }

    public function __set($property, $value) {
        return $this->{$property} = $value;
    }

}