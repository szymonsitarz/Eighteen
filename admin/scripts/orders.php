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
    $orders = $sth->fetchAll();

    /* Allow sorting by table headings */
    echo "<table><tr>";
    $headings = array("User ID", "Username", "Email", "Product ID", "Product name", "Model", "Order status", "Timestamp");
    $columns = array("uid", "username", "email", "pid", "name", "model", "status", "timestamp");

    for($i=0;$i<count($headings);$i++)
    {
        echo "<th><a href=\"admin.php?admin_tab=orders&orders_sort=" . $columns[$i] . "\">" . $headings[$i];
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