

<!DOCTYPE html>
<html>
    <head>
        <link href='createClient.css' rel='stylesheet'>
        <?php
        session_start();
        require_once 'header.php';
        ?>
    </head>
    <body>

    


    <?php


if(isset($_POST["submit"]))
    {


        if (isset($_POST["username"]))
            {
                //Returns to the main sighn in page if the entered username is already taken
                $username= ($_POST["username"]);
                $result = $pdo -> query("SELECT * FROM clients WHERE username='$username'");
                
                    if ($result->rowCount()) 
                        {                                   
                            ?>
                                <script type="text/javascript"> 
                                    history.go(-1)
                                </script>
                            <?php   
                        }
            }
        if(c_Age($_POST["date"]) < 21) // If the age entered is less than 21
            {
                
                ?>
                <script type="text/javascript">
                    history.go(-1)
                </script>
                
                <?php

            }
        if (count($_FILES["file"]["name"]) > 0) // if one of the uploaded pictures has the wrong format
            {
                

                $formats = array('jpg','png','jpeg');


                $f_names = $_FILES["file"]["name"];
                //print_r($pictures);
                foreach($f_names as $file)
                
                    {
                        $format = pathinfo($file, PATHINFO_EXTENSION);
                        
                        if(!in_array($format, $formats))
                            {
                                //echo"heee";
                                
                                ?>
                                <script type="text/javascript">
                                    
                                    alert("only pictures with this formats jpg, png and jpeg are allowed")
                                    history.go(-1)
                                </script>
                                
                                <?php
                            }
                        //When every thing checks out this part of the code executes
                        else
                            {    
                                
                                //CREATING A CLIENT FOLDER AND SAVING PICTURES ON THE SERVER 

                                //Create a directory
                                $folders = scandir("/var/www/html/lynx/");
                                
                                if(!in_array("pictures",$folders))
                                    {
                                        mkdir("/var/www/html/lynx/pictures/");
                                    }
                                    
                                //Creating the picture folder for user
                                $usern = $_POST["username"];
                                mkdir("/var/www/html/lynx/pictures/".$usern."/");
    
                                $targetDir = "/var/www/html/lynx/pictures/".$usern."/";
                                    
                                //$fileName = basename($_FILES["file"]["name"]);
                                $pictures = $_FILES["file"]["name"];
                                //print_r($pictures);
                
                                $key = 0;
                                // Allow certain file formats 
                                $allowTypes = array('jpg','png','jpeg');
    
                                foreach($pictures as $fileName)
                                    {
                                        
                                        $targetFilePath = $targetDir . $fileName; 
                                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                                        move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath);
                                        $key = $key + 1;
                                    }

    
                                //ISERTING DATA INTO THE DATABASE
                                
                                $username = $_POST["username"];
                                $password = $_POST["password"];
                                $hash  = $_POST["password"];
                                $password = password_hash($hash , PASSWORD_DEFAULT); //ecnrypting password
                                $age = $_POST["date"];
                                $district = $_POST["district"];
                                $subscriptionExpDate = "pss";
                                $subscriptionStatus = "pss";
                                $online = "online";
                                $profilePic = $_FILES["file"]["name"][0];

 
                                $stmt = $pdo -> prepare("insert into clients values(?,?,?,?,?,?,?,?)");
                                $stmt -> bindParam(1, $username, PDO::PARAM_STR, 32);
                                $stmt -> bindParam(2, $password, PDO::PARAM_STR, 32);
                                $stmt -> bindParam(3, $age, PDO::PARAM_STR, 32);
                                $stmt -> bindParam(4, $district, PDO::PARAM_STR, 32);
                                $stmt -> bindParam(5, $subscriptionExpDate, PDO::PARAM_STR, 32);
                                $stmt -> bindParam(6, $subscriptionStatus, PDO::PARAM_STR, 32);
                                $stmt -> bindParam(7, $online, PDO::PARAM_STR, 32);
                                $stmt -> bindParam(8, $profilePic, PDO::PARAM_STR, 32);
                                
                                $stmt -> execute([
                                                    $username,
                                                    $password,
                                                    $age,
                                                    $district,
                                                    $subscriptionExpDate,
                                                    $subscriptionStatus,
                                                    $online,
                                                    $profilePic
                                                ]);
                                                //echo "<br><br><br><br><br>heee";


                                                
                                $_SESSION['usr'] = $username;
                                $_SESSION['pass'] = $pass;
                                ?>
                                <script type="text/javascript">
                                    //How to automatically redirect to a differnt webpage
                                    window.location = "home3.php?page=0";
                                </script>
                                <?php


                            }
                    }
            }
        }
