<?php
    session_start();
    $sn = $_SESSION['usr'];
    require_once 'header.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>minx</title>
        <link href='home2.css' rel='stylesheet'>

    </head>
    <body>

        <div id="page"></div>

        <div id="homemain">

            <div id="hometop">
                <div class="hometopkids">
                    <div><div class="number" hidden>2</div></div>
                    <div><img class="topIcons" src="icons/T4.png"></div>
                    <div><div>favourites</div></div>
                </div>

                <div class="hometopkids">
                    <div><div class="number" hidden>2</div></div>
                    <div><img class="topIcons" src="icons/T15.png"></div>
                    <div>notifications</div>
                </div>

                <div class="hometopkids">                        
                    <div><div class="number" n>8</div></div>
                    <div><img class="topIcons" src="icons/T12.png"></div>
                    <div>massages</div>
                </div>

                <div class="hometopkids">
                    <div><div class="number" hidden>2</div></div>
                    <div><img class="topIcons" src="icons/3.png"></div>
                    <div>edit profile</div>
                </div>
            </div>

            <div id="homemiddle">
                <?php

                //How to loop mysql table using the fetch() method
                //$username = "'Lucy'";
                $query = "SELECT * FROM users";               // you can even use the WHERE statement
                $result = $pdo -> query($query);                   
                $rows = $result->rowCount();
                /*for($i = 0 ; $i<$rows ; $i++ )*/
                for($i = 0 ; $i<$rows ; $i++ )
                    {
                        $list = $result -> fetch();          // retunrns an associative array
                        $username = $list['username'];
                        $profilePic = $list['profilePic'];
                        $profilePic_path = "pictures/$username/$profilePic";  
                        $verified = $list['verified'];

                    /*}*/

                    {
                ?>

                <a href="client2UserProfile.php?model=<?php echo $username; ?>"> 
                <div class="grids">

                    <div id="homepic">
                        <img src="<?php echo $profilePic_path;?>" alt="legs" class="small" >
                        <!--<img src="images/sample15.jpg" alt="legs" class="small">-->
                        <div id="ver"></div>
                    </div>                        
                    <div id="homeuser">
                        <?php echo $username;?>
                        <div id="legit" style="font-size: 70%;">
                            &#10004;
                        </div>
                    </div>
                    <div id="verified">
                        <div id="vrfy">
                        <?php echo $verified;?>
                            
                        </div>
                        <span id="rating" style="font-size: 100%; color: yellow;">
                            &starf;&starf;&starf;&starf;&starf;
                        </span>
                    </div>
                    
                </div>
                </a>
                <?php
                }
                }?> 

            </div>
            
            <div id="homebottom">
                <div>Previous</div>
                <div>Next...</div>
            </div>

        </div>

    </body>
</html>