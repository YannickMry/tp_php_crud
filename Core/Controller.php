<?php

namespace App\Core;

class Controller {

    public function string($k) {
        if(isset($GLOBALS['strings'][$k])) {
            return $GLOBALS['strings'][$k];
        } else {
            return "";
        }
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
}