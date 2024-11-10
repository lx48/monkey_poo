


<?php
    session_start();
    require_once "functions.php";
?>

<button id="close_msgContainer"><img id="close_msg" src="icons/T3.png"></button>


<?php

        $table = "messages";
        $usrname = $_SESSION['usr'];
        $query = "SELECT * FROM messages WHERE recipient = '$usrname'";
        $list = $pdo -> query($query);
        $rows = $list->rowCount();                    
        $m_senders = array();

        for($i = 0 ; $i<$rows ; $i++ )
        {
            $sender = $list -> fetch();   // retunrns an associative array
            $massage_sender = $sender['sender'];
                            //checking for unread messages
                            $new_q = "SELECT * FROM messages WHERE recipient = '$usrname' AND sender = '$massage_sender' AND status='new'";
                            $new_q = $pdo -> query($new_q);
                            $new_messages = $new_q -> rowCount();

                            //checking wheather this message sender is online
                            $online_query = "SELECT on_line FROM users WHERE username = '$massage_sender'";
                            $rs_line = $pdo -> query($online_query);
                            $row_line = $rs_line -> fetch();
                            $online_status = $row_line['on_line'];
                            

                            if(!in_array($massage_sender, $m_senders))
                                {
                                    $m_senders[] = $massage_sender;
                                    $q2 = "SELECT profilePic FROM users WHERE username='$massage_sender'";
                                    $q2 = $pdo -> query($q2);
                                    $q2 = $q2 -> fetch();
                                    $profile_pic2 = $q2['profilePic'];

                                    ?>

                                    <button class="sender" id="<?php echo ($massage_sender);?>" onclick="get_massages(this)">
                                        <div class="usr_msg" id="profile_pic"><img src="pictures/<?php echo ($massage_sender);?>/<?php echo $profile_pic2;?>" class="pc"></div>
                                        <div class="usr_msg" id="usr_name"><?php echo ($sender['sender']);?></div>
                                        <?php

                                            if($new_messages > 0)
                                                {
                                                    ?>
                                                        <div class="usr_msg" id="new_msg"><?php echo $new_messages." ";?>new</div>
                                                    <?php
                                                }

                                            if($online_status == "online")
                                                {
                                                    ?>
                                                        <div class="usr_msg" id="lv"></div>
                                                    <?php
                                                }

                                        ?>
                                    </button>

                    <?php


                }


        }
        ?>
