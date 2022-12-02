<?php
    session_start();
    if(isset($_SESSION['auth']))
        unset($_SESSION['auth']);

    if(isset($_SESSION['is_admin']))
        unset($_SESSION['is_admin']);

    header('Location: /home/home.php'); 
?>
