

<?php
session_start();
require_once "functions.php";


if(isset($_POST['n']))
{
        //Some values below have to be double qouted because where they are going to be placed they need to have quotes
        //and every time you place a variable it looses its quotes.

        $table = "messages";

        $usrname = $_SESSION['usr'];
        //$usrname = "$usrname";
        $usrname2 = $_SESSION['usr'];

        $sender = $_POST['n'];
        //$sender = "$sender";
        $sender2 = $_POST['n'];

        
        //$query = "SELECT * FROM ".$table." WHERE recipient = ".$usrname." AND sender='Mike' OR recipient = 'Mike' AND sender=".$usrname;
        $query = "SELECT * FROM messages WHERE recipient = '$usrname' AND sender = '$sender' OR recipient = '$sender' AND sender='$usrname'";

        $list = $pdo -> query($query);
        $rows = $list->rowCount();
        //echo $rows;
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
                elseif($user['sender'] == $sender2)
                    {
                        $q2 = "SELECT profilePic FROM users WHERE username='$sender2'";
                        $q2 = $pdo -> query($q2);
                        $q2 = $q2 -> fetch();
                        $profile_pic2 = $q2['profilePic'];
                    ?>  
                    <div id="recieved_m">
                        <!--Recieved massages-->  
                        <div class="usr_msg" id="recieved_pic"><img src="pictures/<?php echo $sender2;?>/<?php echo $profile_pic2;?>" class="pc"></div>
                        

                        <?php
                            if(($user['recipient'] == $usrname && $user['sender'] == $sender) && ($user['status'] == 'new'))
                                {
                                    ?>
                                        <div class="usr_msg" id="unread"><?php echo ($user['status']);?></div>
                                    <?php
                                }
                            else
                                {
                                    ?>
                                        <div class="usr_msg" id="unread2">seen</div>
                                    <?php
                                }
                        ?>

                        <!--<div class="usr_msg" id="unread"><?php echo ($user['status']);?></div>-->
                        
                        
                        <div class="recieved">
                            <div  id="massage">
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







