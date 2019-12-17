<?php

namespace App\Model;

class Secteur {

    private $ID;
    private $LIBELLE;
    private $STRUCTURES;

    public function __get($property) {
        return $this->{$property};
    }

    public function __set($property, $value) {
        return $this->{$property} = $value;
    }

}