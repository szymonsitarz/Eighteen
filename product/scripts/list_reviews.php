<?php
    const MINUTE = 60;
    const HOUR = MINUTE * 60;
    const DAY = HOUR * 24;
    const WEEK = DAY * 7;
    const MONTH = DAY * (365.25 / 12);
    const YEAR = DAY * 365.25;
    
    $query = "SELECT username, review, rating, seconds_since_epoch FROM feedback WHERE model=:model ORDER BY seconds_since_epoch DESC";
    $sth = $db->prepare($query);
    $sth->bindParam(':model', $_SESSION['product']['model']);
    $sth->execute();
    $reviews = $sth->fetchAll();
    
    if($sth->rowCount() > 0)
    {
        $first = 1;
        foreach($reviews as $tmp)
        {
            if($first)
                $first=0;
            else
                echo "<hr>";

            // 1/4 Display username
            echo "<h4 class=\"review-username\">" . $tmp['username'] . "</h4>\n";

            // 2/4 Display rating
            for($j=1;$j <= 5;$j++)
            {
                echo "<img class=\"star\" src=\"/shared-files/200219998/star-";
                if($j <= $tmp['rating'])
                    echo "full.png\">";
                else
                    echo "empty.png\">";
            }
            echo "<br>\n";

            // 3/4 Display time since review was posted
            $now = time();
            $then = $tmp['seconds_since_epoch'];
            $since = $now - $then;
            echo "<small>";
            if($since > YEAR)
                echo intval($since / YEAR) . " year(s) ago.";
            else if($since > MONTH)
                echo intval($since / MONTH) . " month(s) ago.";
            else if($since > WEEK)
                echo intval($since / WEEK) . " week(s) ago.";
            else if($since > DAY)
                echo intval($since / DAY) . " day(s) ago.";
            else if($since > HOUR)
                echo intval($since / HOUR) . " hour(s) ago.";
            else if($since > MINUTE)
                echo intval($since / MINUTE) . " minute(s) ago.";
            else
                echo "a few seconds ago";
            echo "</small>\n";
            echo "</div>\n";
            echo "<div id=\"review-comments\">\n";

            // 4/4 Display review comments
            echo "<blockquote>" . $tmp['review'] . "</blockquote>";
        }
    }
    else
        echo "Be the first to review!";

?>
