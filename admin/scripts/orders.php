<?php
    $query = "SELECT orders.uid, users.username, users.email, orders.pid, products.name, products.model, products.size, orders.status, orders.date_time FROM orders INNER JOIN users ON orders.uid = users.uid INNER JOIN products ON orders.pid = products.pid ORDER BY ";
    
    /* Handling sorting for when a table heading column is clicked. */
    if(!isset($_GET['orders_sort']))
        $query .=  "orders.date_time DESC";
    else
    {
        $_SESSION['admin']['sort_selected'] = $_GET['orders_sort'];

        // Reset sort state if a different column is chosen for sorting.
        if($_SESSION['admin']['sorted_last'] != $_SESSION['admin']['sort_selected'])
            $_SESSION['admin']['sort_state'] = 0; // i.e. ASC

        switch($_SESSION['admin']['sort_selected'])
        {
            case "uid":
                $query .=  "orders.uid";
                break;
            case "username":
                $query .=  "users.username";
                break;
            case "email":
                $query .=  "users.email";
                break;
            case "pid":
                $query .=  "orders.pid";
                break;
            case "model":
                $query .= "products.model";
                break;
            case "name":
                $query .= "products.name";
                break;
            case "status":
                $query .=  "orders.status";
                break;
            case "timestamp":
                $query .= "orders.date_time";
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
    $sth->execute();
    $orders = $sth->fetchAll();

    /* Allow sorting by table headings */
    echo "<table><tr>";
    echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=uid\">User ID";
    if($_SESSION['admin']['sort_selected'] == "uid")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=username\">Username";
    if($_SESSION['admin']['sort_selected'] == "username")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=email\">Email";
    if($_SESSION['admin']['sort_selected'] == "email")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=pid\">Product ID";
    if($_SESSION['admin']['sort_selected'] == "pid")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=name\">Product name";
    if($_SESSION['admin']['sort_selected'] == "name")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=model\">Model";
    if($_SESSION['admin']['sort_selected'] == "model")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=status\">Order status";
    if($_SESSION['admin']['sort_selected'] == "status")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=timestamp\">Timestamp";
    if($_SESSION['admin']['sort_selected'] == "timestamp")
    {
        echo "<img class=\"sort-sym\" src=\"img/";
        echo ($_SESSION['admin']['sort_state'] ? "sorting-arrow-down.png" : "sorting-arrow-up.png");
        echo "\"></a></th>";
    }

    echo "</tr>";

    /* Display orders in tabular format ordered by timestamp by default */
    foreach($orders as $tmp)
    {
            echo "<td>" . $tmp['uid'] . "</td>";
            echo "<td>" . $tmp['username'] . "</td>";
            echo "<td>" . $tmp['email'] . "</td>";
            echo "<td>" . $tmp['pid'] . "</td>";
            echo "<td>" . $tmp['name'] . "</td>";
            echo "<td><a href=\"/product/product.php?model=" . $tmp['model'] . "&size=" . $tmp['size'] . "\">" . $tmp['model'] . "</a></td>";
            echo "<td>" . $tmp['status'] . "</td>";
            echo "<td>" . $tmp['date_time'] . "</td>";
        echo "</tr>";
        
    }
    echo "</table>";

?>