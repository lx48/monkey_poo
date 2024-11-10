
        <?php
        

session_start();
require_once "functions.php";


if(isset($_POST['n']))
{

        $new_pic = $_POST['n'];

        $usrname = $_SESSION['usr_s'];
        $q2 = "SELECT profilePic FROM users WHERE username='$usrname'";
        $rowws = $pdo -> query($q2);
        $rowws = $rowws -> fetch();
        $old_pic = $rowws['profilePic'];


        $q2 = "UPDATE users SET profilePic='$new_pic' WHERE profilePic='$old_pic' AND username = '$usrname'";
        $q2 = $pdo -> query($q2);
        
}


        ?>







