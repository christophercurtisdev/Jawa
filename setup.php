<?php
include "autoloader.php";

Autoloader::register();

use JAWA\JAWAConnection;

$conn = JAWAConnection::getInstance();
$conn->setup();

$fresh = $conn->allWhere("information_schema.TABLES", "TABLE_NAME = 'table_cache'");

if(empty($fresh)) {

    foreach (get_declared_classes() as $class) {
        if (strpos($class, '\\Models\\')) {
            $object = new $class([]);
            print("Making table ".$object::tableName()." from model.\n");
            $conn->makeTable($object::tableName(), $object::columns(), $object::tablePrefix());
        }
    }
} else {
    $tables = $conn->all("table_cache");
    foreach ($tables as $table){
        $columnArray = [];
        $tableName = $table["tc_table_name"];
        $columnPrefix = $table["tc_column_prefix"];
        $columns = explode("|", urldecode($table["tc_table_columns"]));
        foreach ($columns as $column){
            $keyValue = explode(':', $column);
            $columnArray[$keyValue[0]] = $keyValue[1];
        }
        print("Making table ".$tableName." from cache.\n");
        $conn->makeTable($tableName, $columnArray, $columnPrefix, false);
    }
}