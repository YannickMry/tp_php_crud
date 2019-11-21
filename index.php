<?php

require('config.php');
require('routes.php');
require('helpers.php');

$uri = substr($_SERVER['REQUEST_URI'], 1); // Enlève le premier "/"

// 3 cas :
// L'url est renseigné dans routes.php -> on utilise routes.php
// L'url n'est pas renseigné -> on essaye de trouver directement "controller/method" avec l'url
// L'url n'est pas renseigné et aucun "controller/method" n'existe -> on redirige vers le controleur par défaut

if(!isset($routes[$uri])) {

    $uri_segments = explode('/', $uri);

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

} else {
    $uri_segments = explode('/', $routes[$uri]);
    $instance = ucfirst($uri_segments[0]);
    $method = $uri_segments[1];
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

$controller->$method();