?>


<script>

function fyls()
    {
        alert("Upload 3 or more pictures to proceed")
    }

function age_warning()
    {
        alert("Ela hloko hore u TLAMEHILE ho ba lilemo tse mashome a mabeli a motso o mong kapa ho feta ho gnolisa le qhepheng lena.")
    }


function checkuser(usr)   //This will be executed by the onclick parameter
    {

        var slr = new XMLHttpRequest()
        //Creates a new XMLHttpRequest object

        slr.open("POST", "http://localhost:3000/lynx/asynchronous_simple1.php", true)//must not use $_GET method
        //open(method,url,async,user,psw)
        //method: the request type GET or POST
        //url: the file location
        //async: true (asynchronous) or false (synchronous)
        //user: optional user name
        //psw: optional password
        
        slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        //This line is important when submitting forms
        //Adds a label/value pair to the header to be sent
        
        //usr.value
        //v = "n=usrnm"
        v = 'n='+usr.value
        
        slr.send(v)
        //Sends the request to the server
        //send() // used for GET requests
        //send("string") used for POST requests
        //Sends data that needs to be processed to the server as a string containing a variable and a value

        slr.onreadystatechange = function()
        //Defines a function to be called when the readyState property changes

            {
                if( slr.readyState ==4 && slr.status == 200)
                    {
                        document.getElementById("info").innerHTML = slr.responseText
                        //responseText: Returns the response data as a string
                    }
                                        
                    //readyState
                    //Holds the status of the XMLHttpRequest.
                    //0: request not initialized
                    //1: server connection established
                    //2: request received
                    //3: processing request
                    //4: request finished and response is ready

                    //status
                    //Returns the status-number of a request
                    //200: "OK"
                    //403: "Forbidden"
                    //404: "Not Found"
            }
    }


function checkAge(dateOfBirth)
    {
        //entered date values 
        dateOfBirth = dateOfBirth.value
        lis = dateOfBirth.split("-")   
        const year = lis[0]
        const month = lis[1]
        const day = lis[2]

        const date = new Date() //creating a date object
        const currentDay = date.getDate()
        const currentMonth = date.getMonth()
        const currentYear = date.getFullYear()




        if(lis[0] >= currentYear )
            { 
                document.getElementById("age").innerHTML = "Date of birth (21 years and over only!)"
                exit()
            }
        else
            {
                var yearDifference = currentYear - lis[0]
            }


        if( (currentMonth > month) || ( (currentMonth == month) && ( currentDay >= day )))
            {
                age = yearDifference; 
                document.getElementById("age").innerHTML = "Date of birth"
            }
        else
            {
                age = yearDifference-1;     
                document.getElementById("age").innerHTML = "Date of birth"                       
            }
        
        if(age < 21)
            {
                document.getElementById("age").innerHTML = "Date of birth (21 years and over only!)"
            }

    }




</script>






        <div id="container">
            <div id="logo">
                MINX
            </div>
        </div>
        
        <form action="createClient.php" method="post" enctype="multipart/form-data">
            <div class="loginClient">
                <!--<div id="info"></div>-->
                <input id="usr" type="text" name="username" required placeholder="Username...." onBlur="checkuser(this)">
                <input class="grd" type="password" name="password" required placeholder="Password....">
                <label id="age">Date of birth</label>
                <input type="date" name="date" required onBlur="checkAge(this)">
                <label>District</label>
                <select class="sl" name="district">
                    <option value="maseru">Maseru</option>
                    <option value="berea">Berea</option>
                    <option value="buthaButhe">Butha-Buthe</option>
                    <option value="leribe">Leribe</option>
                    <option value="mafeteng">Mafeteng</option>
                    <option value="mohale">Mohale's Hoek</option>
                    <option value="qacha">Qacha's Nek</option>
                    <option value="quthing">Quthing</option>
                    <option value="mokhotlong">Mokhotlong</option>
                    <option value="thabaTseka">Thaba Tseka</option>
                </select>

                <div class="g">
                    I am over the age of 21 and i have fully read and agree to the
                    <a href="tsncs.php"> terms and conditions</a> of this website
                    <input type="checkbox" name="terms" value="agree" required>
                </div>

                <label>Upload a profile picture</label>
                <input class="grd" type="file" name="file[]" required multiple = "multiple">
                <div>
                    <input hidden class="grd" type="text" name="type" value="buyer">
                </div>
                <input class="grd" type="submit" name="submit" value="Create Account">

            </div>    
        </form>
    </body>
</html>





