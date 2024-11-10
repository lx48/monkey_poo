<!DOCTYPE html>
<html>
    <head>
        <link href='f.css' rel='stylesheet'>
        <?php
            require_once 'header.php';
        ?>
    </head>
    <body>
        <h1>This is the uploaded picture</h1>
        <?php
        if(!empty($_FILES["file"]["name"])) echo"yehhh<br>";

        $pic = $_FILES["file"]["name"][0];
        print_r($pic); 
        ?>
        <img src="<?php echo($pic); ?>">
    </body>
    
</html>