


<?php
session_start();
require_once "functions.php";
?>

<button id="close_msgContainer"><img id="close_msg" src="icons/T3.png"></button>


<?php
if(isset($_POST['n']))
{

$table = "messages";
$usrname = $_SESSION['usr_s'];
$query = "SELECT * FROM ".$table." WHERE recipient = '".$usrname."'";
$list = $pdo -> query($query);
$rows = $list->rowCount();                    
$m_senders = array();

for($i = 0 ; $i<$rows ; $i++ )
    {
        $sender = $list -> fetch();   // retunrns an associative array
        $massage_sender = $sender['sender'];
        if(!in_array($massage_sender, $m_senders))
            {
                $m_senders[] = $massage_sender;
                ?>

                <button class="sender" onclick="get_massages('<?php echo ($massage_sender);?>')">
                    <div class="usr_msg" id="profile_pic"><img src="images/sample15.jpg" class="pc"></div>
                    <div class="usr_msg" id="usr_name"><?php echo ($sender['sender']);?></div>
                    <div class="usr_msg" id="new_msg">3 new</div> 
                </button>

                <?php


            }


    }

}    
        ?>
