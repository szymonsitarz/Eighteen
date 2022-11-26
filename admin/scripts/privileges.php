<?php
    $query = "UPDATE users SET privileges=:privileges WHERE uid=:uid";
    echo "Running.";
    if(isset($_POST['change_privileges']) && isset($_POST['uid']))
    {    
        $t=1;$f=0; echo $_POST['change_privileges'];
        if($_POST['change_privileges'] == 'switch-off')
            $sth->bindParam(":privileges", $f);
        else if($_POST['change_privileges'] == 'switch-on')
            $sth->bindParam(":privileges", $t);
        else
            echo "THROW ERROR";
        $sth->bindParam(":uid", $_POST['uid']);
        $sth->execute();
    }
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
?>