<?php
include "autoloader.php";

$_JAWA = new Autoloader();
$_JAWA::register();

if(getenv('DEBUG')){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

//DEBUGGING
function dump($data){
    highlight_string(var_export($data, true));
}