

        <?php
        

session_start();
//echo $_SESSION['usr_s'];
require_once "functions.php";


if(isset($_POST['n']))
{

        
        $table = "messages";

        $recipient = $_GET['sender'];

        //$recipient = "bbb2";
        $sender = $_SESSION['usr_s'];

        //$q2 = "UPDATE messages SET status='old' WHERE status='new' AND recipient = 'sss' AND sender = 'bbb'";
        $q2 = "UPDATE messages SET status='old' WHERE status='new' AND recipient = '$sender' AND sender = '$recipient'";
        $pdo -> query($q2);




        $date = date("jS F Y", time());  //e.g      25th September 2024
        $time = date("g:ia", time());
        $sender = $_SESSION['usr_s'];
        //$recipient = "Mike";
        
        //$recipient = $_GET['sender'];

        //echo $recipient;
        
        /*$sender = "Mike";
        $recipient = "Lucy";*/
        $status = "new";
        $message = $_POST['n'];
        
            
        $stmt = $pdo -> prepare("insert into $table values(?,?,?,?,?,?)");
        $stmt -> bindParam(1, $date, PDO :: PARAM_STR, 128);
        $stmt -> bindParam(2, $time, PDO :: PARAM_STR, 128);
        $stmt -> bindParam(3, $sender, PDO :: PARAM_STR, 128);
        $stmt -> bindParam(4, $recipient, PDO :: PARAM_STR, 128);
        $stmt -> bindParam(5, $status, PDO :: PARAM_STR, 128);
        $stmt -> bindParam(6, $message, PDO :: PARAM_STR, 128);
        $stmt -> execute([$date, $time, $sender, $recipient, $status, $message]);




        $usrname = $_SESSION['usr_s'];
        $usrname = "$usrname";
        $usrname2 = $_SESSION['usr_s'];


        /*$query = "SELECT * FROM ".$table." WHERE recipient = ".$usrname." AND sender='Mike' OR recipient = 'Mike' AND sender=".$usrname;*/
        $query = "SELECT * FROM messages WHERE recipient = '$usrname' AND sender= '$recipient' OR recipient = '$recipient' AND sender='$usrname'";
        
        $list = $pdo -> query($query);
        $rows = $list->rowCount();
        //echo ($query);
        for($i = 0 ; $i<$rows ; $i++ )
            {   
                $user = $list -> fetch();   // retunrns every row as an associative array
                //print_r($user);
                if( ($user['sender']) == $usrname2)
                    {
                        ?>
                        <div id="sent_m">
                            <!-- The massage sent by me -->
                            <div class="usr_msg" id="sent_pic">You</div>
                            <div class="sent">
                                <div id="massage">
                                    <?php echo ($user['message']);?>
                                </div> 
                            </div>
                        </div>

                        <?php
                    }
                elseif( ($user['sender']) == $recipient)
                    {
                    ?>  
                    <div id="recieved_m">
                        <!--Recieved massages-->  
                        <div class="usr_msg" id="recieved_pic"><img src="images/sample15.jpg" class="pc"></div>
                        <div class="usr_msg" id="unread">seen</div>
                        <div class="recieved">
                            <div  id="massage">
                                <!--<br><br><br><br><br><br><br><br>-->
                                <?php echo ($user['message']);?> 
                            </div> 
                        </div>
                    </div>
                    <?php                            
                    }
            }
            ?>

            <?php
        }

        ?>







