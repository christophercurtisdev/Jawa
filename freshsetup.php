<?php
include "autoloader.php";

Autoloader::register();

use JAWA\JAWAConnection;

$conn = JAWAConnection::getInstance();
$conn->dropAll();
$conn->setup();

foreach (get_declared_classes() as $class)
{
    if(strpos($class,'\\Models\\')){
        $object = new $class([]);
        print("Making table ".$object::tableName()." from model.\n");
        $conn->makeTable($object::tableName(), $object::columns(), $object::tablePrefix());
    }
}

$timestamp = date("Y-m-d H:i:s");

// CHANGE PASSWORD FROM 'root' WHEN CREATING A NEW PROJECT //
$pw = \JAWA\JAWACrypt::strongCrypt("root", strtotime($timestamp));

$un = "root";
JAWAConnection::getInstance()->insertRow("users", ['u_username' => $un, 'u_password' => $pw, 'u_auth_level' => 'root', 'u_created_at' => $timestamp]);