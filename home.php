<!DOCTYPE html>
<html>
    <head>
        <title>minx</title>
        <link href='home.css' rel='stylesheet'>
        <?php
            require_once 'header.php';
        ?>
    </head>
    <body>

        <div id="page"></div>

            <div id="homemain">

                <div id="hometop">
                    <div class="hometopkids">
                        <div><div class="number" hidden>2</div></div>
                        <div><img class="topIcons" src="icons/T4.png"></div>
                        <div>favourites</div>
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
                        <div>my profile</div>
                    </div>
                </div>

                <div id="homemiddle">
                <?php
                $grids = 12;
                while($grids-- > 0)
                    {
                ?>
    
                    <div class="grids">

                        <div id="homepic">
                            <!--<img src="images/sample<?php echo $grids;?>.jpg" alt="legs" class="small" >-->
                            <img src="images/sample15.jpg" alt="legs" class="small">
                            <div id="ver"></div>
                        </div>                        
                        <div id="homeuser">
                            Vixen_vss
                            <div id="legit" style="font-size: 70%;">
                                &#10004;
                            </div>
                        </div>
                        <div id="verified">
                            <div id="vrfy">
                                Verified
                            </div>
                            <span id="rating" style="font-size: 100%; color: yellow;">
                                &starf;&starf;&starf;&starf;&starf;
                            </span>
                        </div>
                        
                    </div>
                    <?php
                    }
                    ?> 

                </div>
                
                <div id="homebottom">
                    <div>Previous</div>
                    <div>Next...</div>
                </div>

<!--            <div id="homebottom">
                    <img src="icons/T1.png">
                    <img src="icons/T2.png">
                    <img src="icons/T3.png">
                    <img src="icons/T4.png">
                    <img src="icons/T5.png">
                    <img src="icons/T6.png">
                    <img src="icons/T7.png">
                    <img src="icons/T8.png">
                    <img src="icons/T9.png">
                    <img src="icons/T11.png">
                    <img src="icons/T12.png">
                    <img src="icons/T13.png">
                    <img src="icons/T14.png">
                    <img src="icons/T15.png">
                    <img src="icons/T16.png">
                </div>
-->
        </div>

    </body>
</html>