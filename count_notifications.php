
        <?php
        

session_start();
require_once "functions.php";



$usrname = $_SESSION['usr'];
$query_notifications = "SELECT subscriptionExpDate FROM clients WHERE username='$usrname'";
$query_notifications = $pdo -> query($query_notifications);
$q_notifications = $query_notifications -> fetch();
$q_notifications = $q_notifications['subscriptionExpDate'];
$today = date("jS F Y", time());
$days_left = $q_notifications - $today;
/*echo"<br><br><br><br><br><br>";
echo $days_left;
exit();*/

if($days_left < 4)
    {
        
        $q_seen = "SELECT notification FROM notifications WHERE username ='$usrname' AND notification='Only $days_left day(s) left before you need to renew your subscription'";
        $q_seen = $pdo -> query($q_seen);
        $q_seen = $q_seen -> rowCount();
        //avoids adding the same notification twice
        if($q_seen == 0)
            {
                //This first two lines delete the already existing notifications
                $clear_notifications = "DELETE FROM notifications";
                $clear_notifications = $pdo -> query($clear_notifications);

                $username = $usrname;
                $date  = date("jS F Y", time());
                $new = "new";
                $notification = "Only $days_left day(s) left before you need to renew your subscription";



                $stmt = $pdo -> prepare("insert into notifications values(?,?,?,?)");
                $stmt -> bindParam(1, $username, PDO::PARAM_STR, 32);
                $stmt -> bindParam(2, $date, PDO::PARAM_STR, 32);
                $stmt -> bindParam(3, $new, PDO::PARAM_STR, 32);
                $stmt -> bindParam(4, $notification, PDO::PARAM_STR, 32);
                
                $stmt -> execute([
                                    $username,
                                    $date,
                                    $new,
                                    $notification
                                ]);
            }


    }


if(isset($_POST['n']))
{


        $usrname = $_SESSION['usr'];
        $q2 = "SELECT * FROM notifications WHERE new='new' AND username = '$usrname'";
        $rowws = $pdo -> query($q2);
        $news = $rowws -> rowCount();

        if($news > 0)
            {
                ?>
                <div id="number_not"><?php echo $news;?></div>
                <?php
            }

}

 

        ?>







