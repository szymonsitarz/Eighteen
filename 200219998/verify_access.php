<?php
require_once('database_connection.php');

// Fetch banned and timeout data for user
$query = "SELECT username, banned, timeout_stamp, timeout_duration FROM users WHERE username=:username";
$sth = $db->prepare($query);
$sth->bindParam(':username', $username);
$sth->execute();
$row = $sth->fetch(PDO::FETCH_ASSOC);

$authorised = true;
$_SESSION['info']['success'] = false;

// Handle authentication measures for banned and timed out users
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

// Flag determines if user login is allowed
if($authorised)
{
    $_SESSION['info']['success'] = true;
    $_SESSION['info']['notification'] = "You are now logged in.";
}
else
{
    $_SESSION['info']['success'] = false;
    if($row['banned']) 
        $_SESSION['info']['notification'] = "This account is banned indefinitely.";
    else
        $_SESSION['info']['notification'] = "This account is locked out until " . date("Y-m-d H:i:s", substr(($row['timeout_stamp']+$row['timeout_duration']), 0, 10)) . ".";
}
?>
