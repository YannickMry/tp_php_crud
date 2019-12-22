<?php

namespace App\Core;

require_once(app_path('Core/Database.php'));

use App\Core\Database;

abstract class Manager {

    protected $db; // Chaque manager hérite de Manager et a un object Database directement à disposition
    private $table;

    public function __construct($table)
    {
        $this->table = $table;

        $db = config('database');

        $this->db = new Database($db['host'], $db['dbname'], $db['charset'], $db['user'], $db['pass']);
    }

    public function getHeaders()
    {
        return $this->db->columns($this->table);
    }
}