

<!DOCTYPE html>
<html>
    <head>
        <link href='createSeller.css' rel='stylesheet'>
        <?php
            session_start();
            require_once 'header.php';
        ?>
    </head>
    <body>    

        <!--<div class="errors" id="age_error"><img id="age_error" src="icons/exclamation.png"></div>-->
        <!--<div class="errors" id="age_error" >!</div>
        <div class="errors" id="pic_error" >!</div>-->



        <?php

            //$pics = "";

            if(isset($_POST["submit"]))
                {
                        

                    if (count($_FILES["file"]["name"]) < 3)   // if less than 3 pictures were uploaded
                    {
                        
                        ?>
                        <script type="text/javascript"> 
                            history.go(-1)
                        </script>
                        
                        <?php
                        
                    }
                    if (isset($_POST["username"]))
                        {
                            //Returns to the main sighn in page if the entered username is already taken
                            $username= ($_POST["username"]);
                            $result = $pdo -> query("SELECT * FROM users WHERE username='$username'");
                            
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
                    if (count($_FILES["file"]["name"]) > 2) // if one of the uploaded pictures has the wrong format
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
                                            //CREATING A USER FOLDER AND SAVING PICTURES ON THE SERVER 

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
                                            $joined = date("jS F Y", time());
                                            $username = $_POST["username"];
                                            $password = $_POST["password"];
                                            $hash  = $_POST["password"];
                                            $password = password_hash($hash , PASSWORD_DEFAULT); //ecnrypting password
                                            $rating = "5";
                                            $age = $_POST["date"];
                                            $district = $_POST["district"];
                                            $phone = $_POST["phone"];

                                            $house = $_POST["house"];
                                            if($house != "yes")
                                                {
                                                    $house = "no";
                                                }
                                            $houseCall = $_POST["houseCall"];
                                            if($houseCall != "yes")
                                            {
                                                $houseCall = "no";
                                            }
                                            $sleepover = $_POST["sleepover"];
                                            if($sleepover != "yes")
                                            {
                                                $sleepover = "no";
                                            }

                                            $service = $_POST["service"];
                                            $twoServices = $_POST["twoServices"];
                                            $overNight = $_POST["overNight"];
                                            $online = "online";
                                            $whatsapp = $_POST["whatsapp"];
                                            $verified = "unverified";
                                            $aboutMe = $_POST["aboutMe"];
                                            $profilePic = $_FILES["file"]["name"][0];


                                            $stmt = $pdo -> prepare("insert into users values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                            $stmt -> bindParam(1, $joined, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(2, $username, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(3, $password, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(4, $rating, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(5, $age, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(6, $district, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(7, $phone, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(8, $house, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(9, $houseCall, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(10, $sleepover, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(11, $service, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(12, $twoServices, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(13, $online, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(14, $whatsapp, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(15, $verified, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(16, $aboutMe, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(17, $profilePic, PDO::PARAM_STR, 32);
                                            $stmt -> bindParam(18, $password, PDO::PARAM_STR, 32);
                                            
                                            
                                            $stmt -> execute([
                                                                $joined,
                                                                $username,
                                                                $password,
                                                                $rating,
                                                                $age,
                                                                $district,
                                                                $phone,
                                                                $house,
                                                                $houseCall,
                                                                $sleepover,
                                                                $service,
                                                                $twoServices,
                                                                $overNight,
                                                                $online,
                                                                $whatsapp,
                                                                $verified,
                                                                $aboutMe,
                                                                $profilePic
                                                            ]);

                                                            $usern = 'minx';
                                                            $date = date("jS F Y", time());
                                                            $girl = $username;
                                                            $stars = '5';
                                        
                                                            
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




                                            $_SESSION['usr_s'] = $username;

                                            ?>
                                            <script type="text/javascript">
                                                document.write(<?php echo $user?>)
                                                //How to automatically redirect to a differnt webpage
                                                window.location = "userProfile.php?";
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

                



        <div id="container"><div id="logo">MINX</div></div>
        
        <form action="createSeller.php" method="post" enctype="multipart/form-data">
        
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

                <label>clients can reach you on</label>
                <input class="grd" type="text" name="phone" required placeholder="8 digits phone number">
                
                
                

                <div id="ck">

                    <div class="grd" >ntlo e teng</div>
                    <input type="checkbox" name="house" value="yes" >
                    <div class="grd">ke tla ho client</div>
                    <input type="checkbox" name="houseCall" value="yes">            
                    <div class="grd">Sleepover</div>
                    <input type="checkbox" name="sleepover" value="yes" >
                    
                </div>

                <!--
                <label>facebook username</label>
                <input class="grd" type="text" name="facebook" placeholder="Optional....">
                -->
                
                <label>whatsapp number</label>
                <input class="grd" type="text" name="whatsapp" placeholder="Optional....">

                <label>A Single Service</label>
                <input class="grd" type="text" name="service" required>
                
                <label>Two Services</label>
                <input class="grd" type="text" name="twoServices" required>
                
                <label>overNight</label>
                <input class="grd" type="text" name="overNight" required>
                
                <label>About me</label>
                <textarea class="grd" id="textAarea" name="aboutMe" placeholder="More about you or the services you offer......."></textarea>

                <div class="g">
                    I am over the age of 21 and i have fully read and agree to the
                    <a href="tsncs.php"> terms and conditions</a> of this website
                    <input type="checkbox" name="terms" value="agree" required>
                </div>

                <label id="picture_error">Upload pictures</label>
                <input class="grd" id="fs" type="file" name="file[]" multiple = "multiple" required onclick="fyls(this)" onchange="cc(this)" >
                
                <div>
                    <input hidden class="grd" type="text" name="type" value="seller">
                </div>
                <input class="grd" type="submit" name="submit" value="Create Account">

            </div>        
        </form>
    </body>
</html>



 

