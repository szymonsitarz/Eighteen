<?php
    session_start();
    if($_POST['state'] == 'on')
        $_SESSION['auth'] = ''; 
    else if($_POST['state'] == 'off')
        unset($_SESSION['auth']);

    //echo $_SERVER['HTTP_REFERER'];
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>