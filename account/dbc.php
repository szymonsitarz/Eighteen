<?php

try{ 
$db=new PDO("mysql:dbname=cs2tp; host=localhost", "root","");  
} catch (PDOException $ex) {      
    ?>  <p>Sorry,  a database error occurred.</p>     
    <p> Error details: <em> <?= $ex->getMessage() ?> </em></p>     
    <?php     
}  
?>