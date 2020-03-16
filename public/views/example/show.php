<?php

use Application\Factory\ExampleFactory;
use Application\Models\ExampleModel;
use Application\Models\UserModel;
use Application\Security\Login;
use JAWA\JAWAConnection;
use JAWA\JAWACrypt;

echo "This is the example show";
dump($uriData); //This is the data in the uri after '/example/show/';