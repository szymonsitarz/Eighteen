
<?php
include 'database_connection.php';

session_destroy();
foreach($_SESSION as $tem){
    unset($tem);
}

header("Location: /home/home.html.php");

?>