
<!DOCTYPE html>
<html>
    <head>
        <link href="massages.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <?php
            $host = 'localhost';
            $database = 'publications';
            $usr = '777';
            $pass = '777';
            
            $chrs = 'utf8mb4';
            $attr = "mysql: host=$host;dbname=$database;charset=$chrs";
            $opts =
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];        
    
            //This line is redundent scince its importing the lines above
            //require_once 'login.php';
            
            //My variables
            $table = "massages";
            
            
            try
                {
                    $pdo = new PDO($attr, $pass, $usr, $opts);
                    //echo"Connection was successful<br><br>";
                }
            catch (PDOException $e)
                {
                    //echo"Connection was not successful:". $e->getMessage()."<br>Error code: ".$e->getCode()."<br><br>";
                    die();
                }


        ?>

    <div id="massages_container">


        <?php
/*

            $usrname = "'Lucy'";
            $query = "SELECT * FROM ".$table." WHERE recipient = ".$usrname; 
            $list = $pdo -> query($query);
            $rows = $list->rowCount();
            //echo ($rows);echo "<br>";
            for($i = 0 ; $i<$rows ; $i++ )
                {
                    $sender = $list -> fetch();   // retunrns an associative array

                    ?>
                    <div class="sender">
                        <div class="usr_msg" id="profile_pic"><img src="images/sample15.jpg" class="pc"></div>
                        <div class="usr_msg" id="usr_name"><?php echo ($sender['sender']);?></div>
                        <div class="usr_msg" id="new_msg">3 new</div> 
                    </div>
                    <?php

                }

*/
        ?>









        <?php

        $usrname = "'Lucy'";
        $usrname2 = 'Lucy';
        //$query = "SELECT * FROM ".$table." WHERE recipient = ".$usrname; 
        $query = "SELECT * FROM ".$table." WHERE recipient = ".$usrname." AND sender='Mike' OR recipient = 'Mike' AND sender=".$usrname;

        $list = $pdo -> query($query);
        $rows = $list->rowCount();
        //echo ($rows);echo "<br>";
        for($i = 0 ; $i<$rows ; $i++ )
            {
                $user = $list -> fetch();   // retunrns an associative array
                //print_r($user);
                if( ($user['sender']) == $usrname2)
                    {
                        ?>


                            <div class="usr_msg" id="sent_pic">You</div>
                            <div class="sent">
                                <div id="massage">
                                    <?php echo ($user['massage']);?>
                                </div> 
                            </div>


                        <?php
                    }
                elseif( ($user['sender']) == "Mike")
                    {
                    ?>    
                        <div class="usr_msg" id="recieved_pic"><img src="images/sample15.jpg" class="pc"></div>
                        <div class="usr_msg" id="unread">new</div>
                        <div class="recieved">
                            <div  id="massage">
                                <?php echo ($user['massage']);?> 
                            </div> 
                        </div>
                    <?php                            
                    }
            }


        ?>

            


</div>



        </div>
    </body>
</html>
