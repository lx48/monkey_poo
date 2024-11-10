
        <?php
        

session_start();
//echo $_SESSION['usr_s'];
require_once "functions.php";


if(isset($_POST['n']))
{

        
        $table = "messages";

        $recipient = $_GET['sender'];

        //$recipient = "bbb2";
        $usrname = $_SESSION['usr_s'];

        //$q2 = "UPDATE messages SET status='old' WHERE status='new' AND recipient = 'sss' AND sender = 'bbb'";
        $q2 = "SELECT * FROM messages WHERE status='new' AND recipient = '$usrname'";
        $rowws = $pdo -> query($q2);
        $news = $rowws -> rowCount();

        if($news > 0)
            {
                ?>
                <div id="number_mess"><?php echo $news;?></div>
                <?php
            }

}


        ?>







