<?php

require_once "header.php";

if(isset($_SESSION['usr']))
    {

        $ussr2 = $_SESSION['usr'];    
            
        $query_reset= "SELECT * FROM clients WHERE username='$ussr2'";
        $query_reset = $pdo -> query($query_reset);
        $line = $query_reset -> fetch();


        $new_timestamp = time();
        $old_timestamp = $line['online'];


        if($old_timestamp == "offline")
            {
                session_destroy();
            }

        elseif($old_timestamp == "online") //this is for when the page loads from the login page 
            {
                $a1 = 1; //useless
            }

        elseif($new_timestamp >= $old_timestamp)
            {
                    session_destroy();        
                    header("Location: http://localhost:3000/lynx/login.php");
            }

        elseif($new_timestamp <= $old_timestamp)
            {
                $q33 = "UPDATE clients SET online='online' WHERE online='$old_timestamp' AND username='$ussr2'";
                $q33 = $pdo -> query($q33);
            }

    }

else
    {

        $ussr2 = $_SESSION['usr_s'];    
            
        $query_reset= "SELECT * FROM users WHERE username='$ussr2'";
        $query_reset = $pdo -> query($query_reset);
        $line = $query_reset -> fetch();


        $new_timestamp = time();
        $old_timestamp = $line['on_line'];


        if($old_timestamp == "offline")
            {
                session_destroy();
            }

        elseif($old_timestamp == "online") //this is for when the page loads from the login page 
            {
                $a1 = 1; //useless
            }

        elseif($new_timestamp >= $old_timestamp)
            {
                    session_destroy();        
                    header("Location: http://localhost:3000/lynx/login.php");//useless line of code test before u remove
            }

        elseif($new_timestamp <= $old_timestamp)
            {
                $q33 = "UPDATE users SET on_line='online' WHERE on_line='$old_timestamp' AND username='$ussr2'";
                $q33 = $pdo -> query($q33);
            }

    }


/*
$ussr2 = "bbb";    
            
$query_reset= "SELECT * FROM clients WHERE username='$ussr2'";
$query_reset = $pdo -> query($query_reset);
$line = $query_reset -> fetch();


$new_timestamp = time();
$old_timestamp = $line['online'];


if($old_timestamp == "offline")
    {
        session_destroy();
    }

elseif($old_timestamp == "online") //this is for when the page loads from the login page 
    {
        $a1 = 1; //useless
    }

elseif($new_timestamp >= $old_timestamp)
    {
            session_destroy();        
            header("Location: http://localhost:3000/lynx/login.php");
    }

elseif($new_timestamp <= $old_timestamp)
    {
        $q33 = "UPDATE clients SET online='online' WHERE online='$old_timestamp' AND username='$ussr2'";
        $q33 = $pdo -> query($q33);
    }
*/     

    ?>
            

