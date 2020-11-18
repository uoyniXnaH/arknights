<?php

namespace Controllers;
use \PDO;
use \Settings;

class recruitment {
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
        try{
            $this->dbConn = new PDO($dsn, $this->userName, $this->pwd);
            return 1;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    // return records array assiociated by type
    // @param type: if type is null, query all records
    function getLabelByType($type = null) {
        // get all existed types
        $sql = "select type from recruitment_label group by type";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute();
        $types = $stmt->fetchAll();

        $sql = "select value,type from recruitment_label where type = :type";
        $stmt = $this->dbConn->prepare($sql);
        $result = [];
        // if type is not null, take it as query param
        if ($type) {
            $stmt->execute([':type' => $type]);
            $result = [$type => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } else {
        // otherwise, query all records, and arrange them by types
            foreach ($types as $i) {
                $stmt->execute([':type' => $i['type']]);
                $result[$i['type']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        $this->dbConn = null;
        return $result;
    }
}
