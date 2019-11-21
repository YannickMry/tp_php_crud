<?php

namespace App\Controller;

require(app_path('/Model/Secteur.php'));
require(app_path('/Model/Structure.php'));
 
use App\Model\Secteur;
use App\Model\Structure;

class Controller {
    
    public function __construct() {

    }

    public function index() {
        load_view('header');
        load_view('form');
        load_view('footer');
    }
    public function test() {
        echo 'test';
    }
}