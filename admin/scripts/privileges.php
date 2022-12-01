<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/database_connection.php');
    $query = "UPDATE users SET privileges=:privileges WHERE uid=:uid";
    $sth = $db->prepare($query);
    if(isset($_POST['change_privileges']) && isset($_POST['uid']))
    {    
        $t=1;$f=0;
        if($_POST['change_privileges'] == 'switch-off')
            $sth->bindParam(":privileges", $f);
        else if($_POST['change_privileges'] == 'switch-on')
            $sth->bindParam(":privileges", $t);
        else
        {
            http_response_code(500);
            include_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/error/500.php');
        }
        $sth->bindParam(":uid", $_POST['uid']);
        $sth->execute();
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>