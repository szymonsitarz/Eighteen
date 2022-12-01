<?php
    session_start();
    if(isset($_SESSION['auth']))
        unset($_SESSION['auth']);

    if(isset($_SESSION['is_admin']))
        unset($_SESSION['is_admin']);

    $_SESSION['info']['success'] = true;
    $_SESSION['info']['notification'] = "You are now logged out.";
    header('Location: /home/home.php'); 
?>
