<?php

namespace App\Model;

use Exception;
use \PDO;

class Database {

    const HOST = "localhost";
    const DBNAME = "tp_php_crud";
    const CHARSET = "UTF-8";
    const USER = "root";
    const PASS = "";

    private $client;

    public function __construct()
    {
        try{
            $this->client = new PDO("mysql:host=".self::HOST.";dbname=".self::DBNAME, self::USER, self::PASS);
            $this->client->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            echo "Error db: ".$e;
        }
    }

    public function __destruct()
    {
        $this->client = null;
    }

    public function __get($attribute)
    {
        return $this->$attribute;
    }
}