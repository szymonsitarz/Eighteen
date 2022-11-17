<?php
    $query = "SELECT name,model,price,avg_rating,rank FROM products" ;

    // Set greater than zero if there are conditions for WHERE clause.
    $filters = count($_POST) + (!empty($_GET['q']) ? 1 : 0);

    // This flag monitors whenceforth ANDs should be inserted.
    $match = 0;

    if($filters > 0)
    {
        $query .= " WHERE";

        // Filter search results by keywords, if none display all products.
        if(!empty($_GET['q']))
        {   
            // Trim whitespace from start and end of string.
            $_GET['q'] = trim($_GET['q'], " \n\r\t\v\x00");

            $keywords = explode(" ", $_GET['q']);
            
            $query .= " name LIKE :i0";
            if(($n = count($keywords)) > 1)
            {
                for($i=1;$i<$n;$i++)
                    $query .= " OR name LIKE :i" . $i;
            }
            $match = 1;
        }

        // Filter search results by other various attributes.
        if(isset($_POST['category']))
        {
            if($match == 1) $query .= " AND";
            $query .= " ( category = :j0";
            $j=0;
            if(count($_POST['category']) > 1)
            {
                foreach($_POST['category'] as $tmp)
                {
                    if($j != 0)
                        $query .= " OR category = :j" . $j;
                    $j++;
                }
                $j--;
            } 
            $query .= " )";
            $match = 1;
        }

        if(isset($_POST['lower']))
        {
            if($match == 1) $query .= " AND";
            $query .= " price >= :lower";
            $match = 1;
        }   
        if(isset($_POST['upper']))
        {
            if($match == 1) $query .= " AND";
            $query .= " price <= :upper";
            $match = 1;
        }
        if(isset($_POST['color']))
        {
            if($match == 1) $query .= " AND";
            $query .= " ( color = :k0";
            $k=0;
            if(count($_POST['color']) > 1)
            {
                foreach($_POST['color'] as $tmp)
                {
                    if($k != 0)
                        $query .= " OR color = :k" . $k;
                    $k++;
                }
                $k--;
            } 
            $query .= " )";
            $match = 1;
        }
    }

     /* Key detail: Combines products with the same model so different sizes 
        and colors are not separate listings in the collections view - despite
        each product being listed with its own color and size separately in the
        products table. */
    $query .= " GROUP BY model;";

    // Parse query data for sorting function of search engine.
    if(!isset($_GET['sort']) || $_GET['sort'] == "relevance")
        $query .= " ORDER BY rank";
    else
    {
        if($_GET['sort'] == "low-to-high")
            $query .= " ORDER BY price";
        else if($_GET['sort'] == "high-to-low")
            $query .= " ORDER BY price DESC";
        else if($_GET['sort'] == "rating")
            $query .= " ORDER BY avg_rating DESC";
        else
            echo "Throw error.";
    }

    // Finally, building and execute parameterized query
    $sth = $db->prepare($query);
    
    if(!empty($_GET['q']))
    {
        for($i=0;$i<$n;$i++)
        {
            $bind = ':i' . $i;
            $keywords[$i] = '%' . $keywords[$i] . '%';
            $sth->bindParam($bind, $keywords[$i]);
        }
    }
    if(isset($_POST['category']))
    {
        $x=0;
        foreach($categories as $category)
        {
            if(isset($_POST['category']['\'' . $category . '\'']))
            {
                $bind = ':j' . $x++;
                $sth->bindParam($bind, $_POST['category']['\'' . $category . '\'']);
            }
        }
    }
    if(isset($_POST['lower']))
        $sth->bindParam(':lower', $_POST['lower']);
    if(isset($_POST['upper']))
        $sth->bindParam(':upper', $_POST['upper']);
    if(isset($_POST['color']))
    {
        $x=0;
        foreach($colors as $color)
        {
            if(isset($_POST['color']['\'' . $color . '\'']))
            {
                $bind = ':k' . $x++;
                $sth->bindParam($bind, $_POST['color']['\'' . $color . '\'']);
            }
        }
    }
    $sth->execute();
?>
