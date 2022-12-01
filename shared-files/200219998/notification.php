<?php
    if(isset($_SESSION['info']['notification']))
    {
        if($_SESSION['info']['success'])
            echo "<p style=\"color:#00ff00;\"><strong>";
        else
            echo "<p style=\"color:#ff0000;\"><strong>Error: ";
        echo $_SESSION['info']['notification'] . "</strong></span>";
        unset($_SESSION['info']['notification']);
    }
    $_SESSION['info']['success'] = true;
?>        