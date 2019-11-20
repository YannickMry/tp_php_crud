<?php

namespace App\Model\Structure;

class Structure {

    private $nom;
    private $rue;
    private $cp;
    private $ville;
    private $estAsso;
    private $nbDonateurs;
    private $nbActionnaires;

    public function __construct(string $nom, string $rue, string $cp, bool $estAsso, int $nbDonateurs, int $nbActionnaires)
    {
        $this->nom = $nom;
        $this->rue = $rue;
        $this->cp = $cp;
        $this->estAsso = $estAsso;
        $this->nbDonateurs = $nbDonateurs;
        $this->nbActionnaires = $nbActionnaires;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of rue
     */ 
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set the value of rue
     *
     * @return  self
     */ 
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get the value of cp
     */ 
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */ 
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of estAsso
     */ 
    public function getEstAsso()
    {
        return $this->estAsso;
    }

    /**
     * Set the value of estAsso
     *
     * @return  self
     */ 
    public function setEstAsso($estAsso)
    {
        $this->estAsso = $estAsso;

        return $this;
    }

    /**
     * Get the value of nbDonateurs
     */ 
    public function getNbDonateurs()
    {
        return $this->nbDonateurs;
    }

    /**
     * Set the value of nbDonateurs
     *
     * @return  self
     */ 
    public function setNbDonateurs($nbDonateurs)
    {
        $this->nbDonateurs = $nbDonateurs;

        return $this;
    }

    /**
     * Get the value of nbActionnaires
     */ 
    public function getNbActionnaires()
    {
        return $this->nbActionnaires;
    }

    /**
     * Set the value of nbActionnaires
     *
     * @return  self
     */ 
    public function setNbActionnaires($nbActionnaires)
    {
        $this->nbActionnaires = $nbActionnaires;

        return $this;
    }
}