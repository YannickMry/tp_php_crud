<?php

function redirect($url = '') {
    header('Location: '.config('config')['base_url'] . $url);
}

function app_path($path = '') {
    return str_replace('\\', '/', __DIR__ . '/' . $path);
}

function base_url($path = '') {
    return config('config')['base_url'] . $path;
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

function config($param = '') {
    require(app_path("config/$param.php"));
    if($param == '') {
        return $config;
    } elseif(isset(${$param})) {
        return ${$param};
    } else {
        return null;
    }
}

/**
 * Class casting
 *
 * @param string|object $destination
 * @param object $sourceObject
 * @return object
 */
 function cast($destination, $sourceObject)
 {
     if (is_string($destination)) {
         $destination = new $destination();
     }
     $sourceReflection = new ReflectionObject($sourceObject);
     $destinationReflection = new ReflectionObject($destination);
     $sourceProperties = $sourceReflection->getProperties();
     foreach ($sourceProperties as $sourceProperty) {
         $sourceProperty->setAccessible(true);
         $name = $sourceProperty->getName();
         $value = $sourceProperty->getValue($sourceObject);
         if ($destinationReflection->hasProperty($name)) {
             $propDest = $destinationReflection->getProperty($name);
             $propDest->setAccessible(true);
             $propDest->setValue($destination,$value);
         } else {
             $destination->$name = $value;
         }
     }
     return $destination;
 }