<?php
    $query = "SELECT pid, name, model, size, stock, bought_all_time, views FROM products ORDER BY ";

    /* Handling sorting for when a table heading column is clicked. */
    if(!isset($_GET['statistics_sort']))
        $query .=  "pid";
    else
    {
        $_SESSION['admin']['sort_selected'] = $_GET['statistics_sort'];

        // Reset sort state if a different column is chosen for sorting.
        if($_SESSION['admin']['sorted_last'] != $_SESSION['admin']['sort_selected'])
            $_SESSION['admin']['sort_state'] = 0; // i.e. ASC

        switch($_SESSION['admin']['sort_selected'])
        {
            case "pid":
                $query .= "pid";
                break;
            case "name":
                $query .=  "name";
                break;
            case "model":
                $query .=  "model";
                break;
            case "size":
                $query .=  "size";
                break;
            case "stock":
                $query .=  "stock";
                break;
            case "sold":
                $query .=  "bought_all_time";
                break;
            case "views":
                $query .= "views";
                break;
            default:
                echo "THROW ERROR";
        }

        $query .= ($_SESSION['admin']['sort_state'] ? " DESC" : " ASC");
        
        // Save last column to later determine whether to flip sort state or reset sort state.
        $_SESSION['admin']['sorted_last'] = $_SESSION['admin']['sort_selected'];

        // Flip sort state by default, reset later if last column is different to the selected column.
        $_SESSION['admin']['sort_state'] = !$_SESSION['admin']['sort_state'];
    }

    $sth = $db->prepare($query);
    //echo $sth->debugDumpParams();
    $sth->execute();
    $statistics = $sth->fetchAll();

    /* Allow sorting by table headings */
    echo "<table><tr>";
    echo "<th><a href=\"admin.php?admin_tab=statistics&statistics_sort=pid\">Product ID";
    if($_SESSION['admin']['sort_selected'] == "pid")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=statistics&statistics_sort=name\">Product name";
    if($_SESSION['admin']['sort_selected'] == "name")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=statistics&statistics_sort=model\">Model";
    if($_SESSION['admin']['sort_selected'] == "model")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=statistics&statistics_sort=size\">Size";
    if($_SESSION['admin']['sort_selected'] == "size")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }
    
    echo "<th><a href=\"admin.php?admin_tab=statistics&statistics_sort=stock\">Stock";
    if($_SESSION['admin']['sort_selected'] == "stock")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }
    
    echo "<th><a href=\"admin.php?admin_tab=statistics&statistics_sort=sold\">Sold";
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }
    
    echo "<th><a href=\"admin.php?admin_tab=statistics&statistics_sort=views\">Views";
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }
    echo "</tr>";

    /* Display statistics in tabular format ordered by timestamp by default */
    foreach($statistics as $tmp)
    {
            echo "<tr>";
            echo "<td>" . $tmp['pid'] . "</td>";
            echo "<td>" . $tmp['name'] . "</td>";
            echo "<td><a href=\"/product/product.php?model=" . $tmp['model'] . "&size=" . $tmp['size'] . "\">" . $tmp['model'] . "</a></td>";
            echo "<td>" . $tmp['size'] . "</td>";
            echo "<td>" . ($tmp['stock'] ? $tmp['stock'] : "Out-of-stock") . "</td>";
            echo "<td>" . $tmp['bought_all_time'] . "</td>";
            echo "<td>" . $tmp['views'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";


?>