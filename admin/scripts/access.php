
<?php
    const SECOND = 1;
    const MINUTE = 60;
    const HOUR = MINUTE * 60;
    const DAY = HOUR * 24;
    const WEEK = DAY * 7;
    const MONTH = DAY * (365.25 / 12);
    const YEAR = DAY * 365.25;

    $query = "SELECT uid, username, email, privileges, banned, timeout_stamp, timeout_duration from users";

    $sth = $db->prepare($query);
    $sth->execute();
    $orders = $sth->fetchAll();

    /* Allow sorting by table headings */
    echo "<table>
            <tr>
                <th><a href=\"admin.php?admin_tab=access&orders_sort=uid\">User ID</a></th>
                <th><a href=\"admin.php?admin_tab=access&access_sort=username\">Username</a></th>
                <th><a href=\"admin.php?admin_tab=access&access_sort=email\">Email</a></th>
                <th><a href=\"admin.php?admin_tab=access&access_sort=privileges\">Privileges</a></th>
                <th>Ban/unban</th>
                <th><a href=\"admin.php?admin_tab=access&access_sort=timeout\">Timeout</a></th>
            </tr>";

    /* Display orders in tabular format ordered by timestamp by default */
    foreach($orders as $tmp)
    {
            echo "<tr>";
            echo "<td>" . $tmp['uid'] . "</td>";
            echo "<td>" . $tmp['username'] . "</td>";
            echo "<td>" . $tmp['email'] . "</td>";
            echo "<td><form method=\"POST\" action=\"scripts/privileges.php\"><button type=\"submit\" name=\"change_privileges\" style=\"background-color:" . ($tmp['privileges'] ? "#00ff00\" value=\"switch-off\">ON" : "#ff0000\" value=\"switch-on\">OFF") . "</button></form></td>";
            echo "<td><form method=\"POST\" action=\"scripts/banned.php\"><button type=\"submit\" name=\"change_banned\" style=\"background-color:" . ($tmp['banned'] ? "#00ff00\" value=\"switch-off\">ON" : "#ff0000\" value=\"switch-on\">OFF") . "</button></form></td>";            
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
                echo "<input type=\"hidden\" name=\"uid\" value=\"" . $tmp['uid'] . "\">";
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
            echo "</form>";
            echo "</td>";

        echo "</tr>";
    }
    echo "</table>";

?>
