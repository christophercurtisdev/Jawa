<?php

use Application\Models\UserModel;
use JAWA\JAWAConnection;
use JAWA\JAWACrypt;

$row = JAWACrypt::userCrypt($_POST["password"]);
$row["u_username"] = $_POST["username"];
$row["u_auth_level"] = $_POST["auth_level"];
$user = new UserModel($row);
JAWAConnection::getInstance()->insertRow("users", $row);
header("Location: /user/index");