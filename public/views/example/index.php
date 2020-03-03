<?php

use Application\Models\ExampleModel;
use Application\Models\ExampleModelTwo;
$model = new ExampleModel([
    'title' => 'my title',
    'author' => 'Me',
    'type' => 'fiction',
    'publisher' => 'Penguin',
    'publishDate' => '2020-01-15'
]);
echo '<pre>';
var_dump($model);
echo '</pre>';