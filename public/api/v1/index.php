<?php
include "../init.php";

$jsonObject = null;
$jsonObject->information = "This is the example index api endpoint";

dump(json_encode($jsonObject));