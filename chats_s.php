

<?php
session_start();
require_once "functions.php";


if(isset($_POST['n']))
{
        /*echo"<br><br><br><br><br><br>heee";
        echo ($_POST['n']);
        exit();*/
        /*$usrname = "'Lucy'";
        $usrname2 = 'Lucy';
*/
        
        //Some values below have to be double qouted because where they are going to be placed they need to have quotes
        //and every time you place a variable it looses its quotes.

        $table = "messages";

        $usrname = $_SESSION['usr_s'];
        $usrname2 = $_SESSION['usr_s'];
        $sender = $_POST['n'];
        $sender2 = $_POST['n'];

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
                        $q2 = "SELECT profilePic FROM clients WHERE username='$sender2'";
                        $q2 = $pdo -> query($q2);
                        $q2 = $q2 -> fetch();
                        $profile_pic2 = $q2['profilePic'];
                    ?>  
                    <div id="recieved_m">
                        <!--Recieved massages
                        <div class="usr_msg" id="recieved_pic"><img src="images/sample15.jpg" class="pc"></div>-->
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

                        <!--<div class="usr_msg" id="unread">new</div>-->
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







