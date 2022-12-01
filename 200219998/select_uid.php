<?php
    if(isset($_SESSION['authenticate']['username']))
    {
        $query = "SELECT uid FROM users WHERE username=:username";
        $sth = $db->prepare($query);
        $sth->bindParam(':username', $_SESSION['authenticate']['username']);
        $sth->execute();
        $uid = $sth->fetchColumn();
    }
?>