<?php namespace SGCrawler;

use mysqli;

class MySQLController
{
    private $link;
    public function __construct($server, $username, $password, $db){
        $this->link = mysqli_connect($server, $username, $password, $db);
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
        if ($result = mysqli_query($this->link, $sql)) {
            
        }
    }

    public function SaveToMySQL(array $dataMap, $tablename, $category=""){
        $sql = "INSERT INTO ".$tablename." (";
        if(strlen($category)>0){
            $sql=$sql."category, ";
        }
        foreach($dataMap as $row){
            $sql = $sql.mysqli_real_escape_string($this->link, $row->name).",";
        }
        $sql = substr($sql,0,-1).") VALUES (";
        if(strlen($category)>0){
            $sql=$sql."'".$category."', ";
        }
        foreach($dataMap as $row){
            $sql = $sql."'".mysqli_real_escape_string($this->link, $row->match)."',";
            $sql = substr($sql,0,-1);
            $sql = $sql.",";
        }
        $sql = substr($sql,0,-1);
        $sql = $sql.")";
        $this->ReturnQueryResults($sql);
    }
}
