<?php

require('config.php');
require('routes.php');

$uri_segments = explode('/', $_SERVER['REQUEST_URI']);
$uri_segments = array_slice($uri_segments, 1);

if(!isset($uri_segments[0]) || $uri_segments[0] == '') {

    $instance = $config['default_controller'];

} elseif(isset($routes[$uri_segments[0]])) {

    $instance = $routes[$uri_segments[0]];

} else {
    header('Location: '.$config['base_url']);
}

if(!isset($uri_segments[1]) || $uri_segments[1] == '') {

    $method = 'index';

} elseif(isset($routes[$uri_segments[1]])) {

    $method = $routes[$uri_segments[1]];

} else {
    header('Location: '.$config['base_url']);
}

require('./Controller/'.$instance.'.php');
$instance = '\App\Controller\\' . $instance;

$controller = new $instance();
$controller->$method();