
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');

$_SESSION = array();
unset($_SESSION);
session_unset();
session_destroy();

header("Location: /home/home.php.php");

?>
