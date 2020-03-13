<?php

if(isset($_POST["logout"])){
    $_SESSION["logged"] = false;

    session_destroy();
} else if($_SESSION["logged"]) {
    ?>
    <form action="" method="post">
        <input type="submit" id="logout" name="logout" value="Logout">
    </form>
    <?php
}