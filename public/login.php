<?php
session_start();
require ("../init.php");

use Application\Security\Login;

if($_POST){
    echo Login::tryLogin($_POST["username"], $_POST["password"]);
}

?>

<form action="" method="post">
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="password" name="password" id="password" placeholder="Password">
    <input type="submit" value="Login">
</form>
