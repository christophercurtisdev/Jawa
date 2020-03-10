<?php

use Application\Factory\ExampleFactory;
use Application\Models\ExampleModel;
use Application\Models\UserModel;
use Application\Security\Login;
use JAWA\JAWAConnection;
use JAWA\JAWACrypt;
use JAWA\JAWAElementBuilder;

//echo getenv('DEFAULT_SCHEMA');

//$mod = new UserModel(["username" => "Me", "password" => "Some Password"]);
//$date = new DateTime();
//dump(Login::tryLogin("root", "root"));
echo JAWAElementBuilder::buildModelForm(new \Application\Models\ExampleModel([]));