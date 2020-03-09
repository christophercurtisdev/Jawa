<?php

use JAWA\JAWAElementBuilder;

include "../init.php";

$url = explode("/", $_SERVER['REQUEST_URI']);

$controller = 'Application\\Controllers\\'.ucfirst($url[1])."Controller";
$action = $url[2];
$id = count($url) > 3 ? $url['3'] : null;
$test = new $controller();
$test->action($action, $id);