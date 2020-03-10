<?php
include "autoloader.php";

Autoloader::register();

use JAWA\JAWAConnection;

$conn = JAWAConnection::getInstance();
$conn->dropAll();
$conn->setup();

foreach (get_declared_classes() as $class)
{
    if(strpos($class,DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR)){
        $object = new $class([]);
        JAWAConnection::makeTable($object::tableName(), $object::columns(), $object::tablePrefix());
    }
}

$pw = \JAWA\JAWACrypt::strongCrypt("root");
$un = "root";
$rootUser = new \Application\Models\UserModel([
    'username' => $un,
    'password' => $pw,
    'auth_level' => 'root'
]);

JAWAConnection::getInstance()->insertModel($rootUser);