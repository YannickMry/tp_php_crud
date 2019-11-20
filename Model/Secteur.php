<?php

namespace App\Model\Secteur;

class Secteur {

    private $libelle;

    public function __construct(string $libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }
}