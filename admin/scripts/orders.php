<?php
    $query = "SELECT orders.uid, users.username, users.email, orders.pid, products.name, orders.status, orders.date_time FROM orders INNER JOIN users ON orders.uid = users.uid INNER JOIN products ON orders.pid = products.pid ORDER BY ";
    
    /* Handling sorting for when a table heading column is clicked. */
    if(!isset($_GET['orders_sort']))
        $query .=  "orders.date_time DESC";
    else
    {
        switch($_GET['orders_sort'])
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
            case "status":
                $query .=  "orders.status";
                break;
            default:
                echo "THROW ERROR";
        }
    }

    $sth = $db->prepare($query);
    $sth->execute();
    $orders = $sth->fetchAll();

    /* Allow sorting by table headings */
    echo "<table>
            <tr>
                <th><a href=\"admin.php?admin_tab=orders&orders_sort=uid\">User ID</a></th>
                <th><a href=\"admin.php?admin_tab=orders&orders_sort=username\">Username</a></th>
                <th><a href=\"admin.php?admin_tab=orders&orders_sort=email\">Email</a></th>
                <th><a href=\"admin.php?admin_tab=orders&orders_sort=pid\">Product ID</a></th>
                <th><a href=\"admin.php?admin_tab=orders&orders_sort=name\">Product name</a></th>
                <th><a href=\"admin.php?admin_tab=orders&orders_sort=status\">Order status</a></th>
                <th><a href=\"admin.php?admin_tab=orders\">Timestamp</a></th>
            </tr>";

    /* Display orders in tabular format ordered by timestamp by default */
    foreach($orders as $tmp)
    {
            echo "<td>" . $tmp['uid'] . "</td>";
            echo "<td>" . $tmp['username'] . "</td>";
            echo "<td>" . $tmp['email'] . "</td>";
            echo "<td>" . $tmp['pid'] . "</td>";
            echo "<td>" . $tmp['name'] . "</td>";
            echo "<td>" . $tmp['status'] . "</td>";
            echo "<td>" . $tmp['date_time'] . "</td>";
        echo "</tr>";
        
    }
    echo "</table>";

?>