
        <?php
        require_once 'header.php';
        session_start();
        $usern = $_SESSION['usr'];
        $stars = $_POST['n'];
        $girl = $_GET['girl'];
        echo "heeeeeeee";
     
    if(isset($_POST["n"]))
        {
                    
            $query_1 = "SELECT * from clients_ratings WHERE username = '$usern' AND user = '$girl'";
            $query_1 = $pdo -> query($query_1);
            $old_rating = $query_1 -> fetch();
            $old_rating = $old_rating['stars'];
            $query_1 = $query_1 -> rowCount();
            if( $query_1 > 0 )
                {
                    //we replace the existing rating in the table
                    $query = "UPDATE clients_ratings SET stars='$stars' WHERE stars='$old_rating' AND username = '$usern' AND user = '$girl'";
                    $query = $pdo -> query($query);

                }
            else 
                {
                    //we make a new entry
                    $date = date("jS F Y", time());
                    //$stars = '5';

                    
                    $stmt = $pdo -> prepare("insert into clients_ratings values(?,?,?,?)");
                    $stmt -> bindParam(1, $usern, PDO::PARAM_STR, 32);
                    $stmt -> bindParam(2, $date, PDO::PARAM_STR, 32);
                    $stmt -> bindParam(3, $girl, PDO::PARAM_STR, 32);
                    $stmt -> bindParam(4, $stars, PDO::PARAM_STR, 32);
                    
                    $stmt -> execute([
                                        $usern,
                                        $date,
                                        $girl,
                                        $stars,
                                    ]);
                    
                }



                }




//This part of the code updates this user(seller) rating under users table 

$qq1 = "SELECT rating FROM users WHERE username='$girl'";
$qq1 = $pdo -> query($qq1);
$qq1 = $qq1 -> fetch();
$ol_rating = $qq1['rating'];


$qq2 = "SELECT * FROM clients_ratings WHERE user = '$girl'";
$qq2 = $pdo -> query($qq2);
$raters = $qq2 -> rowCount();
$given_stars = 0; 
for($i=0; $i<$raters; $i++)
    {
        $row22 = $qq2 -> fetch();
        $s_value = $row22['stars'];
        $given_stars = $given_stars + $s_value;
    }
$rating = $given_stars / $raters;
$rating = round($rating,0);

$query = "UPDATE users SET rating='$rating' WHERE rating='$ol_rating' AND username='$girl'";
$query = $pdo -> query($query);



        
?>




