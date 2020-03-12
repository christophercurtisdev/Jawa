<?php
// .htaccess redirects to here on every url.
// either use .htaccess in the live environment or change server rules (must change server block on nginx).

require('../init.php');

if(!$_SESSION['logged']){
    header("Location: login.php");
}

$url = explode("/", $_SERVER['REQUEST_URI']);


