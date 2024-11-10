

<!DOCTYPE html>
<html>
    <head>
        <link href='upload_pics.css' rel='stylesheet'>
        <?php
        require_once 'header.php';
        login_girl();
        session_start();
        $usern = $_SESSION['usr_s'];
        $login_username = $usern;

        ?>
    </head>
    <body>

    


    <?php


if(isset($_POST["submit"]))
    {



        if (count($_FILES["file"]["name"]) > 0) // if one of the uploaded pictures has the wrong format
            {
                

                $formats = array('jpg','png','jpeg');


                $f_names = $_FILES["file"]["name"];
                //print_r($pictures);
                foreach($f_names as $file)
                
                    {
                        $format = pathinfo($file, PATHINFO_EXTENSION);
                        
                        if(!in_array($format, $formats))
                            {
                                //echo"heee";
                                
                                ?>
                                <script type="text/javascript">
                                    
                                    alert("only pictures with this formats jpg, png and jpeg are allowed")
                                    history.go(-1)
                                </script>
                                
                                <?php
                            }
                        //When every thing checks out this part of the code executes
                        else
                            {    
                                

                                //$targetDir = "/var/www/html/lynx/pictures/".$usern."/";
                                $targetDir = "/var/www/html/lynx/pictures/".$usern."/";
                                    
                                //$fileName = basename($_FILES["file"]["name"]);
                                $pictures = $_FILES["file"]["name"];
                                //print_r($pictures);
                
                                $key = 0;

    
                                foreach($pictures as $fileName)
                                    {
                                        
                                        $targetFilePath = $targetDir . $fileName; 
                                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                                        move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath);
                                        $key = $key + 1;
                                    }
    

                                ?>
                                <script type="text/javascript">
                                    //How to automatically redirect to a differnt webpage
                                    //window.location = "home2.php";
                                    window.location = "userProfile.php";
                                </script>
                                <?php


                            }
                    }
            }
        }
?>







        <div id="container">

            <div id="logo">
                MINX
            </div>


            <form action="upload_pics.php" method="post" enctype="multipart/form-data">
                <div class="loginClient">

                    <input class="grd" type="file" name="file[]" required multiple = "multiple" id="upload">
                    

                    <input class="grd" type="submit" name="submit" value="upload" id="sbmt">

                </div>    
            </form>

        </div>
        

    </body>
</html>





