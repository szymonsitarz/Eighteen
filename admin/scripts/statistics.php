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
                $query .= "size";
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
                http_response_code(404);
                include_once($_SERVER['DOCUMENT_ROOT'] . '/error/404.php');
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
    //echo $sth->debugDumpParams();
    $sth->execute();
    $statistics = $sth->fetchAll();

    /* Allow sorting by table headings */
    echo "<table><tr>";
    $headings = array("Product ID", "Product name", "Model", "Size", "Stock", "Sold", "Views");
    $columns = array("pid", "name", "model", "size", "stock", "sold", "views");

    for($i=0;$i<count($headings);$i++)
    {
        echo "<th><a href=\"admin.php?admin_tab=statistics&statistics_sort=" . $columns[$i] . "\">" . $headings[$i];
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