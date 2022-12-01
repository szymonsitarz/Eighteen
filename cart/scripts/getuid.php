<?php
    if(isset($_SESSION['auth']))
    {
        $query = "SELECT uid FROM users WHERE username=:username";
        $sth = $db->prepare($query);
        $sth->bindParam(':username', $_SESSION['auth']);
        $sth->execute();
        $uid = $sth->fetchColumn();
    }
?>
