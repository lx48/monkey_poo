

<?php
/*
$_POST["n"]
retrieves n's value from the previous file where....  slr.send("n=max")
*/
require_once 'functions.php';
if(isset($_POST['n']))

    {
        $username= ($_POST['n']);
        $result = queryMysql("SELECT * FROM users WHERE username='$username'");
        if ($result->rowCount())
            
            echo "<span class='taken'>&nbsp;&#x2718; "."The username '$username' is taken</span>";
        elseif(($username == "") || ($username == " "))
            {
                $ones= 1;
            }
        else
            echo "<span class='available'>&nbsp;&#x2714; "."The username '$username' is available</span>";
    }

/*    
    {
        echo $_POST['n'];
    }
*/
?>

