<?php
include "autoloader.php";

Autoloader::register();

use JAWA\JAWAConnection;

$conn = JAWAConnection::getInstance();
$conn->setup();

$fresh = $conn->allWhere("information_schema.TABLES", "TABLE_NAME = 'table_cache'");

if(empty($fresh)) {
    foreach (get_declared_classes() as $class) {
        if (strpos($class, DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR)) {
            $object = new $class([]);
            $conn->makeTable($object::tableName(), $object::columns(), $object::tablePrefix());
        }
    }
} else {
    $tables = $conn->all("table_cache");
    foreach ($tables as $table){
        $columnArray = [];
        $tableName = $table["tc_table_name"];
        $columnPrefix = $table["tc_column_prefix"];
        $columns = explode(",", $table["tc_table_columns"]);
        foreach ($columns as $column){
            $keyValue = explode(':', $column);
            $columnArray[$keyValue[0]] = $keyValue[1];
        }
        $conn->makeTable($tableName, $columnArray, $columnPrefix, false);
    }
}