<?php


    // Example 01: functions.php
    $host = 'localhost';  // Production server name
    $data = 'minx'; // Database name
    $user = '777'; // Administrator name
    $pass = '777';   // Administrator password
    $chrs = 'utf8mb4';
    $attr = "mysql:host=$host;dbname=$data;charset=$chrs";
    $opts =
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

    try
        {
            $pdo = new PDO($attr, $user, $pass, $opts);
            //echo"Connection was successful<br><br>";
        }

    catch (\PDOException $e)
        {
            //echo"Connection was not successful<br><br>";  
        }



    

        
    function createTable($name, $query)
        {
            queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
            echo "Table '$name' created or already exists.<br>";
        }

    function queryMysql($query)
        {
            global $pdo;
            return $pdo->query($query);
        }


    function c_Age($dateOfBirth)
        {


            list($year, $month, $day) = explode("-", $dateOfBirth);
            $yearDifference = date('Y') - $year;
    
    /*

        
        if($year >= date("Y") )
            {
                
                echo ("You have entered an invalid date");
                echo "<br>";
                $age = $yearDifference;
            }
        
    */
    
           if( (date("m") > $month) || ( (date("m") == $month) && ( date("d") >= $day )))
                {
                    $age = $yearDifference;    
                }
            else
                {
                    $age = $yearDifference-1;                
                }
            return $age;

        }


        function login_client($pdo)
            {



                $usrname = $_SESSION['usr'];
                if(isset($usrname))
                    {
                        $query_session = "SELECT * FROM clients WHERE username='$usrname'";
                        $query_session = $pdo -> query($query_session);
                        $line22 = $query_session -> fetch();
                        $on_state = $line22['online'];
                        
                        if($on_state == 'offline')
                            {
                                session_destroy();
                                ?>
                                <script>
                                    window.location = "login.php"
                                </script>
                                <?php
                            }

                    }
                //if(!isset($usrname))
                elseif(!isset($usrname))
                    {
                        ?>
                        <script>
                            window.location = "login.php"
                        </script>
                        <?php
                    }
                //elseif    check that the user's subscription is upto date
                //if its not refere him or her to the subscription page
            }

        function login_girl($pdo)
            {
                $usrname = $_SESSION['usr_s'];

                if(isset($usrname))
                    {
                        $query_session = "SELECT * FROM users WHERE username='$usrname'";
                        $query_session = $pdo -> query($query_session);
                        $line22 = $query_session -> fetch();
                        $on_state = $line22['on_line'];
                        
                        if($on_state == 'offline')
                            {
                                session_destroy();
                                ?>
                                <script>
                                    window.location = "login.php"
                                </script>
                                <?php
                            }

                    }

                elseif(!isset($usrname))
                    {
                        ?>
                        <script>
                            window.location = "login.php"
                        </script>
                        <?php
                    }
            }
        

        ////////////////////////////////////user///////////////////////////////////////////////////


        
        //This functoin keeps looping the DATA BASE's on_line column if the value is on_line or offline it passes 
        //but if the value has a timestamp > than a munite it replaces that value with "offline" but if the timestamp < it passes too
        function user_check_status($pdo)
            {
                $query_userStatus = "SELECT * FROM users";
                $query_userStatus = $pdo -> query($query_userStatus);
                $lines = $query_userStatus -> rowCount();

                for($i=0; $i<$lines; $i++)
                    {
                        $next_user = $query_userStatus -> fetch();
                        $user_status = $next_user['on_line'];//This time stamp was set a minute ahead


                        if(($user_status !== "offline") && ($user_status !== "online"))
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


            }
        
        //Every time user leaves any minx page(either to an externale or a local page)
        //this function sets a time stamp under the current username's on_line column
        function user_set_timestamp($ussr, $pdo)  
            {

                $query_s = "SELECT on_line FROM users WHERE username='$ussr'";
                $query_s = $pdo -> query($query_s);
                $query_s = $query_s -> fetch();
                $query_s = $query_s['on_line'];

                $current_time2 = time() +60; //We added an extra minute ontop 
                if($query_s == "online")
                    {
                        $query_st = "UPDATE users SET on_line='$current_time2' WHERE on_line='online' AND username='$ussr'";
                        $query_st = $pdo -> query($query_st);
                    }
            }

        //Every time a user opens or reopens any minx page this function checks for a value under 
        //the username's online column if it is a timestap set less than a munite ago, that timestamp value
        //is replaced with the value"online". if the value is "offline" or the timestamp > than 1 minute
        //the session is destroyed
        function user_reset_timestamp($ussr2, $pdo)  
            {
                $query_reset= "SELECT * FROM users WHERE username='$ussr2'";
                $query_reset = $pdo -> query($query_reset);
                $line = $query_reset -> fetch();
                
                $new_timestamp = time();
                $old_timestamp = $line['on_line'];

                if($old_timestamp == "offline")
                    {
                        session_destroy();
                    }

                elseif($new_timestamp >= $old_timestamp)
                    {
                        session_destroy();
                    }
                elseif($new_timestamp <= $old_timestamp)
                    {
                        $q33 = "UPDATE users SET on_line='online' WHERE on_line='$old_timestamp' AND username'$ussr2'";
                        $q33 = $pdo -> query($q33);
                    }
                

            }

        //////////////////////////////////////////////////////client////////////////////////////////


        //This functoin keeps looping the DATA BASE's online column if the value is online or offline it passes 
        //but if the value has a timestamp > than a munite it replaces that value with "offline" but if the timestamp < it passes too
        function client_check_status($pdo)
            {
                $query_userStatus = "SELECT * FROM clients";
                $query_userStatus = $pdo -> query($query_userStatus);
                $lines = $query_userStatus -> rowCount();

                for($i=0; $i<$lines; $i++)
                    {
                        $next_user = $query_userStatus -> fetch();
                        $user_status = $next_user['online'];//This time stamp was set a minute ahead


                        if(($user_status !== "offline") && ($user_status !== "online"))
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


            }
        
        //Every time user leaves any minx page(either to an externale or a local page)
        //this function sets a time stamp under the current username's online column
        function client_set_timestamp($ussr, $pdo)  
            {

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

        //Every time a user opens or reopens any minx page this function checks for a value under 
        //the username's online column if it is a timestap set less than a munite ago, that timestamp value
        //is replaced with the value"online". if the value is "offline" or the timestamp > than 1 minute
        //the session is destroyed
        function client_reset_timestamp($ussr2, $pdo)  
            {
                $query_reset= "SELECT * FROM clients WHERE username='$ussr2'";
                $query_reset = $pdo -> query($query_reset);
                $line = $query_reset -> fetch();
                
                $new_timestamp = time();
                $old_timestamp = $line['online'];

                if($old_timestamp == "offline")
                    {
                        session_destroy();
                    }

                elseif($new_timestamp >= $old_timestamp)
                    {
                        session_destroy();
                    }
                elseif($new_timestamp <= $old_timestamp)
                    {
                        $q33 = "UPDATE clients SET online='online' WHERE online='$old_timestamp' AND username'$ussr2'";
                        $q33 = $pdo -> query($q33);
                    }
                

            }



?>