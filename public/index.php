<?php
// .htaccess redirects to here on every url.
// either use .htaccess in the live environment or change server rules (must change server block on nginx).
session_start();
require ('../init.php');
require ('login.php');
require ('logout.php');

$uri = explode("/", $_SERVER['REQUEST_URI']);
dump($uri);
\JAWA\JAWARouter::processURI($uri);