


<!DOCTYPE html>
<html>
    <head>
        <title>linx</title>
        <meta name="keywords" content="callgirls" >
        <meta name="description" content="Seller meet buyer website" >
        <link href="clientPage.css" rel="stylesheet" type="text/css">
        <link href="960-Grid-System-master/code/css/960_12_col.css" rel=" stylesheet" type="text/css" >
        <?php
        require_once 'header.php';
        ?>

    </head>
    <body>
        
        <div class="container_12">        
        <?php
/*
            $models = 16;
            $g = "grid_3";
            while($models-- > 0)
                {
         ?>
                    <div class=" <?php echo $g; ?> ">
                        <div class="cv">
                            <div class="inside">
                                <img src="images/sample<?php echo $models;?>.jpg" alt="legs" class="small" >
                                <!--<img src="images/sample15.jpg" alt="legs" class="small">-->
                                <img id="ver" src="images/WhatsApp_icon.png.webp">

                            </div>

                            <div id="username">
                                Vixen_vss
                                <div id="legit" style="font-size: 70%;">
                                    &#10004;
                                </div>
                            </div> 
                            <div class="details">
                                <div id="vrfy">
                                    Verified
                                </div>
                                <span id="rating" style="font-size: 100%; color: yellow;">
                                    &starf;&starf;&starf;&starf;&starf;
                                </span>
                            <!--
                                <span id="rating" style="font-size: 80%; color: white;">
                                    &star;&star;
                                </span>
                            -->
                            </div>
                        </div>
                    </div>
        <?php
                }
*/      ?>


<?php
    $models = 16;
    $g = "grid_3";
    while($models-- > 0)
        {
 ?>
            <div class=" <?php echo $g; ?> ">
                <div class="cv">
                    <div class="inside">
                        <img src="images/sample<?php echo $models;?>.jpg" alt="legs" class="small" >
                        <!--<img src="images/sample15.jpg" alt="legs" class="small">-->
                        <img id="ver" src="images/WhatsApp_icon.png.webp">

                    </div>

                    <div id="username">
                        Vixen_vss
                        <div id="legit" style="font-size: 70%;">
                            &#10004;
                        </div>
                    </div> 
                    <div class="details">
                        <div id="vrfy">
                            Verified
                        </div>
                        <span id="rating" style="font-size: 100%; color: yellow;">
                            &starf;&starf;&starf;&starf;&starf;
                        </span>
                    <!--
                        <span id="rating" style="font-size: 80%; color: white;">
                            &star;&star;
                        </span>
                    -->
                    </div>
                </div>
            </div>
<?php
        }
?>



    </body>
</html>