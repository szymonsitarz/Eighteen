<?php
require("dbc.php");

function getUsersData($id){
    $q= mysqli_query("SELECT * FROM 'users' WHERE 'id'=".$id);
    $array= array();
    while($r= mysql_fetch_assoc($q)){
        $array['id']= $r['id'];
        $array['username']= $r['username'];
        $array['firstname']= $r['firstname'];
        $array['lastname']= $r['lastname'];
        $array['password']= $r['password'];
    }
    return $array;
}

function getId($username){
    $q= mysqli_query("SELECT 'id' FROM 'users' WHERE 'username'='".$username."'");
    while($r= mysql_fetch_assoc($q)){
        return $r['id'];
    }
}

?>