<?php
/*
    NOTE: Code probably looks like this in login.php:
        .
        password_verify(.);
        .
        require_once('further_auth.php');
        if($authorised)
            . (do some stuff like set $_SESSION['auth'] elements)
        header('Location: /collections/collections.php'); 
*/
require_once('db.php');

// Part 1/3: Fetch banned and timeout data for user
$query = "SELECT username, banned, timeout_stamp, timeout_duration FROM users WHERE username=:username";
$sth = $db->prepare($query);
$sth->bindParam(':username', $username);
$sth->execute();
$row = $sth->fetch(PDO::FETCH_ASSOC);

$authorised = true;
$_SESSION['info']['success'] = false;

// Part 2/3: Determine whether user is authorised
if($row['banned'])
    $authorised=false;
else if($row['timeout_stamp'] != NULL && $row['timeout_duration'] != NULL)
{
    // Timeout has not expired
    if(($row['timeout_stamp'] + $row['timeout_duration']) > time())
        $authorised=false;
    // Timeout has expired - therefore, remove timeout and allow future logins
    else
    {
        $query = "UPDATE users SET timeout_stamp=NULL, timeout_duration=NULL";
        $sth = $db->prepare($query);
        $sth->execute();
    }
}

// Part 3/3: Allow access if timeout remains or banned indefinitely 
if($authorised)
{
    $_SESSION['info']['success'] = true;
    $_SESSION['info']['notification'] = "Logged in.";
}
else
{
    $_SESSION['info']['success'] = false;
    if($row['banned']) 
        $_SESSION['info']['notification'] = "Banned.";
    else
        $_SESSION['info']['notification'] = "Lock until " . date("Y-m-d H:i:s", substr(($row['timeout_stamp']+$row['timeout_duration']), 0, 10));
}

/* Continue with authentication, setting $_SESSION['auth'] if and only 
    if $authorised=true, otherwise handle as a failed login */
?>
