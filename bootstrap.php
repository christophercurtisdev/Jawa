<?php
include "autoloader.php";

Autoloader::register();

use JAWA\JAWAConnection;

$conn = JAWAConnection::getInstance();

foreach (get_declared_classes() as $class)
{
    if(strpos($class,DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR)){
        $object = new $class([]);
        JAWAConnection::makeTable($object::tableName(), $object::columns(), $object::tablePrefix());
    }
}