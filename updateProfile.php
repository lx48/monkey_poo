<?php
    require_once 'header.php';
    login_girl();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href='updateProfile.css' rel='stylesheet'>
        
        <?php
        //require_once 'functions.php';

        session_start();
        $usrr = $_SESSION['usr_s']; 
        $login_username = $usrr;
        ?>
    </head>
    <body>
        <?php

           if(isset($_POST["submit"]))
            {


                //ISERTING DATA INTO THE DATABASE

                $district = $_POST["district"];
                $phone = $_POST["phone"];
                $house = $_POST["house"];
                $houseCall = $_POST["houseCall"];
                $sleepover = $_POST["sleepover"];
                $service = $_POST["oneRound"];
                $twoServices = $_POST["twoRounds"];
                $overNight = $_POST["overNight"];
                //$facebook = $_POST["facebook"];
                $whatsapp = $_POST["whatsapp"];
                $aboutMe = $_POST["aboutMe"];

                $old = "SELECT * FROM users WHERE username='$usrr'";
                $old = $pdo -> query($old);
                $old = $old -> fetch();

                function update_row($row, $column, $new_value, $model, $pdo)
                    {
                        $old_value = $row[$column];
                        $update = "UPDATE users SET $column ='$new_value' WHERE $column = '$old_value' AND username = '$model'";
                        $update = $pdo -> query($update);                
                    }
                
                update_row($old,'district',$district,$usrr,$pdo);
                update_row($old,'phoneNumber',$phone,$usrr,$pdo);
                update_row($old,'house',$house,$usrr,$pdo);
                update_row($old,'visitClient',$houseCall,$usrr,$pdo);
                update_row($old,'overNight',$sleepover,$usrr,$pdo);
                update_row($old,'overNight',$whatsapp,$usrr,$pdo);
                update_row($old,'serviceCharge',$service,$usrr,$pdo);
                update_row($old,'serviceDiscount',$twoServices,$usrr,$pdo);

                update_row($old,'overNightCharge',$overNight,$usrr,$pdo);

                update_row($old,'additionalInfo',$aboutMe,$usrr,$pdo);


                ?>
                <script type="text/javascript">
                    //How to automatically redirect to a differnt webpage
                    window.location = "userProfile.php";
                </script>
                <?php


            }
        ?>

        <div id="background2"></div>

        <div id="container">
            
            <div id="logo">
                MINX
            </div>
            
            <form action="updateProfile.php" method="post">

                    <div class="loginClient">

                        <label>District</label>
                        <?php
                            $query = "SELECT district FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['district'];
                        ?>
                        <input class="grd" type="text" name="district" required value= <?php echo $query;?> >


                        <label>clients can reach you on</label>
                        <?php
                            $query = "SELECT phoneNumber FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['phoneNumber'];
                        ?>
                        <input class="grd" type="text" name="phone" required value=<?php echo $query;?>>
                        
                        

                        <div id="ck">

                        <div class="grd" >ntlo e teng</div>
                        <?php
                            $query = "SELECT house FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['house'];
                            if($query == 'yes')
                                {
                                    ?>
                                    <input type="checkbox" name="house" value="yes" checked>
                                    <?php
                                }
                            else
                                {
                                    ?>
                                    <input type="checkbox" name="house" value="yes">
                                    <?php
                                }
                        ?>
                        
                        <div class="grd">ke tla ho client</div>
                        <?php
                            $query = "SELECT visitClient FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['visitClient'];
                            if($query == 'yes')
                                {
                                    ?>
                                        <input type="checkbox" name="houseCall" value="yes" checked>
                                    <?php
                                }
                            else
                                {
                                    ?>
                                        <input type="checkbox" name="houseCall" value="yes">
                                    <?php
                                }
                        ?>
            
                        <div class="grd">Sleepover</div>
                        <?php
                            $query = "SELECT overNight FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['overNight'];
                            if($query == 'yes')
                                {
                                    ?>
                                        <input type="checkbox" name="sleepover" value="yes" checked>
                                    <?php
                                }
                            else
                                {
                                    ?>
                                        <input type="checkbox" name="sleepover" value="yes" >
                                    <?php
                                }
                        ?>


                        
                        
                        </div> 
                        <!--
                        <label>facebook username</label>
                        <?/*php
                            $query = "SELECT facebook FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['facebook'];
                        */?>
                        <input class="grd" type="text" name="facebook" value=<?/*php echo $query;*/?>>
                        -->            
                        <label>whatsapp number</label>
                        <?php
                            $query = "SELECT whatsapp FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['whatsapp'];
                        ?>
                        <input class="grd" type="text" name="whatsapp" value=<?php echo $query;?>>

                        <label>A Single Service</label>
                        <?php
                            $query = "SELECT serviceCharge FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['serviceCharge'];
                        ?>
                        <input class="grd" type="text" name="oneRound" required value=<?php echo $query;?>>
                        
                        <label>Two Services</label>
                        <?php
                            $query = "SELECT serviceDiscount FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['serviceDiscount'];
                        ?>
                        <input class="grd" type="text" name="twoRounds" required value=<?php echo $query;?>>
                        
                        <label>overNight</label>
                        <?php
                            $query = "SELECT overNightCharge FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['overNightCharge'];
                        ?>
                        <input class="grd" type="text" name="overNight" required value=<?php echo $query;?>>
                        
                        <label>About me</label>
                        <?php
                            $query = "SELECT additionalInfo FROM users WHERE username = '$usrr'";
                            $query = $pdo -> query($query);
                            $query = $query -> fetch();
                            $query = $query['additionalInfo'];
                        ?>
                        <textarea class="grd" id="textAarea" name="aboutMe" placeholder="More about you or the services you offer......." required><?php echo $query;?></textarea>



                        <div>
                        <input hidden class="grd" type="text" name="type" value="seller">
                        </div>
                        <input class="grd" type="submit" name="submit" value="Update Profile">

                    </div>    

                
            </form>

        </div>

    </body>
</html>
<?/*php
                require_once 'footer2.php';*/
        ?>




