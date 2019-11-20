<?php

namespace App\Controller;

require('./Model/Secteur.php');
require('./Model/Structure.php');
 
use App\Model\Secteur;
use App\Model\Structure;

class Controller {
    
    public function __construct() {

    }

    public function index() {
        echo 'hello';
    }
}