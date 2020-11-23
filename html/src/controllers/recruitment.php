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
        // xParams: ["label_i" => param]
        // used in bind-param
        $xParams = [];

        // xAffices: [:label_i]
        // used in query statement
        $xAffices = [];

        // xLabels: ["o.type=:label_i"]
        // used in query statement
        $xLabels = [];

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

            // if affix, append to xAffices
            if ($type[0]['type'] == "affix") {
                $xAffices[] = ":label_" . $index;
            } else { // otherwise append to xLabels
                $xLabels[] = "o." . $type[0]['type'] . "=:label_" . $index;
            }
            $xParams[':label_' . $index] = $label;
            $index++;
        }

        // return empty array if no effective label
        if (empty($xAffices) && empty($xLabels)) {
            return ["operators" => []];
        }

        // return all operators if "all" is in labels
        if (in_array("all", $labels, true)) {
            $sql = 'select o.*,group_concat(a.affix separator ",") as affix from recruitment_operator as o join operator_affix as a where a.codename=o.codename group by o.codename';
            $stmt = $this->dbConn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->dbConn = null;
            return ["operators" => $result];
        }

        // query codenames from xAffices and xLabels
        // statement eg:
        // ------------------- //
        // SELECT o.codename
        // FROM
        //   recruitment_operator AS o JOIN operator_affix AS a
        // WHERE
        //   (o.codename=a.codename AND a.affix IN (affix...))
        // OR
        //   (o.codename=a.codename AND (o.class=... OR o.position=...))
        // GROUP BY o.codename
        // ------------------- //
        $sql = "select o.codename from recruitment_operator as o join operator_affix as a where ";
        if (!empty($xAffices)) {
            $subSql1 = "(o.codename=a.codename and a.affix in (" . implode(",", $xAffices) . "))";
        } else {
            $subSql1 = "false";
        }
        if (!empty($xLabels)) {
            $subSql2 = "(o.codename=a.codename AND (" . implode(" or ", $xLabels) . "))";
        } else {
            $subSql2 = "false";
        }
        $sql .= $subSql1 . " or " . $subSql2 . " group by o.codename";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute($xParams);
        $codenames = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        // generate statement and params of codenames
        $index = 0;
        $xCodes = [];
        $xParams = [];
        foreach ($codenames as $codename) {
            $xCodes[] = ":code_" . $index;
            $xParams[":code_" . $index] = $codename;
            $index++;
        }

        // query operators
        // if "all" is included, query all operators
        $sql = 'select o.*,group_concat(a.affix separator ",") as affix from recruitment_operator as o join operator_affix as a where a.codename=o.codename and o.codename in (' . implode(",", $xCodes) . ") group by o.codename";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->execute($xParams);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->dbConn = null;
        return ["operators" => $result];
    }
}
