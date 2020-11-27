<?php

namespace Controllers;
use \PDO;
use \Settings;

class material {
    private $dbConn;
    private $host;
    private $dbName;
    private $userName;
    private $pwd;

    function __construct() {
        $dbSetting = Settings\settings::getDbSetting();
        $this->host = $dbSetting['host'];
        $this->dbName = $dbSetting['dbname'];
        $this->userName = $dbSetting['user'];
        $this->pwd = $dbSetting['pwd'];
    }

    function init() {
        $dsn = "mysql:dbname=$this->dbName;host=$this->host";
        $this->dbConn = new PDO($dsn, $this->userName, $this->pwd);
        return 1;
    }

    // get material ingredient
    function getIngredient($material = null) {
        // check param
        if (!$material) {
            return null;
        }

        // return all records if param equals "all"
        // todo
        
        // return single ingredient
        $sql = "select name,type,cost from material_list where name=:name";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute([':name' => $material]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        if (count($result) == 0) {
            return ["material" => []];
        }
        $sql = "select ingredient,number from material_ingredient where target=:name";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute([':name' => $material]);
        $temp = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ingredient = [];
        // if result includes NULL, then it is a basic material
        if ($temp[0]['ingredient'] != NULL) {
            foreach ($temp as $i) {
                $ingredient[$i['ingredient']] = $i['number'];
            }
        }

        $result['ingredient'] = $ingredient;
        return ["material" => $result];
    }

}
