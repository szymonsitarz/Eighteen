<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/database_connection.php');
    $query = "UPDATE users SET banned=:banned WHERE uid=:uid";
    $sth = $db->prepare($query);
    if(isset($_POST['change_banned']) && isset($_POST['uid']))
    {    
        $t=1;$f=0;
        if($_POST['change_banned'] == 'switch-off')
            $sth->bindParam(":banned", $f);
        else if($_POST['change_banned'] == 'switch-on')
            $sth->bindParam(":banned", $t);
        else
        {
            http_response_code(500);
            include_once($_SERVER['DOCUMENT_ROOT'] . '/error/500.php');
        }
        $sth->bindParam(":uid", $_POST['uid']);
        $sth->execute();
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>