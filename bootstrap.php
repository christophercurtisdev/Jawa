<?php
include "autoloader.php";

Autoloader::register();

use JAWA\JAWAConnection;

$conn = JAWAConnection::getInstance();

foreach (glob('Application'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'*.php') as $class)
{
    echo $file;
}