

<!DOCTYPE html>
<html>
    <head>
        <title>profile</title>
        <meta name="keywords" content="callgirls" >
        <meta name="description" content="Seller meet buyer website" >
        <link href="slider.css" rel="stylesheet" type="text/css">
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
                    $pics = scandir("images/");

                    foreach($pics as $file)
                        {
                            if (($file !== ".") && ($file !== ".."))
                                {
                                    ?>
                                        <img src="images/<?php echo $file;?>" alt="legs" class="pic" >
                                    <?php
                                    
                                }

                        }
                        
                ?>
            </div>
        </div>


        <div class="buttons">
            <button id="p" onclick="p_pic()">prev</button>
            <button id="n" onclick="n_pic()">next</button>
        </div>


        <div class = "pic_names" hidden >
            <?php
                $len = 2; 
                /*
                we are starting from 2 because scandir() returns also current directory(".") and the parent directory("..")
                in [0] and [0] indexes respectively
                */
                $pics = scandir("images/"); 
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

        

        <script>
            
            var len = 0
            s = document.getElementsByClassName("pic_name")
            name_len = s.length      
            
            jQuery(function()
                {
                    jQuery('#n').click(function()
                        {
                            len++
                            if (len == name_len)
                                {
                                    len = 0
                                }

                            jQuery('.images_container').html("<img src='images/"+(s.item(len).innerHTML)+"' alt='legs' class='pic' >")

                        })


                    jQuery('#p').click(function()
                        {
                            len--
                            if (len < 0)
                                {
                                    len = (name_len-1)
                                }

                            if (len == 0)
                                {
                                    len = (name_len-1)
                                }

                            jQuery('.images_container').html("<img src='images/"+(s.item(len).innerHTML)+"' alt='legs' class='pic' >")



                        })

                })



        </script>



    </body>
</html>