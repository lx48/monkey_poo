<?php
        session_start();
        require_once "functions.php";
 
        ?>
 
<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="header.css" rel="stylesheet" type="text/css">

        <script src='http://code.jquery.com/jquery-3.5.1.min.js'></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    </head>
    
    <body>

        


        <div id="header">

            <div class="logo">
                MINX
            </div>

            <div id="middle">
                <div id="home">Home</div>
                <div id="login">Login</div>
                <input id="search" type="text" name="search" placeholder="search...">
            </div>
            <!--
            <div id="settings">
                Settings
            </div>
            -->
            <div id="settings">
                <div id="login_pic"></div>
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
                    <img id="email" src="images/a1.webp">
                    <img id="whatsapp" src="images/whatsapp-icon.png">
                </div>

                <div id="flogo">
                    Minx
                </div>
            </div>
        </div>

    </body>
</html>