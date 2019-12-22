<?php

namespace App\Model;

class SecteursStructures {
    
    private $ID;
    private $secteur;
    private $structure;

    public function __construct($ID = null, $secteur = null, $structure = null) {
        $this->ID = $ID;
        $this->secteur = $secteur;
        $this->structure = $structure;
    }

    public function __get($property) {
        return $this->{$property};
    }

    public function __set($property, $value) {
        return $this->{$property} = $value;
    }
}