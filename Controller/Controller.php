<?php

namespace App\Controller;

require(app_path('/Model/Secteur.php'));
require(app_path('/Model/Structure.php'));
require(app_path('/Model/StructureManager.php'));
 
use App\Model\Secteur;
use App\Model\Structure;
use App\Model\StructureManager;

class Controller {
    
    public function __construct() {

    }

    public function index() {
        load_view('header');
        load_view('form');
        $sm = new StructureManager();
        echo '<pre>';
        var_dump($sm->getAll());
        echo '</pre>';
        load_view('footer');
    }
    public function test() {
        echo 'test';
    }
}