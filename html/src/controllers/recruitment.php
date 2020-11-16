<?php

namespace Controllers;
use \PDO;

class recruitment {
    private $dbConn;
    private $host;
    private $dbName;
    private $userName;
    private $pwd;

    function __construct($dbSetting) {
        $host = $dbSetting(host);
        $dbName = $dbSetting(dbname);
        $userName = $dbSetting(user);
        $pwd = $dbSetting(pwd);
    }

    function init() {
        $dsn = "mysql:dbname=$this->dbName;host=$this->host";
        try{
            $this->dbConn = new PDO($dsn, $this->userName, $this->pw);
            return 1;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    function getLabels() {
        $sql = "select * from recruitment_label";
        $stmt = $this->dbConn->query($sql);
        $result =  $stmt->fetchAll();
        $this->dbConn = null;

        return $result;
    }
}
