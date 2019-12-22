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
            $sql .= ' WHERE 1 = 1';
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
            $query->execute($where);

        } else {
            $query = $this->PDO->query($sql, PDO::FETCH_OBJ);
        }

        if($limit == 1) {
            return $query->fetch();
        } else {
            return $query->fetchAll();
        }
    }

    public function insert($table, $values)
    {
        $sql = "INSERT INTO $table (";

        foreach($values as $k => $v) {
            if(!isset($v)) {
                unset($values[$k]);
            }
        }

        $i = 0;
        $prev = null;
        foreach($values as $k => $v) {
            if(isset($v)) {
                if ($i > 0 && isset($prev)) {
                    $sql .= ', ';
                }
                $sql .= "$k";
            }
            $prev = $v;
            $i++;
        }

        $sql .= ') VALUES (';
        $i = 0;
        $prev = null;
        foreach($values as $k => $v) {
            if(isset($v)) {
                if ($i > 0 && isset($prev)) {
                    $sql .= ', ';
                }
                $sql .= ":$k";
            }
            $prev = $v;
            $i++;
        }

        $sql .= ')';

        $query = $this->PDO->prepare($sql);

        if($query->execute($values)) {
            return $this->PDO->lastInsertId();
        } else {
            return false;
        }

    }

    public function update($table, $values, $where)
    {
        if(!empty($values)) {
            
            $sql = "UPDATE $table SET";
            
            foreach($where as $k => $v) {
                if(!isset($v)) {
                    unset($where[$k]);
                }
            }
            foreach($values as $k => $v) {
                if(!isset($v)) {
                    unset($values[$k]);
                }
            }

            $i = 0;
            $prev = null;
            foreach($values as $k => $v) {
                if(isset($v)) {
                    if ($i > 0 && isset($prev)) {
                        $sql .= ',';
                    }
                    $sql .= " $k = :$k";
                }
                $prev = $v;
                $i++;
            }

            if(!empty($where)) {
                $sql .= ' WHERE 1 = 1';
                foreach($where as $k => $v) {
                    if(isset($v)) {
                        $sql .= " AND $k = :$k";
                    }
                }
            }

            $query = $this->PDO->prepare($sql);
            $query->execute($values);

        } else { return false; }
    }

    public function delete($table, $where = [])
    {
        $sql = "DELETE FROM $table";

        if(!empty($where)) {
            $sql .= ' WHERE 1=1 ';
            foreach($where as $k => $v) {
                $sql .= "AND $k = :$k";
            }
        }

        $query = $this->PDO->prepare($sql);

        return $query->execute($where);        
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