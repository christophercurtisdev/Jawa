<?php

use JAWA\JAWAElementBuilder;

include "../init.php";
die(\JAWA\JAWAConnection::getInstance()->dropAll());
$conn = \JAWA\JAWAConnection::getInstance();

$url = explode("/", $_SERVER['REQUEST_URI']);

if($url[1]) {
    $controller = 'Application\\Controllers\\' . ucfirst($url[1]) . "Controller";
}

if(count($url) >= 2) {
    $action = $url[1];
    $data = null;
    for ($i = 3; $i < count($url); $i ++) {
        $data[] = $url[$i];
    }
    $controller->action($action, $data);
}