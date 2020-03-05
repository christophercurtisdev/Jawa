<?php
include "../init.php";

use Application\Views\ExampleView;
use JAWA\JAWAConnection;

$conn = JAWAConnection::getInstance();
//$conn->insertRow("MyTable", ["col1", "col2", "col3"]);
$v = new ExampleView();
$v->getView('index');
//require 'views/example/index.php';