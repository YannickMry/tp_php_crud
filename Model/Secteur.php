<?php

namespace App\Model;

class Secteur {

    private $ID;
    private $LIBELLE;

    public function __construct(int $ID, string $LIBELLE)
    {
        $this->ID = $ID;
        $this->LIBELLE = $LIBELLE;
    }

    public function __get($property) {
        return $this->{$property};
    }

    public function __set($property, $value) {
        return $this->{$property} = $value;
    }

}