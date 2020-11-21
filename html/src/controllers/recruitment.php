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

    // return records array associated by type
    // @param type: if "all", return all labels
    function getLabelByType($type = null) {
        // check param
        if (!$type) {
            return null;
        }

        // get all existed types
        $sql = "select type from recruitment_label group by type";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute();
        $types = $stmt->fetchAll();

        $sql = "select value,type from recruitment_label where type=:type";
        $stmt = $this->dbConn->prepare($sql);
        $result = [];
        // if type is not "all", take it as query param
        if ($type != "all") {
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

    // return recordes array associated by codename
    // @param labels: array that includes recruitment labels
    function getOperatorByLabel($labels = []) {
        // if labels is empty or not array, return null
        if (!is_array($labels) || count($labels) == 0) {
            return null;
        }

        // if more than 4 labelss, keep 1st-4th only
        if (count($labels) > 4) {
            $labels = array_slice($labels, 0, 4);
        }

        // query db to get the type of each label
        // xLabels: ["label_i" => label]
        $xLabels = [];
        // xStmt: ["type=:label_i"]
        $xStmt = [];
        // and this is i
        $index = 0;
        $sql = "select type from recruitment_label where value=:value";
        foreach ($labels as $label) {
            // skip if not string
            if (!is_string($label)) {
                continue;
            }
            $stmt = $this->dbConn->prepare($sql);
            $stmt->execute([':value' => $label]);
            $type = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // skip if type is empty
            if (empty($type)) {
                continue;
            }
            // if affix, use INSTR
            if ($type[0]['type'] == "affix") {
                $xLabels[':affix_' . $index] = $label;
                $xStmt[] = 'instr(affix,:affix_' . $index . ')';
            } else {
                $xLabels[':label_' . $index] = $label;
                $xStmt[] = $type[0]['type'] . '=:label_' . $index;
            }
                $index++;
        }

        // query operators
        // if "all" is included, query all operators
        if (in_array("all", $labels, true)) {
            $sql = "select * from recruitment_operator";
        } elseif (!empty($xStmt)) {
            $sql = "select * from recruitment_operator where " . implode(" or ", $xStmt);
        } else {
            return ["operators" => []];
        }
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute($xLabels);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->dbConn = null;
        return ["operators" => $result];
    }
}
