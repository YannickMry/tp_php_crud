<?php

namespace App\Controller;

require(app_path('/Core/Controller.php'));
require(app_path('/Model/Secteur.php'));
require(app_path('/Model/SecteurManager.php'));
require(app_path('/Model/Structure.php'));
require(app_path('/Model/StructureManager.php'));
 
use App\Core\Controller;
use App\Model\Secteur;
use App\Model\SecteurManager;
use App\Model\Structure;
use App\Model\StructureManager;

class Main extends Controller {
    
    public function __construct() {
    }

    public function index() {

        $data['meta_title']         = 'mon titre';
        $data['meta_description']   = 'ma description';
        
        $structure_m = new StructureManager();
        $secteur_m = new SecteurManager();

        $structure_data['headers'] = $structure_m->getHeaders();
        $structure_data['rows'] = $structure_m->getAll();

        $secteur_data['headers'] = $secteur_m->getHeaders();
        $secteur_data['rows'] = $secteur_m->getAll();
        var_dump($secteur_data);
        $this->load_view('header', $data);
        $this->load_view('table', $structure_data);
        $this->load_view('table', $secteur_data);
        $this->load_view('footer');
    }
    public function test() {
        echo 'test';
    }
}