<?php

namespace App\Controller;

require(app_path('/Core/Controller.php'));
require(app_path('/Model/SecteurManager.php'));
require(app_path('/Model/StructureManager.php'));
require(app_path('/Model/SecteursStructuresManager.php'));
 
use App\Core\Controller;
use App\Model\SecteurManager;
use App\Model\StructureManager;
use App\Model\SecteursStructuresManager;

class Main extends Controller {
    
    public function __construct() {
    }

    public function index() {

        $data['meta_title']         = 'Listes';
        $data['meta_description']   = 'La liste des données';
        
        $structure_m = new StructureManager();
        $secteur_m = new SecteurManager();
        $assoc_m = new SecteursStructuresManager();

        $structure_data['headers']  = $structure_m->getHeaders();
        $structure_data['rows']     = $structure_m->getAll();
        $structure_data['entity']    = 'Structure';

        $secteur_data['headers']    = $secteur_m->getHeaders();
        $secteur_data['rows']       = $secteur_m->getAll();
        $secteur_data['entity']      = 'Secteur';

        $assoc_data['headers']    = ['ID', 'SECTEUR', 'STRUCTURE'];
        $assoc_data['rows']       = $assoc_m->getAll();
        $assoc_data['entity']      = 'SecteursStructures';

        $this->load_view('header', $data);
        $this->load_view('table', $structure_data);
        $this->load_view('table', $secteur_data);
        $this->load_view('table', $assoc_data);
        $this->load_view('footer');
    }

    public function create() {
        
    }

    public function update(string $entity, int $id)
    {
        //TODO : utiliser $_POST
        $class = ucfirst($entity) . 'Manager';
        if(class_exists($class)) {
            var_dump(new $class());
        } else {
            echo "L'entité $entity n'existe pas dans le système";
        }
    }

    public function delete(string $entity, int $id)
    {
        $class = 'App\Model\\' . ucfirst($entity) . 'Manager';

        if(class_exists($class)) {
            (new $class())->delete($id);
            redirect();
        } else {
            echo "L'entité $entity n'existe pas dans le système";
        }
    }
}