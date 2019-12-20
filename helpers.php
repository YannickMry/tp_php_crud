<?php

require_once('config.php');

function redirect($url = '') {
    header('Location: '.$config['base_url'].'/'.$url);
}

function app_path($path = '') {
    return str_replace('\\', '/', __DIR__.'/'.$path);
}

function base_url($path = '') {
    return $config['base_url'] . '/' . $path;
}

function value_input_type($name) {
    if (isset($_POST["$name"])) echo htmlspecialchars($_POST["$name"]);
    elseif (isset($_SESSION["$name"])) echo htmlspecialchars($_SESSION["$name"]);
}

function str_between($str,$from,$to) {
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    return substr($sub,0,strpos($sub,$to));
}

function method_get_arg_names($class_name, $method_name) {
    $f = new ReflectionMethod($class_name, $method_name);
    $result = array();
    foreach ($f->getParameters() as $param) {
        $result[] = $param->name;   
    }
    return $result;
}