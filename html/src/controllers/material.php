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

    // 


}
