<?php namespace SGCrawler;

use mysqli;

class MySQLController
{
    private $mysqli = null;
    public function __construct($server, $username, $password, $db){
        $this->mysqli = new mysqli($server, $username, $password, $db);
    }

    public function GetSchema($table){
        $sql = "DESCRIBE ".$table;
        return ReturnQueryResults($sql);
    }

    public function GetTables(){
        $sql = "SHOW TABLES";
        return ReturnQueryResults($sql);
    }

    public function ReturnQueryResults($sql){

        echo "SQL: ".$sql;
        if ($result = $this->mysqli->query($sql)) {
            
        }
        $this->mysqli->close();
    }

    public function SaveToMySQL(array $dataMap, $tablename, $category=""){
        $sql = "INSERT INTO ".$tablename." (";
        if(strlen($category)>0){
            $sql=$sql."category, ";
        }
        foreach($dataMap as $row){
            $sql = $sql.$this->mysqli->real_escape_string($row->name).",";
        }
        $sql = substr($sql,0,-1).") VALUES (";
        if(strlen($category)>0){
            $sql=$sql."'".$category."', ";
        }
        foreach($dataMap as $row){
            $sql = $sql."'".$this->mysqli->real_escape_string($row->match)."',";
            $sql = substr($sql,0,-1);
            $sql = $sql.",";
        }
        $sql = substr($sql,0,-1);
        $sql = $sql.")";
        $this->ReturnQueryResults($sql);
    }
}
