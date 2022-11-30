<?php
    const SECOND = 1;
    const MINUTE = 60;
    const HOUR = MINUTE * 60;
    const DAY = HOUR * 24;
    const WEEK = DAY * 7;
    const MONTH = DAY * (365.25 / 12);
    const YEAR = DAY * 365.25;

    $query = "SELECT uid, username, email, privileges, banned, timeout_stamp, timeout_duration FROM users ORDER BY ";

    /* Handling sorting for when a table heading column is clicked. */
    if(!isset($_GET['access_sort']))
        $query .=  "uid";
    else
    {
        $_SESSION['admin']['sort_selected'] = $_GET['access_sort'];

        // Reset sort state if a different column is chosen for sorting.
        if($_SESSION['admin']['sorted_last'] != $_SESSION['admin']['sort_selected'])
            $_SESSION['admin']['sort_state'] = 0; // i.e. ASC

        switch($_SESSION['admin']['sort_selected'])
        {
            case "uid":
                $query .= "uid";
                break;
            case "username":
                $query .=  "username";
                break;
            case "email":
                $query .=  "email";
                break;
            case "privileges":
                $query .=  "privileges";
                break;
            case "banned":
                $query .=  "banned";
                break;
            default:
                http_response_code(404);
                include_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/error/404.php');
        }
        // Set sort state and invert sort state on next click (unless a different tab is chosen)
        if(isset($_SESSION['admin']['sort_state']))
        {
            $query .= ($_SESSION['admin']['sort_state'] ? " DESC" : " ASC");
            $_SESSION['admin']['sort_state'] = !$_SESSION['admin']['sort_state'];
        }
        
        // Save last column to later determine whether to flip sort state or reset sort state.
        $_SESSION['admin']['sorted_last'] = $_SESSION['admin']['sort_selected'];
    }

    $sth = $db->prepare($query);
    $sth->execute();
    $access = $sth->fetchAll();

    /* Allow sorting by table headings */
    echo "<table><tr>";
    $headings = array("User ID", "Username", "Email", "Privileges", "Banned");
    $columns = array("uid", "username", "email", "privileges", "banned");

    for($i=0;$i<count($headings);$i++)
    {
        echo "<th><a href=\"admin.php?admin_tab=access&access_sort=" . $columns[$i] . "\">" . $headings[$i];
        if(isset($_SESSION['admin']['sort_selected']))
        {
            if($_SESSION['admin']['sort_selected'] == $columns[$i])
            {
                if(isset($_SESSION['admin']['sort_state']))
                {
                    echo "<img class=\"sort-sym\" src=\"img/";
                    echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
                    echo "\">";
                }
            }
        }
        echo "</a></th>";
    }
    echo "<th>Timeout</th>";
    echo "</tr>";

    /* Display accounts in tabular format ordered by timestamp by default */
    foreach($access as $tmp)
    {
            echo "<tr>";
            echo "<td>" . $tmp['uid'] . "</td>";
            echo "<td>" . $tmp['username'] . "</td>";
            echo "<td>" . $tmp['email'] . "</td>";
            echo "<td>
                    <form method=\"POST\" action=\"scripts/privileges.php\">
                        <button type=\"submit\" name=\"change_privileges\" style=\"background-color:" . ($tmp['privileges'] ? "#00ff00\" value=\"switch-off\">ON" : "#ff0000\" value=\"switch-on\">OFF") . "</button>
                        <input type=\"hidden\" name=\"uid\" value=\"" . $tmp['uid'] . "\">
                    </form>
                </td>";
            echo "<td>
                    <form method=\"POST\" action=\"scripts/banned.php\">
                        <button type=\"submit\" name=\"change_banned\" style=\"background-color:" . ($tmp['banned'] ? "#00ff00\" value=\"switch-off\">ON" : "#ff0000\" value=\"switch-on\">OFF") . "</button>
                        <input type=\"hidden\" name=\"uid\" value=\"" . $tmp['uid'] . "\">
                    </form>
                </td>";            
            echo "<td>";
            echo "<form method=\"POST\" action=\"scripts/timeout.php\">";
            if($tmp['timeout_stamp'] == NULL && $tmp['timeout_duration'] == NULL)
            {
                echo "<input type=\"number\" name=\"coefficient\">";
                echo "<select name=\"timeout_unit\">";
                    echo "<option value=\"hour\">hour(s)</option>";
                    echo "<option value=\"day\">day(s)</option>";
                    echo "<option value=\"week\">week(s)</option>";
                    echo "<option value=\"month\">month(s)</option>";
                    echo "<option value=\"year\">year(s)</option>";
                echo "</select>";
                echo "<button type=\"submit\" name=\"set_timeout\">Set</button>";
            }
            else {
                $now = time();
                $since = $now - ($tmp['timeout_stamp'] - $tmp['timeout_duration']);
                if($since > YEAR)
                    echo intval($since / YEAR) . " year(s)";
                else if($since > MONTH)
                    echo intval($since / MONTH) . " month(s)";
                else if($since > WEEK)
                    echo intval($since / WEEK) . " week(s)";
                else if($since > DAY)
                    echo intval($since / DAY) . " day(s)";
                else if($since > HOUR)
                    echo intval($since / HOUR) . " hour(s)";
                else if($since > MINUTE)
                    echo intval($since / MINUTE) . " minute(s)";
                else
                    echo $since . "a few seconds";
                // LOGIN PAGE MUST CHECK TIMEOUT AND SET TWO FILEDS TO NULL IF $since < 10 * SECOND
                // LOGIN PAGE MUST ALSO CHECK IF BANNED
                // LOGIN PAGE MUST ALSO GENERATE A TOKEN WITH PRIVILEGES IN IT
                echo "<button type=\"submit\" name=\"unset_timeout\">Unset</button>";
            }
            echo "<input type=\"hidden\" name=\"uid\" value=\"" . $tmp['uid'] . "\">";
            echo "</form>";
            echo "</td>";

        echo "</tr>";
    }
    echo "</table>";

?>
