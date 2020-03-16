<?php

use Application\Models\ExampleModel;
use JAWA\JAWAElementBuilder;

echo JAWAElementBuilder::buildModelForm(new ExampleModel());