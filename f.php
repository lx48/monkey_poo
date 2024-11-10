<!DOCTYPE html>
<html>
    <head>
        <link href='f.css' rel='stylesheet'>
        <?php
            require_once 'header.php';
        ?>
    </head>
    <body>
        <form action="f2.php" method="post"">
            <label>username</label>
            <input type="text">
            <label><br><br>Upload a picture<br /></label>
            <input type="file" name="pic">
            <br />

            <input type="submit" name="submit" value="Upload">
        </form>
    </body>
    
</html>