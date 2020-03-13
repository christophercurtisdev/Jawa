<?php

use Application\Models\UserModel;
use JAWA\JAWAConnection;
use JAWA\JAWACrypt;

$timestamp = date("Y-m-d H:i:s");
$pw = \JAWA\JAWACrypt::strongCrypt($_POST["password"], strtotime($timestamp));
JAWAConnection::getInstance()->insertRow("users", ['u_username' => $_POST["username"], 'u_password' => $pw, 'u_auth_level' => 'root', 'u_created_at' => $timestamp]);
header("Location: /user/index");