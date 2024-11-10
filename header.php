    <?php
        session_start();
        require_once "functions.php";
        /*echo time();
        exit();*/
/*
        $tym = time() +60;
        $ss = "UPDATE users SET on_line='$tym' WHERE on_line='offline'";
        $ss = $pdo -> query($ss);
        exit();
*/




        if(isset($_SESSION['usr_s']))
            {
                $login_username = $_SESSION['usr_s'];
                $query_header = "SELECT profilePic FROM users WHERE username='$login_username'";
                $query_header = $pdo -> query($query_header);
                $query_header = $query_header -> fetch();
                $login_profilePic = $query_header['profilePic'];
            }
        elseif(isset($_SESSION['usr']))
            {
                $login_username = $_SESSION['usr'];
                $query_header = "SELECT profilePic FROM clients WHERE username='$login_username'";
                $query_header = $pdo -> query($query_header);
                $query_header = $query_header -> fetch();
                $login_profilePic = $query_header['profilePic'];
            }
            
    ?>



<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="header.css" rel="stylesheet" type="text/css">

        <script src='http://code.jquery.com/jquery-3.5.1.min.js'></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    </head>
    <body onunload="user_set_timestamp()" onload="client_reset_timestamp()">
    <!--<body>-->
        


        <div id="header">

            <a href="http://localhost:3000/lynx/home3.php?page=0" class="logo" >
            
                MINX
            </a>

            <div id="middle">
                
                <a href="http://localhost:3000/lynx/home3.php?page=0" id="home" >Home</a>
        
                <a href="http://localhost:3000/lynx/login.php"id="login">LogOut</a>
                <!--<div id="search_picContainer2"><img id="leave" src="icons/logout.png"></div>-->
                <div id="search_container">
                    <input id="search" type="text" name="search" placeholder="search...">
                    <div id="search_picContainer" onclick="search_user()"><img id="search_icon" src="icons/search4.png"></div>
                </div>
                <!--<div id="search_picContainer"><img id="search_icon" src="icons/settings.png"></div>-->
            </div>

            <div id="settings">
                <div id="login_pic"><img id="login_profilePic" src="pictures/<?php echo $login_username;?>/<?php echo $login_profilePic;?>"></div>
                <div id="login_username"><?php echo $login_username;?></div>
            </div>
             
        </div>
                
        <div id="f1">
            <div id="footer">
                
                <div id="contacts">
                        Contact Us
                </div>
                <div id="email">
    
                    <div>suport@minx.co.ls</div>
                </div>
                <div id="lynks">
                    <img id="email" src="images/a1.webp" onclick="visit()">
                    <img id="whatsapp" src="images/whatsapp-icon.png" onclick="visit2()">
                </div>

                <div id="flogo">
                    Minx
                </div>
            </div>
        </div>

        <?php
            $time = time();
        ?>

        <script>




/*
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
*/
            function client_reset_timestamp()
                {
                    

                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/client_reset_timestamp.php", true)//
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n=1'
                    slr.send(v)
                    vlr.onreadystatechange = function()

                        {
                            if( vlr.readyState ==4 && vlr.status == 200)
                                {     
                                    location.reload()               
                                    //document.getElementById("ren_notifications").innerHTML = vlr.responseText
                                }
                        }

                }




            function user_set_timestamp()
                {

                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/user_set_timestamp.php", true)//
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n=1'
                    slr.send(v)
                }



            //This program keeps looping the DATA BASE's on_line column if the value is on_line or offline it passes 
            //but if the value has a timestamp > than a munite it replaces that value with "offline" but if the timestamp < it passes too

            setInterval(user_status,5000)
            function user_status()
                {

                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/user_online_status.php", true)//
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n=1'
                    slr.send(v)
                } 





            function visit()
                {
                    //window.location = "https://web.facebook.com/groups/7193184900696479/user/100090571609897/"
                }
            function visit2()
                {
                    //window.location = "https://api.whatsapp.com/send?phone=<?php echo '58833979';?>"
                }
                
            function search_user()
                {
                    var s_user = document.getElementById("search").value
                    if(s_user != "")
                        {
                            window.location = "search.php?page=0&page2=0&user="+s_user
                        }
                }
        </script>
    </body>
</html>