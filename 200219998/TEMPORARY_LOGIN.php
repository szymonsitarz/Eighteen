<?php
    session_start();
    if(isset($_POST['state']))
        if($_POST['state'] == 'on')
        {
            $_SESSION['authenticate']['is_admin'] = 1;
            $_SESSION['authenticate']['username'] = "admin";
        }
        else if($_POST['state'] == 'off')
        {
            unset($_SESSION['authenticate']['is_admin']);
            unset($_SESSION['authenticate']['username']);
        }

    if(!empty($_SERVER['HTTP_REFERER']))
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    else
        header('Location: ' . $_SESSION['info']['referer']);
?>
