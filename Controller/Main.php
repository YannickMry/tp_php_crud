<?php

namespace App\Controller;

require(app_path('/Core/Controller.php'));
require(app_path('/Model/SecteurManager.php'));
require(app_path('/Model/StructureManager.php'));
require(app_path('/Model/SecteursStructuresManager.php'));
require_once(app_path('/Model/Secteur.php'));
require_once(app_path('/Model/Structure.php'));
require_once(app_path('/Model/SecteursStructures.php'));
 
use App\Core\Controller;
use App\Model\SecteurManager;
use App\Model\StructureManager;
use App\Model\SecteursStructuresManager;
use App\Model\Secteur;
use App\Model\Structure;
use App\Model\SecteursStructures;

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

    public function create(string $entity) {

        if(isset($_POST) && !empty($_POST)) {

            $class = 'App\Model\\' . ucfirst($entity) . 'Manager';

            if(class_exists($class)) {

                $manager = new $class();

                if(ucfirst($entity) == 'Structure') {
                    if(isset($_POST['ESTASSO'])) {
                        $entity = 'Association';
                    } else {
                        $entity = 'Entreprise';
                    }
                }

                $entity = 'App\Model\\' . $entity;

                $instance = new $entity();

                foreach($_POST as $k => $v) {
                    if($entity == 'App\Model\Structure' && $k == 'NB') {
                        if($entity == 'App\Model\Association') {
                            $instance->NB_DONATEURS = $v;
                        } elseif($entity == 'App\Model\Entreprise') {
                            $instance->NB_ACTIONNAIRES = $v;
                        }
                    } else {
                        $instance->$k = $v;
                    }
                } 

                $manager->insert($instance);
                redirect();

            } else {
                echo "L'entité $entity n'existe pas dans le système";
            }
        } else {

            $data['meta_title']         = 'Ajouter ' . ucfirst($entity);
            $data['meta_description']   = 'Page pour la création de ' . ucfirst($entity); 

            $this->load_view('header', $data);
            $this->load_view('forms/' . ucfirst($entity));
            $this->load_view('footer');
        }
    }

    public function update(string $entity, int $id)
    {
        if(isset($_POST) && !empty($_POST)) {

            $class = 'App\Model\\' . ucfirst($entity) . 'Manager';

            if(class_exists($class)) {

                $manager = new $class();

                $instance = $manager->getOne($id);

                foreach($_POST as $k => $v) {
                    if(ucfirst($entity) == 'Structure' && $k == 'NB') {
                        if(isset($_POST['ESTASSO'])) {
                            $instance->NB_DONATEURS = $v;
                        } else {
                            $instance->NB_ACTIONNAIRES = $v;
                        }
                    } else {
                        $instance->$k = $v;
                    }
                } 

                if(ucfirst($entity) == 'Structure' && !isset($_POST['ESTASSO'])) {
                    $instance->ESTASSO = false;
                }

                $manager->update($instance);
                redirect();

            } else {
                echo "L'entité $entity n'existe pas dans le système";
            }
        } else {

            
            $class = 'App\Model\\' . ucfirst($entity) . 'Manager';

            if(class_exists($class)) {

                $manager = new $class();

                $instance = $manager->getOne($id);

                $data['meta_title']         = 'Modifier ' . ucfirst($entity);
                $data['meta_description']   = 'Page pour la modificatione de ' . ucfirst($entity);
                $data['form'] = $instance;

                $this->load_view('header', $data);
                $this->load_view('forms/' . ucfirst($entity), $data);
                $this->load_view('footer');

            } else {
                echo "L'entité $entity n'existe pas dans le système";
            }
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