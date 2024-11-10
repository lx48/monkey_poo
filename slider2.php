<?php
    require_once 'header.php';
    login_client($pdo);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>profile</title>
        <meta name="keywords" content="callgirls" >
        <meta name="description" content="Seller meet buyer website" >
        <link href="slider2.css" rel="stylesheet" type="text/css">
        <link href="960-Grid-System-master/code/css/960_12_col.css" rel=" stylesheet" type="text/css" >
        <script src='http://code.jquery.com/jquery-3.5.1.min.js'></script>

    </head>
    <body>

        <div class="container">
            <div class="images_container">

                <?php
                    /*
                    we are starting from 2 because scandir() also returns the current directory(".") and the parent directory("..")
                    in [0] and [0] indexes respectively
                    */          

                    session_start();
                    $girl = $_GET['model'];
                    //$pics = scandir("images/"); 
                    $pics = scandir("pictures/$girl");    
                    $pics_len = count($pics);
                    $cs = 0;
                    
                    foreach($pics as $file)
                        {
                            if (($file !== ".") && ($file !== ".."))
                                {
                                    $cs++;
                                    if(($pics_len - 2) == $cs)
                                        {
                                            ?>
                                                <img src="pictures/<?php echo $girl;?>/<?php echo $file;?>" alt="legs" class="pic" >
                                            <?php                                            
                                        }
                                    else
                                        {
                                            ?>
                                                <img src="pictures/<?php echo $girl;?>/<?php echo $file;?>" alt="legs" class="pic" hidden>
                                            <?php
                                        }

                                    
                                }

                        }
                        //The line above adds pictures in an element as hidden or else the pictures will
                        //appear ontop of each other so the line below makes sure the first pic is displayed


                        
                ?>
            </div>
            <div class="buttons">
                <button id="p" onclick="p_pic()"><img id="sl_next" src="icons/T2.png"></button>
                <button id="n" onclick="n_pic()"><img id="sl_prev" src="icons/T1.png"></button>
            </div>
            <button id="ex" onclick="change_picture()">
                <div>
                    <img id="sl_ex3" src="icons/T16.png">
                </div>
                set profile picture
            </button>
            <!--
            <button id="sl_v">
                <img id="sl_ex" src="icons/T5.png">
                <div id="sl_vr">erified</div>
            </button>
            -->
            <button id="sl_v2">
                <img id="sl_ex2" src="icons/T8.png">
                exit
            </button>
            <div class = "pic_names" hidden>
                <?php
                    $len = 2; 
                    /*
                    we are starting from 2 because scandir() returns also current directory(".") and the parent directory("..")
                    in [0] and [0] indexes respectively
                    */
                    
                    session_start();
                    $girl = $_GET['model'];

                    //$pics = scandir("images/"); 
                    $pics = scandir("pictures/$girl");
                    foreach($pics as $file)
                        {
                            if (($file !== ".") && ($file !== ".."))
                                {
                                    ?>
                                        <p class="pic_name"><?php echo $file;?></p>
                                    <?php
                                    
                                }

                        }
                        
                ?>

            </div>
        </div>



        <script>
            

            function change_picture()
                {
                    if(len == name_len)
                        {
                            len2 = len -1
                            //document.write(s.item(len2).innerHTML)
                            var prof_picture = s.item(len2).innerHTML

                        }
                    else
                        {
                            //document.write(s.item(len).innerHTML)  
                            var prof_picture = s.item(len).innerHTML                          
                        }
                    
                    
                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/change_profilePic.php", true)//must not use $_GET method
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n='+prof_picture
                    slr.send(v)

                    history.go(-1)

                }




            var len = 1
            s = document.getElementsByClassName("pic_name")
            name_len = s.length                 
            var len = name_len

            jQuery(function()
                {
                    jQuery('#n').click(function()
                        {
                            //len++
                            if ((len == name_len) || (len == (name_len - 1)))
                                {
                                    len = 0
                                }
                            else
                                {
                                    len++
                                }
                            jQuery('.images_container').html("<img src='pictures/<?php echo $girl;?>/"+(s.item(len).innerHTML)+"' alt='legs' class='pic' >")
                            //document.write(s.item(len).innerHTML)
                        })


                    jQuery('#p').click(function()
                        {
                            //document.write(len)
                            //len--

                            
                            if (len == 0)
                                {              
                                    //document.write(name_len)              
                                    len = name_len - 1
                                    //document.write(len) 
                                }

                            else if(len == name_len)
                                {
                                    len = name_len - 2
                                }

                            else
                                {
                                    len--
                                }
                                //document.write(len)
                            jQuery('.images_container').html("<img src='pictures/<?php echo $girl;?>/"+(s.item(len).innerHTML)+"' alt='legs' class='pic' >")
                            /*if (len == 0)
                                {
                                    //document.write(name_len)
                                    len ++
                                }*/
                        })
                        
                    jQuery("#sl_v2").click(function()
                        {
                            history.go(-1)
                            //window.location = "userProfile.php?";
                        })
 
                })



        </script>



    </body>
</html>