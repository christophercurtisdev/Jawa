<?php

use Application\Factory\ExampleFactory;
use Application\Models\ExampleModel;
use Application\Models\ExampleModelTwo;
use JAWA\JAWATableManager;

$model = new ExampleModel([
    'title' => 'my title',
    'author' => 'Me',
    'type' => 'fiction',
    'publisher' => 'Penguin',
    'publishDate' => '2020-01-15'
]);
$fact = new JAWATableManager();
echo '<pre>';
var_dump();
echo '</pre>';