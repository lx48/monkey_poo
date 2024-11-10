<?php
session_start();
require_once "functions.php";



$username = $_SESSION['usr'];
$girly = $_POST['n'];


//Checking wheather this user is already on my favourites list
$query_favourites = "SELECT * FROM favourites WHERE client = '$username' AND user = '$girly'";
$query_favourites = $pdo -> query($query_favourites);
$query_favourites = $query_favourites -> rowCount();
if($query_favourites == 0)
    {
         
        //ISERTING DATA INTO THE DATABASE
        $stmt = $pdo -> prepare("insert into favourites values(?,?)");
        $stmt -> bindParam(1, $username, PDO::PARAM_STR, 32);
        $stmt -> bindParam(2, $girly, PDO::PARAM_STR, 32);


        $stmt -> execute([
                            $username,
                            $girly,
                        ]);
    }
?>