<?php
require('../init.php');

use JAWA\JAWAElementBuilder;

$url = explode("/", $_SERVER['REQUEST_URI']);
if($url[1]) {
    $controller = 'Application\\Controllers\\' . ucfirst($url[1]) . "Controller";
    if(class_exists($controller)) {
        $controller = new $controller;
    } else {
        echo "404";
    }
}
$model = new \Application\Models\ExampleModel([]);

