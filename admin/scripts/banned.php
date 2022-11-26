<?php
    $query = "UPDATE users SET banned=:banned WHERE uid=:uid";
    if(isset($_POST['change_banned']) && isset($_POST['uid']))
    {    
        $t=1;$f=0;
        if($_POST['change_banned'] == 'switch-off')
            $sth->bindParam(":banned", $t);
        else if($_POST['change_privileges'] == 'switch-on')
            $sth->bindParam(":privileges", $f);
        else
            echo "THROW ERROR";
        $sth->bindParam(":uid", $_POST['uid']);
        $sth->execute();
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>