<?php
//Before registering any user first make sure that its name does not already exist in the database
//require_once 'functions.php';


if($_POST["type"] == "seller")
    {
        echo"We are registering a seller <br>";
        
        $username        =        $_POST['username'];
        $password        =        $_POST['password'];
        $age             =            $_POST['date'];
        $district        =        $_POST['district'];
        $phoneNumber     =     $_POST['phoneNumber'];
        $house           =           $_POST['house'];
        $visitClient     =     $_POST['visitClient'];
        $serviceCharge   =   $_POST['serviceCharge'];
        $serviceDiscount = $_POST['serviceDiscount'];
        $overNight       =       $_POST['overNight'];
        $overNightCharge = $_POST['overNightCharge'];
        $additionalInfo  =  $_POST['additionalInfo'];



        //Password
        $password = password_hash($password , PASSWORD_DEFAULT);
        
        //Age
        list($year, $month, $day) = explode("-", $age);
        $yearDifference = date('Y') - $year;
        if( (date("m") > $month) || ( (date("m") == $month) && ( date("d") >= $day )))
            {
                $age = $yearDifference;
            }
        else
            {
                $age = $yearDifference-1;            
            }

        
        //writting to the dataframe
        $stmt = $pdo -> prepare("insert into $table values(?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt -> bindParam(1, $username, PDO::PARAM_STR, 32);
        $stmt -> bindParam(2, $password, PDO::PARAM_STR, 32);
        $stmt -> bindParam(3, $age, PDO::PARAM_INT, );
        $stmt -> bindParam(4, $district, PDO::PARAM_STR, 32);
        $stmt -> bindParam(5, $phoneNumber, PDO::PARAM_INT, );
        $stmt -> bindParam(6, $house, PDO::PARAM_STR, 32);
        $stmt -> bindParam(7, $visitClient, PDO::PARAM_STR, 32);
        $stmt -> bindParam(8, $overNight, PDO::PARAM_STR, 32);
        $stmt -> bindParam(9, $serviceCharge, PDO::PARAM_INT, );
        $stmt -> bindParam(10, $serviceDiscount, PDO::PARAM_INT, );
        $stmt -> bindParam(11, $overNightCharge, PDO::PARAM_INT, );
        $stmt -> bindParam(12, $additionalInfo, PDO::PARAM_STR, 1000);
        $stmt -> execute([$username, $password, $age, $district, $phoneNumber, $house, $visitClient, $overNight, $serviceCharge, $serviceDiscount, $overNightCharge, $additionalInfo]);
        




    }
else
    {
        echo "We are registering a client";

        
        $username        =        $_POST['username'];
        $password        =        $_POST['password'];
        $age             =            $_POST['date'];
        $district        =        $_POST['district'];


        //Password
        $password = password_hash($password , PASSWORD_DEFAULT);
        
        //Age
        list($year, $month, $day) = explode("-", $age);
        $yearDifference = date('Y') - $year;
        if( (date("m") > $month) || ( (date("m") == $month) && ( date("d") >= $day )))
            {
                $age = $yearDifference;
            }
        else
            {
                $age = $yearDifference-1;            
            }

        
        //writting to the dataframe
        $stmt = $pdo -> prepare("insert into $table values(?,?,?,?)");
        $stmt -> bindParam(1, $username, PDO::PARAM_STR, 32);
        $stmt -> bindParam(2, $password, PDO::PARAM_STR, 32);
        $stmt -> bindParam(3, $age, PDO::PARAM_INT, );
        $stmt -> bindParam(4, $district, PDO::PARAM_STR, 32);
        $stmt -> execute([$username, $password, $age, $district]);

    }
?>