

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
}


        ?>







