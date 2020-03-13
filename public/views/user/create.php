<?php

use Application\Models\UserModel;
use JAWA\JAWAElementBuilder;

echo JAWAElementBuilder::buildModelForm(new UserModel([]));