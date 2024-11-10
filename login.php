
<?php

    
    session_start();
    //require_once 'header.php';
    require_once "functions.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <link href='login.css' rel='stylesheet'>

    </head>
    <body>

    <div id="background3"></div>

    <?php        

        $error = $user = $pass = "";
        if (isset($_POST['username']))
            {

                $user = ($_POST['username']);
                $pass = ($_POST['password']);

            /*
            $query_clients = "SELECT username,password FROM clients WHERE username = '$user' AND password='$pass'";
            $query_users = "SELECT username,pass_word FROM users WHERE username = '$user' AND pass_word='$pass'";
             */           
            //I have also included hash password verify as       password_verify(provided_password, hashed_string) ; 
            
            
            
            $query_clients = "SELECT username FROM clients WHERE username = '$user'"; 
            $query_users = "SELECT username FROM users WHERE username = '$user'";

            
            $clients_results = $pdo -> query($query_clients);
            $users_results = $pdo -> query($query_users);

            /*                if ($result->rowCount() == 0)
                {
                    $error = "Invalid login attempt";
                }
            */            
            if ($clients_results->rowCount() > 0)
                {

                    $query_pass = "SELECT password FROM clients WHERE username = '$user'";
                    $password = $pdo -> query($query_pass);
                    $password = $password->fetch(); //This returns an associative array
                    $password = $password['password'];

                    //password_verify(provided_password, hashed_string)
                    $password = password_verify($pass, $password);

                    if($password) //password_verify() returns 1 if the hash matches the password
                        {
                            //This if blocks prevent the user or client from being online with multiple accounts
                            if(isset($_SESSION['usr']))
                                {
                                    $q_user = $_SESSION['usr'];
                                    $query_line = "UPDATE clients SET online='offline' WHERE username='$q_user'";
                                    $query_line = $pdo -> query($query_line);
            
                                }
                            if(isset($_SESSION['usr_s']))
                                {
                                    $q_user = $_SESSION['usr_s'];
                                    $query_line = "UPDATE users SET on_line='offline' WHERE username='$q_user'";
                                    $query_line = $pdo -> query($query_line);
            
                                }
                            session_destroy();
                            

                            session_start();
                            $_SESSION['usr'] = $user;
                            $_SESSION['pass'] = $pass;

                            $q_line = "UPDATE clients SET online='online' WHERE username='$user'";
                            $q_line = $pdo -> query($q_line);
                            

                            ?>
                            <script type="text/javascript">
                                //How to automatically redirect to a differnt webpage
                                
                                window.location = "home3.php?page=0";
                            </script>
                            <?php
                        }
                    else
                        {
                            echo"<br><br><br><br>idiot!!!!!";
                        }


                }
            elseif($users_results->rowCount() > 0)
                {


                    $query_pass = "SELECT pass_word FROM users WHERE username = '$user'";
                    $password = $pdo -> query($query_pass);
                    $password = $password->fetch(); //This returns an associative array
                    $password = $password['pass_word'];

                    //password_verify(provided_password, hashed_string)
                    $password = password_verify($pass, $password);

                    if($password) //password_verify() returns 1 if the hash matches the password
                        {


                            if(isset($_SESSION['usr']))
                                {
                                    $q_user = $_SESSION['usr'];
                                    $query_line = "UPDATE clients SET online='offline' WHERE username='$q_user'";
                                    $query_line = $pdo -> query($query_line);
            
                                }
                            elseif(isset($_SESSION['usr_s']))
                                {
                                    $q_user = $_SESSION['usr_s'];
                                    $query_line = "UPDATE users SET on_line='offline' WHERE username='$q_user'";
                                    $query_line = $pdo -> query($query_line);
            
                                }

                            session_destroy(); //This line prevetns the user or client from being online with multiple accounts

                            session_start();
                            $_SESSION['usr_s'] = $user;
                            $_SESSION['pass_s'] = $pass;

                            $q_line = "UPDATE users SET on_line='online' WHERE username='$user'";
                            $q_line = $pdo -> query($q_line);

                            ?>
                            <script type="text/javascript">
                                //How to automatically redirect to a differnt webpage
                                //window.location = "userProfile.php?model=<?php echo $user; ?>";
                                window.location = "userProfile.php";
                            </script>
                            <?php
                        }
                    else
                        {
                            echo"<br><br><br><br>ha ha idiot!!!!!";
                        }


                }
            else
                {
                    echo"<br><br><br><br>wrong entries";
                }
        }
        else
            {
                if(isset($_SESSION['usr']))
                    {
                        $q_user = $_SESSION['usr'];
                        $query_line = "UPDATE clients SET online='offline' WHERE username='$q_user'";
                        $query_line = $pdo -> query($query_line);

                    }
                elseif(isset($_SESSION['usr_s']))
                    {
                        $q_user = $_SESSION['usr_s'];
                        $query_line = "UPDATE users SET on_line='offline' WHERE username='$q_user'";
                        $query_line = $pdo -> query($query_line);

                    }
                session_destroy();
            }

    ?>
        
        <div id="container">
            <form action="login.php" method="post">

                <div class="loginClient">
                    <div id="lg">MINX</div>
                    <input id="usr" type="text" name="username" required placeholder="Username....">

                    <input class="grd" type="password" name="password" required placeholder="Password....">
                    
                    <div class="g">
                        <a href="resetPassword.php">forgot my password</a>
                        <br>
                        <a href="buySeller.php">create an account</a>
                    </div>
                    
                    <button class="dd" type="submit" name="submit">Login</button>
                </div>            
            </form>
        </div>



    </body>
</html>





