<?php
include "../init.php";

$url = explode("/", $_SERVER['REQUEST_URI']);

$controller = 'Application\\Controllers\\'.ucfirst($url[1])."Controller";
$action = $url[2];

$test = new $controller();

$test->action($action);