<?php

use Application\Models\ExampleModel;
use JAWA\JAWAConnection;

$book = new ExampleModel($_POST);
JAWAConnection::getInstance()->insertModel($book);
header("Location: /example/index");