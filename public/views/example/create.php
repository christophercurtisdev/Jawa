<?php

use Application\Models\ExampleModel;
use JAWA\JAWAElementBuilder;

echo "I'm here";
echo JAWAElementBuilder::buildModelForm(new ExampleModel([]));