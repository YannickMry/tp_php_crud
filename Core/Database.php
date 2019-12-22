<?php

namespace App\Core;

use Exception;
use \PDO;

class Database {

    private $PDO;

    public function __construct($host, $dbname, $charset, $user, $pass)
    {
        try{
            $this->PDO = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            echo "Error db: ".$e;
        }
    }

    public function columns($table)
    {
        $sql = "SHOW COLUMNS FROM $table";
        
        foreach($this->PDO->query($sql, PDO::FETCH_OBJ) as $column){
            $columns[] = $column->Field;
        }

        return $columns;
    }

    public function select($table, $where = [], $limit = 1000)
    {
        $sql = "SELECT * FROM $table";

        if(!empty($where)) {
            $sql .= ' WHERE 1=1';
            $i = 1;
            $len = count($where);
            foreach($where as $k => $v) {
                $sql .= " AND $k = :$k";
                $i++;
            }
        }

        $sql .= " LIMIT $limit";

        if(!empty($where)) {

            $query = $this->PDO->prepare($sql);
            $query->setFetchMode(PDO::FETCH_OBJ);            
            $query = $query->execute($where);

        } else {
            $query = $this->PDO->query($sql, PDO::FETCH_OBJ);
        }

        if($limit == 1) {
            return $query->fetch();
        } else {
            return $query->fetchAll();
        }
    }

    public function insert($table, $params)
    {
        $sql = "INSERT INTO $table (";
        $i = 1;
        $len = count($params);
        foreach($params as $k => $v) {
            $sql .= "$k";
            if ($i <= $len) {
                $sql .= ',';
            }
            $i++;
        }

        $sql .= ') VALUES (';
        $i = 1;
        $len = count($params);
        foreach($params as $k => $v) {
            $sql .= "$v";
            if ($i <= $len) {
                $sql .= ',';
            }
            $i++;
        }

        $query = $this->PDO->prepare($sql);

        if($query->execute($params)) {
            return $this->PDO->lastInsertId();
        } else {
            return false;
        }

    }

    public function update($table, $params)
    {
        if(!empty($params)) {
            
            $sql = "UPDATE $table SET";
            $i = 1;
            $len = count($params);
            foreach($params as $k => $v) {
                $sql .= " $k = :$k";
                if ($i <= $len) {
                    $sql .= ',';
                }
                $i++;
            }

            $query = $this->PDO->prepare($sql);

            return $query->execute($params);

        } else { return false; }
    }

    public function delete($table, $params = [])
    {
        $sql = "DELETE FROM $table";

        if(!empty($params)) {
            $sql .= ' WHERE 1=1 ';
            foreach($params as $k => $v) {
                $sql .= "AND $k = :$k";
            }
        }

        $query = $this->PDO->prepare($sql);

        return $query->execute($params);        
    }

    public function __destruct()
    {
        $this->PDO = null;
    }

    public function __get($attribute)
    {
        return $this->$attribute;
    }
}