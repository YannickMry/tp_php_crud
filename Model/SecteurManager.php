<?php

namespace App\Model;

require_once(app_path('Core/Manager.php'));
require_once(app_path('Model/Secteur.php'));

use \PDO;
use App\Core\Manager;
use App\Model\Secteur;

class SecteurManager extends Manager {

    const TABLE = 'secteur';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Permet de récupérer tous les secteurs stocké en BDD
     *
     * @return array
     */
    public function getAll()
    {
        $secteurs = $this->db->select(self::TABLE);

        foreach ($secteurs as &$secteur) {
            $secteur = cast('App\Model\Secteur', $secteur);
            $secteur->__set("STRUCTURES", (new StructureManager)->getStructures($secteur->ID));
        }

        return $secteurs;
    }

    /**
     * Permet de récupérer un secteur en BDD en fonction de l'ID passé en paramètre
     *
     * @param integer $id
     * @return Secteur
     */
    public function getOne(int $id)
    {
        $secteur = $this->db->select(self::TABLE, ['ID' => $id], 1);
        $secteur = cast('App\Model\Secteur', $secteur);
        $secteur->__set("STRUCTURES", (new StructureManager)->getStructures($secteur->ID));

        return $secteur;
    }

    public function insert(Secteur $secteur)
    {
        $query = $this->db->insert(self::TABLE, ['LIBELLE' => $secteur->LIBELLE]);

        if($query === false){
            throw new Exception("Impossible d'effectuer l'ajout de ce nouveau secteur");
        }
    }

    public function update(Secteur $secteur)
    {
        $query = $this->db->update(self::TABLE, [
            'ID'        => $secteur->ID,
            'LIBELLE'   => $secteur->LIBELLE
        ]);

        if($query === false){
            throw new Exception("Impossible d'effectuer une mise à jour sur l'enregistrement $secteur->__get('ID')");
        }
    }

    public function delete(int $id)
    {
        $query = $this->db->delete(self::TABLE, ['ID' => $id]);

        if($query === false){
            throw new Exception("Impossible de supprimer l'enregistrement $id dans la table secteur");
        }
    }

    /**
     * Permet de récupérer les secteurs d'une structure
     *
     * @param integer $id ID d'une structure
     * @return Secteur[]
     */
    public function getSecteurs(int $id)
    {
        $sql = 'SELECT secteur.ID, secteur.LIBELLE 
                FROM secteurs_structures ss
                JOIN secteur ON ss.ID_SECTEUR = secteur.ID
                WHERE ss.ID_STRUCTURE = :id';
        $query = $this->db->PDO->prepare($sql);
        $query->execute(['id' => $id]);
        $secteurs = $query->fetchAll(PDO::FETCH_CLASS, Secteur::class);

        return $secteurs;
    }
}