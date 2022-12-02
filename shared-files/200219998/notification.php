<?php
    if(isset($_SESSION['info']['notification']))
    {
        echo "<span style=\"color:white;background-color:black;float:right;clear:both;\"><strong>";
        if(!$_SESSION['info']['success'])
            echo "Error: ";
        echo $_SESSION['info']['notification'] . "</strong></span>";
        unset($_SESSION['info']['notification']);
    }
    $_SESSION['info']['success'] = true;
?>        
