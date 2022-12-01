
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');

session_destroy();
foreach($_SESSION as $tem){
    unset($tem);
}

header("Location: /home/home.html.php");

?>