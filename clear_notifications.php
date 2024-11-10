

        <?php
        

session_start();
require_once "functions.php";


if(isset($_POST['n']))
{
    $usrname = $_SESSION['usr'];
    $seen = "UPDATE notifications SET new='seen' WHERE new='new' AND username='$usrname'";
    $seen = $pdo -> query($seen);
}


        ?>







