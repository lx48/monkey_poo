<?php
require_once "header.php";


if(isset($_SESSION['usr']))
    {
        $ussr = $_SESSION['usr'];

        //Every time user leaves any minx page(either to an externale or a local page)
        //this code sets a time stamp under the current username's on_line column

        $query_s = "SELECT online FROM clients WHERE username='$ussr'";
        $query_s = $pdo -> query($query_s);
        $query_s = $query_s -> fetch();
        $query_s = $query_s['online'];


        $current_time2 = time() +60; //We added an extra minute ontop 

        if($query_s == "online")
            {
                $query_st = "UPDATE clients SET online='$current_time2' WHERE online='online' AND username='$ussr'";
                $query_st = $pdo -> query($query_st);
            }

    }  

else
    {
        $ussr = $_SESSION['usr_s'];

        //Every time user leaves any minx page(either to an externale or a local page)
        //this code sets a time stamp under the current username's on_line column

        $query_s = "SELECT on_line FROM users WHERE username='$ussr'";
        $query_s = $pdo -> query($query_s);
        $query_s = $query_s -> fetch();
        $query_s = $query_s['on_line'];


        $current_time2 = time() +60; //We added an extra minute ontop 

        if($query_s == "online")
            {
                $query_st = "UPDATE users SET on_line='$current_time2' WHERE on_line='online' AND username='$ussr'";
                //$query_st = "UPDATE users SET on_line='$current_time2' WHERE username='$ussr'";
                $query_st = $pdo -> query($query_st);
            }

    }

//Every time user leaves any minx page(either to an externale or a local page)
//this code sets a time stamp under the current username's on_line column
/*
$query_s = "SELECT online FROM clients WHERE username='$ussr'";
$query_s = $pdo -> query($query_s);
$query_s = $query_s -> fetch();
$query_s = $query_s['online'];


$current_time2 = time() +60; //We added an extra minute ontop 

if($query_s == "online")
    {
        $query_st = "UPDATE clients SET online='$current_time2' WHERE online='online' AND username='$ussr'";
        $query_st = $pdo -> query($query_st);
    }
*/
?>