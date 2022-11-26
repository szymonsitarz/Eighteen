<?php
    const SECOND = 1;
    const MINUTE = 60;
    const HOUR = MINUTE * 60;
    const DAY = HOUR * 24;
    const WEEK = DAY * 7;
    const MONTH = DAY * (365.25 / 12);
    const YEAR = DAY * 365.25;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 
    require_once($_SERVER['DOCUMENT_ROOT'] . '/database_connection.php');

    if(isset($_POST['uid']))
    {
        if(isset($_POST['set_timeout']) && isset($_POST['timeout_unit']))
        {
            $now = "UNIX_TIMESTAMP(CURRENT_TIMESTAMP)";
            switch($_POST['timeout_unit'])
            {
                case "hour":
                    $duration = HOUR;
                    break;
                case "day":
                    $duration = DAY;
                    break;
                case "week":
                    $duration = WEEK;
                    break;
                case "month":
                    $duration = MONTH;
                    break;
                case "year":
                    $duration = YEAR;
                    break;
                default:
                    echo "THROW ERROR";
            }
            $duration *= $_POST['coefficient'];
            $query = "UPDATE users SET timeout_stamp=UNIX_TIMESTAMP(CURRENT_TIMESTAMP), timeout_duration=:timeout_duration WHERE uid=:uid";
            $sth = $db->prepare($query);
            $sth->bindParam(':timeout_duration', $duration);
        }
        else if(isset($_POST['unset_timeout']))
        {
            $query = "UPDATE users SET timeout_stamp=NULL, timeout_duration=NULL WHERE uid=:uid";
            $sth = $db->prepare($query);
        }
        $sth->bindParam(':uid', $_POST['uid']);
        $sth->execute();
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>