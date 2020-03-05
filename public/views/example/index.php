<?php

use Application\Factory\ExampleFactory;
use Application\Models\ExampleModel;
use Application\Models\User;
use Application\Security\Login;
use JAWA\JAWAConnection;
use JAWA\JAWACrypt;

$mod = new User(["username" => "Me", "password" => "Some Password"]);
$date = new DateTime();
//dump($date->format("Y-m-d H:i:s"));
dump(strtotime('2020-03-05 16:08:38'));
dump(JAWACrypt::strongCrypt("root", '1583420918'));
dump(Login::tryLogin("root", "root"));
dump(str_pad(123, 5, '0', STR_PAD_LEFT));