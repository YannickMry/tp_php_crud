<?php

require_once('config.php');

function redirect($url = '') {
    header('Location: '.$config['base_url'].'/'.$url);
}