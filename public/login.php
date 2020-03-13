<?php

use Application\Security\Login;

if($_POST){
    if(Login::tryLogin($_POST["username"], $_POST["password"])){
        $_SESSION["logged"] = Login::tryLogin($_POST["username"], $_POST["password"]);
    }
}

if(!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    ?>
    <form action="" method="post">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
    <?php
}