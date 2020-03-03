<?php
include "../init.php";

use Application\Views\ExampleView;
use JAWA\JAWAConnection;

$conn = JAWAConnection::getInstance();
$v = new ExampleView();
$v->getView('index');
//require 'views/example/index.php';