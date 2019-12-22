<?php

function redirect($url = '') {
    header('Location: '.config('config')['base_url'] . $url);
}

function app_path($path = '') {
    return str_replace('\\', '/', __DIR__ . '/' . $path);
}

function path($path, $params = []) {
    $key = array_search($path, config('routes'));
    if($key != false) {
        if($params != []) {
            $params_segments = '';
            $key_segments = explode('/', $key);
            for($i = 0; $i < count($key_segments); $i++) {
                if(strstr($key_segments[$i], '{') != false) {
                    $key_segments[$i] = str_replace('{', '', $key_segments[$i]);
                    $key_segments[$i] = str_replace('}', '', $key_segments[$i]);
                    $key_segments[$i] = $params[$key_segments[$i]];
                }
            }
            $key = implode('/', $key_segments);
        }
        return base_url($key);
    } else {
        return '';
    }
}

function base_url($path = '') {
    return config('config')['base_url'] . $path;
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
 * @param object $source_object
 * @return object
 */
 function cast($destination, $source_object)
 {
     if (is_string($destination)) {
         $destination = new $destination();
     }

     $source_reflection = new ReflectionObject($source_object);
     $destination_reflection = new ReflectionObject($destination);
     $source_properties = $source_reflection->getProperties();

     foreach ($source_properties as $source_property) {

         $source_property->setAccessible(true);
         $name = $source_property->getName();
         $value = $source_property->getValue($source_object);

         if ($destination_reflection->hasProperty($name)) {

             $prop_dest = $destination_reflection->getProperty($name);
             $prop_dest->setAccessible(true);
             $prop_dest->setValue($destination,$value);

         } else {
             $destination->$name = $value;
         }
     }
     return $destination;
 }