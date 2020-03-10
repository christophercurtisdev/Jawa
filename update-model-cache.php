<?php
include("autoloader.php");

Autoloader::register();

use JAWA\JAWAConnection;

$model = readline("Which model needs updating: (leave blank to update all) \n ");

if(!$model) {
    foreach (get_declared_classes() as $class) {
        if (strpos($class, DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR)) {
            $object = new $class([]);
            JAWAConnection::getInstance()->updateTableCache($object::columns(), $object::tableName());
        }
    }
} else if(class_exists("Application\\Models\\".ucfirst($model))) {
    $model = "Application\\Models\\".ucfirst($model);
    $object = new $model([]);
    JAWAConnection::getInstance()->updateTableCache($object::columns(), $object::tableName());
} else {
    print "Couldn't find that model";
}