<?php

use Application\Factory\ExampleFactory;
use Application\Models\ExampleModel;
use JAWA\JAWAConnection;
use JAWA\JAWATableManager;

echo '<pre>';
var_dump(JAWAConnection::getInstance()->dropTable("test"));
echo '</pre>';