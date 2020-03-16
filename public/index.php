<?php
// .htaccess redirects to here on every url.
// either use .htaccess in the live environment or change server rules (must change server block on nginx).

session_start();
require ('../init.php');
require ('login.php');
require ('logout.php');

use JAWA\JAWARouter;

$uri = explode("/", $_SERVER['REQUEST_URI']);
if(isset($uri[1])) {
    JAWARouter::processURI($uri);//add $_SESSION['logged'] to method
}