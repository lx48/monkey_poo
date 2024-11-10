

<?php
//This file works for both the seller and buyer

session_start();
require_once "functions.php";


if(isset($_POST['n']))
{
        

        $sender = $_POST['n'];

        //first checking wheather the sender is online
        $sender_q = "SELECT on_line FROM users WHERE username = '$sender'";
        $sender_q = $pdo -> query($sender_q);
        $sender_q = $sender_q -> fetch();
        $line_status = $sender_q['on_line'];
        if($line_status == 'online')
            {
                ?>
                    <div id="us_lv"></div>
                <?php
            }


        
    }
?>





