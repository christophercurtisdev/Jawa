<?php

use Application\Models\ExampleModel;

$conn = \JAWA\JAWAConnection::getInstance();
echo '<pre>';
var_dump(\JAWA\JAWAConnection::getPrefixes());
echo '</pre>';