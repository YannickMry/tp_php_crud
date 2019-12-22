<?php

// 3 cas :
// L'url est renseigné dans routes.php -> on utilise routes.php tout en vérifiant les paramètres s'il y en a
// L'url n'est pas renseigné -> on essaye de trouver directement "controller/method" avec l'url
// L'url n'est pas renseigné et aucun "controller/method" n'existe -> on redirige vers le controleur par défaut

// Pour une méthode avec des paramètres, il faut obligatoirement qu'une route soit configurée.


require('config/config.php');
require('config/database.php');
require('config/routes.php');
require('helpers.php');
require('config/strings.php');

$uri = substr($_SERVER['REQUEST_URI'], 1); // Enlève le premier "/"
$uri_segments = explode('/', $uri);

$params = [];
$route_segments = [];

// Vérification route
foreach($routes as $k => $v) {

    $route_segments = explode('/', $k);

    if(count($route_segments) == count($uri_segments)) {

        $is_route_ok = true;
        $route_has_params = false;

        for($i = 0; $i < count($route_segments); $i++) {

            if(!strstr($route_segments[$i], '{')) {
                if($route_segments[$i] != $uri_segments[$i]) {
                    $is_route_ok = false;
                }
            } else {
                $route_has_params = true;
            }
        }

        if($is_route_ok) {
            $route_controller = explode('/', $v);
            break;
        }

    } else {
        $is_route_ok = false;
    }
}

if(!isset($routes[$uri]) && !$is_route_ok && (!isset($route_has_params) || !$route_has_params)) { // Si la route n'est pas configurée on essaye le format "controller/method" directement

    if(!isset($uri_segments[0]) || $uri_segments[0] == '') {

        $instance = ucfirst($config['default_controller']);
    
    } elseif(isset($uri_segments[0])) {
    
        $instance = ucfirst($uri_segments[0]);
    
    }
    
    if(!isset($uri_segments[1]) || $uri_segments[1] == '') {

        $method = 'index';
    
    } elseif(isset($uri_segments[1])) {

        $method = $uri_segments[1];
    }
    
} else { // Si la route est configurée on utilise route.php

    $instance = ucfirst($route_controller[0]);
    $method = $route_controller[1];

    // Construction du tableau de paramètres
    $params = [];
    for($i = 0; $i < count($route_segments); $i++) {
        if(strstr($route_segments[$i], '{') != false) {
            $name = str_replace('{', '', $route_segments[$i]);
            $name = str_replace('}', '', $name);;
            $params[$name] = $uri_segments[$i];
        }
    }
   
}

$path = './Controller/'.$instance.'.php';

if (!file_exists($path)) {
    redirect();
}

require($path);
$instance = '\App\Controller\\' . $instance;

$controller = new $instance();

if(!method_exists($instance, $method)) {
    redirect();
}

// Vérification de la correspondance des noms de paramètres dans la route et dans la méthode du contrôleur
foreach(method_get_arg_names($controller, $method) as $arg) {
    if(!isset($params[$arg])) {
        echo "Paramètre avec le nom '$arg' inexistant dans la méthode $method. Vérifiez votre route !";die();
    }
}

call_user_func_array(array($controller, $method), $params);