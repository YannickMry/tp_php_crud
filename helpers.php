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

function load_view($name, $data = []) {

    foreach($data as $k => $v) {
        ${$k} = $v;
    }

    ob_start();
    require_once(app_path('View/'.$name.'.php'));
    $view = ob_get_contents();
    ob_end_clean();
    echo $view;
}