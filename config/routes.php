<?php

// 'url' => 'controller/method'
// Les paramètres sont à renseigner entre {} avec le même nom que le paramètre de la méthode du contrôleur

$routes = [
    'modifier/{entity}/{id}' => 'main/update',
    'supprimer/{entity}/{id}' => 'main/delete'
];