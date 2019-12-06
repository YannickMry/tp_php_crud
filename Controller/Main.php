<?php

namespace App\Controller;

require(app_path('/Core/Controller.php'));
require(app_path('/Model/Secteur.php'));
require(app_path('/Model/Structure.php'));
require(app_path('/Model/StructureManager.php'));
 
use App\Core\Controller;
use App\Model\Secteur;
use App\Model\Structure;
use App\Model\StructureManager;

class Main extends Controller {
    
    public function __construct() {

    }

    public function index() {

        $data['meta_title']         = 'mon titre';
        $data['meta_description']   = 'ma description';
        
        $sm = new StructureManager();

        $table_data['headers'] = $sm->getHeaders();
        $table_data['rows'] = $sm->getAll();

        $this->load_view('header', $data);
        $this->load_view('form_structure');
        $this->load_view('table', $table_data);
        $this->load_view('footer');
    }
    public function test() {
        echo 'test';
    }
}