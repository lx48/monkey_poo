<?php
require_once "functions.php";
//This program keeps looping the DATA BASE's on_line column if the value is on_line or offline it passes 
//but if the value has a timestamp > than a munite it replaces that value with "offline" but if the timestamp < it passes too

$query_userStatus = "SELECT * FROM clients";
$query_userStatus = $pdo -> query($query_userStatus);
$lines = $query_userStatus -> rowCount();

for($i=0; $i<$lines; $i++)
    {
        $next_user = $query_userStatus -> fetch();
        $user_status = $next_user['online'];


        if(($user_status != "offline") && ($user_status != "online"))
            {
                $userName = $next_user['username'];

                //Displays timestamp of 5 days from now (days*hours*mins*sec)
                //echo time() + 5*24*60*60;
                
                $current_time = time();

                if($current_time > $user_status) //meaning that more than one minute to has passed since the $user_status
                    {
                        //$change_status = "SET online='' FROM users WHERE username='$userName'";
                        $change_status = "UPDATE clients SET online='offline' WHERE online='$user_status' AND username='$userName'";
                        $change_status = $pdo -> query($change_status);
                    }
            }
    }









$query_userStatus = "SELECT * FROM users";
$query_userStatus = $pdo -> query($query_userStatus);
$lines = $query_userStatus -> rowCount();

for($i=0; $i<$lines; $i++)
    {
        $next_user = $query_userStatus -> fetch();
        $user_status = $next_user['on_line'];


        if(($user_status != "offline") && ($user_status != "online"))
            {
                $userName = $next_user['username'];

                //Displays timestamp of 5 days from now (days*hours*mins*sec)
                //echo time() + 5*24*60*60;
                
                $current_time = time();

                if($current_time > $user_status) //meaning that more than one minute to has passed since the $user_status
                    {
                        //$change_status = "SET online='' FROM users WHERE username='$userName'";
                        $change_status = "UPDATE users SET on_line='offline' WHERE on_line='$user_status' AND username='$userName'";
                        $change_status = $pdo -> query($change_status);
                    }
            }
    }




?>