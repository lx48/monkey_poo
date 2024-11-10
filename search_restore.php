<?php
    require_once 'header.php';
    $usrname = $_SESSION['usr']; //currently logged on user 
    $s_user = $_GET['user']; //The string to be searched for in the database
    $page2 = $_GET['page2']; //reflects the total number of itterations that have been done
    $page2 = 0;
 
?>
  
<!DOCTYPE html>
<html>
    <head>
        <title>minx | profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="callgirls" >
        <meta name="description" content="Seller meet buyer website" >
        <link href="home3.css" rel="stylesheet" type="text/css">
        <script src='http://code.jquery.com/jquery-3.5.1.min.js'></script>
        
        <?php
            $all_girls = "SELECT * FROM users ";
            $all_girls2 = $pdo -> query($all_girls);

            $all_girls1 = $all_girls2 -> rowCount();

            $all_girls = 0; // Reflects the total number of results found
            $new_page = 0; //Determines where the limit value starts based on the position of the first result

            for($s=0; $s<$all_girls1; $s++)
                {
                    $r_gls = $all_girls2 -> fetch();
                    $r_gls = $r_gls['username'];
                    
                    if(preg_match("/{$s_user}/i", $r_gls))
                        {
                            $all_girls =  $all_girls + 1;  
                            $last_user =  $r_gls;                       
                        }
                    else
                        {
                            if($all_girls == 0)
                                {
                                    $new_page = $new_page + 1;
                                }
                        }
                }
                /*
                echo "<br><br><br><br><br><br>";
                echo $all_girls;
                exit();
                */

        ?>
    </head>
    <body>

        <div id="background"></div>

        <div id="profilegrid">

            <div id="hometop">

                <button class="hometopkids" id="fav">
                    <div><div></div></div>
                    <div><img class="topIcons" src="icons/T4.png"></div>
                    <div>favourites</div>
                </button>
                <button class="hometopkids" id="not" >
                    <div id="ren_notifications"></div>
                    <div><img class="topIcons" src="icons/T15.png"></div>
                    <div>notifications</div>
                </button>
                <button class="hometopkids" id="mas">                    
                    <div id="ren_mess"></div>
                    <div><img class="topIcons" src="icons/T12.png"></div>
                    <div>massages</div>
                </button>

            </div>




            <div id="main">                

                <div id="massages_container">
                    
                    <button id="close_msgContainer"><img id="close_msg" src="icons/T3.png"></button>
                    
                    <?php

                    $table = "messages";
                    $usrname = $_SESSION['usr'];
                    $login_username = $usrname;


                    $query = "SELECT * FROM ".$table." WHERE recipient = '".$usrname."'";

                    $list = $pdo -> query($query);
                    $rows = $list->rowCount();                    
                    $m_senders = array();

                    
                    
                    for($i = 0 ; $i<$rows ; $i++ )
                        {
                            $sender = $list -> fetch();   // retunrns an associative array
                            $massage_sender = $sender['sender'];

                            //checking for unread messages
                            $new_q = "SELECT * FROM messages WHERE recipient = '$usrname' AND sender = '$massage_sender' AND status='new'";
                            $new_q = $pdo -> query($new_q);
                            $new_messages = $new_q -> rowCount();


                            //checking wheather this message sender is online
                            $online_query = "SELECT on_line FROM users WHERE username = '$massage_sender'";
                            $rs_line = $pdo -> query($online_query);
                            $row_line = $rs_line -> fetch();
                            $online_status = $row_line['on_line'];
                            

                            if(!in_array($massage_sender, $m_senders))
                                {
                                    $m_senders[] = $massage_sender;
                                    $q2 = "SELECT profilePic FROM users WHERE username='$massage_sender'";
                                    $q2 = $pdo -> query($q2);
                                    $q2 = $q2 -> fetch();
                                    $profile_pic2 = $q2['profilePic'];

                                    ?>

                                    <button class="sender" id="<?php echo ($massage_sender);?>" onclick="get_massages(this)">
                                        <div class="usr_msg" id="profile_pic"><img src="pictures/<?php echo ($massage_sender);?>/<?php echo $profile_pic2;?>" class="pc"></div>
                                        <div class="usr_msg" id="usr_name"><?php echo ($sender['sender']);?></div>
                                        <?php

                                            if($new_messages > 0)
                                                {
                                                    ?>
                                                        <div class="usr_msg" id="new_msg"><?php echo $new_messages." ";?>new</div>
                                                    <?php
                                                }

                                            if($online_status == "yes")
                                                {
                                                    ?>
                                                        <div class="usr_msg" id="lv"></div>
                                                    <?php
                                                }

                                        ?>
                                    </button>
                                    <?php
                                }


                        }


                            ?>
                </div>

                <div id="services">  
                </div>
                
                             
                <div id="msg_div">

                    <div id="inbox_lv"></div>

                    <div id="in_msg">
                    </div>
                    <div id="back_out">
                        <button id="back_2massages" onclick="clear_newMessages2()"><img id="ms_back" src="icons/T2.png"></button>
                        <button id="close_inbox" onclick="clear_newMessages2()"><img id="box_close" src="icons/T3.png"></button>
                    </div>
                    <div id="chat_form">
                        <br />
                        <textarea name="t" id="txt" cols="30" rows="1" placeholder="Send a message....." onkeypress="autoHeigt(this)"  onkeyup="autoHeigt(this)" maxlength="115" ></textarea>
                        <br />
                        <button id="snd" onclick="snd_mss()">send</button>
                    </div>
                </div>


            </div>



            <!--///////////////////////////////////////////////////////////////////////-->


                <div id="homemiddle">
                    <script>
                        last_page = 0; 
                    </script>
                    <?php

                    //How to loop mysql table using the fetch() method
                    //$username = "'Lucy'";
                    /*$last_user = "SELECT * FROM users ORDER BY username DESC";              // you can even use the WHERE statement
                    $last_user = $pdo -> query($last_user);
                    $last_user = $last_user -> fetch();
                    $last_user = $last_user['username'];*/
                    //$last_user = "sss9";


                    $page = $_GET['page'];
                    if($page == 0)
                        {
                            $page = $new_page;
                        }
                    


                    $query = "SELECT * FROM users LIMIT $page,$all_girls1";
                    //$query = "SELECT * FROM users LIMIT $page,12";
                    //$query = "SELECT * FROM users LIMIT 12,12";
                    //$query = "SELECT * FROM users";
                    $result = $pdo -> query($query);                   
                    //$rows = $result->rowCount();
                    //echo $rows;
                    
                    
                    //$skip = 0;
                    //$rows = 1;

                    
                    //$page2 = 0;
                    $search_result = 0;
                    $stop = 0;
                    $limit = $page+12;
                    //$page<$limit: for when the retuned results are more than 12
                    while(($page<$limit) && ($stop == 0) )
                    //for($page ; $page<$limit ; $page++ )
                    //for($i = 0 ; $i<12 ; $i++ )
                        {


                            $list = $result -> fetch();          // retunrns an associative array
                            $username = $list['username'];



                            $string = $username;
                            $needle = $s_user;

                            

                            if(preg_match("/{$needle}/i", $string))
                                {



                            //the the girl value will be further used down the line for ratting a user
                            $girl = $username;
                            $profilePic = $list['profilePic'];
                            $profilePic_path = "pictures/$username/$profilePic";  
                            $verified = $list['verified'];
                            $rating = $list['rating'];



/*
                            if($page2 >= $all_girls)
                            //if($skip)
                                {
                                    ?>
                                        <div class="grids2"></div>
                                        <script>
                                            last_page = 1; 
                                        </script>
                                    <?php
                                }   */  
                                if(1==0)
                                {$del= 1;}                    
                            else
                                {

                                    ?>


                            <a href="client2UserProfile.php?model=<?php echo $username; ?>"> 
                            <div class="grids">

                                <div id="homepic">
                                    <img src="<?php echo $profilePic_path;?>" alt="legs" class="small" >
                                    <div id="ver"></div>
                                </div>                        
                                <div id="homeuser">
                                    <?php echo $username;?>
                                    <div id="legit" style="font-size: 70%;">
                                        &#10004;
                                    </div>
                                </div>

                                <div id="verified">

                                    <div id="vrfy">
                                        <?php echo $verified;?>
                                    </div>

                                    
                                    
                                    <span id="rating" style="font-size: 120%; color: yellow;" >
                                        <?php

                                    if($rating == 1)
                                        {
                                            ?>
                                            &starf;&star;&star;&star;&star;
                                            <?php        
                                        }
                                    elseif($rating == 2)
                                        {
                                            ?>
                                            &starf;&starf;&star;&star;&star;
                                            <?php        
                                        }
                                    elseif($rating == 3)
                                        {
                                            ?>
                                            &starf;&starf;&starf;&star;&star;
                                            <?php   
                                        }
                                    elseif($rating == 4)
                                        {
                                            ?>
                                            &starf;&starf;&starf;&starf;&star;
                                            <?php        
                                        }
                                    elseif($rating == 5)
                                        {
                                            ?>
                                            &starf;&starf;&starf;&starf;&starf;
                                            <?php        
                                        }

                                    ?>
                                    </span>

                                                             
                                </div>
                                
                            </div>
                            </a>

                                    <?php
                                    //if the last result has been reached end the while loop
                                    if( $username == $last_user)
                                        {
                                            $stop = 1;
                                        }
                                }
                            ?>


                            <?php

                                    $search_result = 1;
                                    $page2 = $page2 + 1;
                                    $page = $page + 1;

                                }


                            
                            }    



                            if($search_result == 0)
                                {echo "There were no search results found on $needle";}
                            else
                                {
                                    $page3 = 12 - $page2;
                                    for($i=0; $i<$page3; $i++)
                                        {
                                            if($page >= $all_girls)
                                            //if($skip)
                                                {
                                                    ?>
                                                        <div class="grids2"></div>
                                                        <script>
                                                            last_page = 1; 
                                                        </script>
                                                    <?php
                                                }        
                                        }                                    
                                }
                    
                    //The last page of results has an extra empty grid, this prevents that
                    $page2 = $page2 + 1;

                    ?> 
                    
                    

                </div>
                            
                <div id="homebottom">
                    <div id="previous_page" onclick="previous_page()">Previous</div>
                    <div id="next_page" onclick="next_page()">Next...</div>
                </div>


            <!--///////////////////////////////////////////////////////////////////////-->



            <div id="close_popkids"></div>

            <div class="popKids" id="p_fav">
                <?php
                    $usrname = $_SESSION['usr'];
                    $query_favourites = "SELECT * FROM favourites where client = '$usrname'";
                    $query_favourites = $pdo -> query($query_favourites);
                    $fav_rows = $query_favourites -> rowCount();


                    for($i=0; $fav_rows > $i; $i++)
                        {
                            $grl = $query_favourites -> fetch();
                            $grl = $grl['user'];

                            $q = "SELECT profilePic FROM users WHERE username='$grl'";
                            $q = $pdo -> query($q);
                            $q = $q -> fetch();
                            $profile_pic = $q['profilePic'];

                            ?>
                                <a href="client2UserProfile.php?model=<?php echo $grl; ?>"> 
                                    <div id="fav_pic"><img src="pictures/<?php echo $grl; ?>/<?php echo $profile_pic; ?>" id="f_pic"></div>
                                    <div id="fav_name"><?php echo $grl; ?></div>
                                </a>
                            <?php
                        }

                ?>
            </div>
            
            <div class="popKids" id="p_not">

                <?php
                    //Checking wheather the client has new notifications
                    $usrname = $_SESSION['usr'];
                    $query_notifications = "SELECT * FROM notifications WHERE username='$usrname'";
                    $query_notifications = $pdo -> query($query_notifications);
                    $q_notifications = $query_notifications -> rowCount();
                    if($q_notifications > 0)
                    
                        {
                            for( $i=0; $q_notifications > $i; $i++ )
                                {
                                    $query_notify = $query_notifications -> fetch();
                                    ?>
                                    <div class="notify">
                                        <div id="dayt"><?php echo $query_notify['date']; ?></div>
                                        <div id="n_mass"><?php echo $query_notify['notification']; ?></div>
                                    </div>
                                    <?php
                                }
                        }

                    /*
                    $clear_notifications = "DELETE FROM notifications";
                    $clear_notifications = $pdo -> query($clear_notifications);

                    $seen = "UPDATE notifications SET new='seen' WHERE new='new' AND username='$usrname'";
                    $seen = $pdo -> query($seen);
                    */
                    
                    




                ?>


            </div>

            <div class="popKids" id="p_prof">
                <button class="update_prof">
                    <div><img src="icons/10.png" class="pr_p"></div>
                    <div>upload pictures</div>
                </button>
                <button class="update_prof" id="up_pr">
                    <div><img src="icons/9.png" class="pr_p"></div>
                    <div>edit profile</div>
                </button>
            </div>
                            

        </div>


        <script> 


            
            //javascript goes here.....

            function previous_page()
                {
                    history.go(-1);
                }
            function next_page()
                {
                    if(last_page == 0)
                        {
                            //document.write("<br><br><br><br><br><br>last page")
                            //window.location = "search.php?page=<?/*php echo $page; */?>&page2=<?/*php echo $page2;*/?>";
                            window.location = "search.php?page=<?php echo $page; ?>&page2=<?php echo $page2; ?>&user=<?php echo $s_user; ?>";
                        }
                    //window.location = "home3.php?page=<?php echo $page; ?>";
                }


            function refresh_favourites()
                {

                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/refresh_favourites.php", true)//
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n=1'
                    slr.send(v)
                    slr.onreadystatechange = function()

                        {
                            if( slr.readyState ==4 && slr.status == 200)
                                {

                                    document.getElementById("p_fav").innerHTML = slr.responseText
                                    //document.write("hooooo")
                                    //setTimeout(function(){jQuery("#in_msg").scrollTop(jQuery("#in_msg")[0].scrollHeight) }, 1);
                                    //This line insures that the loaded ayax div is scrolled to the very bottom
                                }
                        }

                }



            function clear_notifications()
                {
                
                    
                    var vlr = new XMLHttpRequest()
                    vlr.open("POST", "http://localhost:3000/lynx/clear_notifications.php", true)//must not use $_GET method
                    vlr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n=1'
                    vlr.send(v)
                }


            function add2_favourites()
                {
                    girl = "<?php echo $girl; ?>"
                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/add2_favourites.php", true)//must not use $_GET method
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n='+girl
                    slr.send(v)
                }
                
            function check_notifications()
                {
                    var vlr = new XMLHttpRequest()
                    vlr.open("POST", "http://localhost:3000/lynx/count_notifications.php", true)//must not use $_GET method
                    vlr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n=1'
                    vlr.send(v)
                    vlr.onreadystatechange = function()

                        {
                            if( vlr.readyState ==4 && vlr.status == 200)
                                {                    
                                    document.getElementById("ren_notifications").innerHTML = vlr.responseText
                                }
                        }
                                                
                }



            function check_messageges()
                            {
                                var vlr = new XMLHttpRequest()
                                vlr.open("POST", "http://localhost:3000/lynx/count_messages.php", true)//must not use $_GET method
                                vlr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                                v = 'n=1'
                                vlr.send(v)
                                vlr.onreadystatechange = function()

                                    {
                                        if( vlr.readyState ==4 && vlr.status == 200)
                                            {                    
                                                document.getElementById("ren_mess").innerHTML = vlr.responseText
                                            }
                                    }
                                                            
                            }

            function clear_newMessages2()
                {
                    
                    var vlr = new XMLHttpRequest()
                    vlr.open("POST", "http://localhost:3000/lynx/clear_newMessages2.php?sender="+message_id, true)//must not use $_GET method
                    vlr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n=1'
                    vlr.send(v)
                    /*vlr.onreadystatechange = function()

                        {
                            if( vlr.readyState ==4 && vlr.status == 200)
                                {                    
                                    document.getElementById("in_msg").innerHTML = vlr.responseText
                                    setTimeout(function(){jQuery("#in_msg").scrollTop(jQuery("#in_msg")[0].scrollHeight) }, 1);
                                    //This line insures that the loaded ayax div is scrolled to the very bottom
                                }
                        }*/
                               
                }

            function snd_mss()
                {

                    var mssg = document.getElementById("txt").value;

                    var vlr = new XMLHttpRequest()
                    //vlr.open("POST", "http://localhost:3000/lynx/chats2.php", true)//must not use $_GET method
                    vlr.open("POST", "http://localhost:3000/lynx/chats2.php?sender="+message_id, true)////The sender value actualy stands for recipient
                    vlr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n='+mssg
                    vlr.send(v)
                    vlr.onreadystatechange = function()

                        {
                            if( vlr.readyState ==4 && vlr.status == 200)
                                {                    
                                    document.getElementById("in_msg").innerHTML = vlr.responseText
                                    setTimeout(function(){jQuery("#in_msg").scrollTop(jQuery("#in_msg")[0].scrollHeight) }, 1);
                                    //This line insures that the loaded ayax div is scrolled to the very bottom
                                }
                        }
                        
                    //The line below resets the textarea to an empty string 
                    document.getElementById("txt").value = "";
                }


            function snd_mss2()
                {

                    var mssg = document.getElementById("txt2").value;

                    var vlr = new XMLHttpRequest()
                    vlr.open("POST", "http://localhost:3000/lynx/chats2_2.php?sender=<?php echo($girl);?>", true)//The sender value actualy stands for recipient
                    vlr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n='+mssg
                    vlr.send(v)
                    vlr.onreadystatechange = function()

                        {
                            if( vlr.readyState ==4 && vlr.status == 200)
                                {   
                                    //document.getElementById("txt2").value = "Your message has been sent....";
                                    //setTimeout(document.getElementById("txt2").value = "Your message has been sent....",2)
                                    setTimeout(document.getElementById("txt2").value = "",2)
                                    //document.getElementById("txt2").value = "sent"
                                    //document.getElementById("txt2").innerHTML = vlr.responseText
                                }
                        }                       
                }


            function get_massages(usr)   //This will be executed by the onclick parameter
                {
                    message_id = usr.id

                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/chats.php", true)//must not use $_GET method
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n='+message_id
                    slr.send(v)
                    slr.onreadystatechange = function()

                        {
                            if( slr.readyState ==4 && slr.status == 200)
                                {
                                    document.getElementById("in_msg").innerHTML = slr.responseText
                                    setTimeout(function(){jQuery("#in_msg").scrollTop(jQuery("#in_msg")[0].scrollHeight) }, 1);
                                    //This line insures that the loaded ayax div is scrolled to the very bottom
                                }
                        }

                }
            
            function rget_massages(usr)   //This will be executed by the onclick parameter
                {

                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/chats.php", true)//must not use $_GET method
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n='+usr
                    slr.send(v)
                    slr.onreadystatechange = function()

                        {
                            if( slr.readyState ==4 && slr.status == 200)
                                {
                                    document.getElementById("in_msg").innerHTML = slr.responseText
                                    setTimeout(function(){jQuery("#in_msg").scrollTop(jQuery("#in_msg")[0].scrollHeight) }, 1);
                                    //This line insures that the loaded ayax div is scrolled to the very bottom
                                }
                        }

                }

            function refresh_massages()

                {

                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/messContainer2.php", true)//
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n=1'
                    slr.send(v)
                    slr.onreadystatechange = function()

                        {
                            if( slr.readyState ==4 && slr.status == 200)
                                {

                                    document.getElementById("massages_container").innerHTML = slr.responseText
                                    //document.write("hooooo")
                                    //setTimeout(function(){jQuery("#in_msg").scrollTop(jQuery("#in_msg")[0].scrollHeight) }, 1);
                                    //This line insures that the loaded ayax div is scrolled to the very bottom
                                }
                        }

                }



            function r_line(usr)

                {
                    var slr = new XMLHttpRequest()
                    slr.open("POST", "http://localhost:3000/lynx/r_line2.php", true)//must not use $_GET method
                    slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                    v = 'n='+usr
                    slr.send(v)
                    slr.onreadystatechange = function()

                        {
                            if( slr.readyState ==4 && slr.status == 200)
                                {
                                    document.getElementById("inbox_lv").innerHTML = slr.responseText
                                }
                        }

                }             



            //jQuery goes inside the curly brackets of this function below
            jQuery(function()
             
                {   

                    setInterval(function(){
                        if(jQuery("#p_fav").is(":visible"))//&& $pdo -> query("SELECT status FROM messages WHERE status = 'uread'") )
                            {
                                refresh_favourites()
                            }
                            },3000)

                    setInterval(function(){
                        if(jQuery("#in_msg").is(":visible"))//&& $pdo -> query("SELECT status FROM messages WHERE status = 'uread'") )
                            {
                                //this keeps reloading the  in_msg id if its visible as to show recently recied messages
                                rget_massages(message_id)
                            }

                            },10000)
                    setInterval(function(){
                        if(jQuery("#massages_container").is(":visible"))//&& $pdo -> query("SELECT status FROM messages WHERE status = 'uread'") )
                            {
                                refresh_massages()
                            }
                            },3000)
                    
                    setInterval(function(){
                        if(jQuery("#not").is(":visible"))//&& $pdo -> query("SELECT status FROM messages WHERE status = 'uread'") )
                            {
                                check_notifications()
                            } 
                            },3000)

                    setInterval(function(){
                        if(jQuery("#p_not").is(":visible"))//&& $pdo -> query("SELECT status FROM messages WHERE status = 'uread'") )
                            {
                                clear_notifications()
                            } 
                            },3000)

                    setInterval(function(){
                        if(jQuery("#mas").is(":visible"))//&& $pdo -> query("SELECT status FROM messages WHERE status = 'uread'") )
                            {
                                check_messageges()
                            } 
                            },3000)
                    
                    setInterval(function(){
                        if(jQuery("#in_msg").is(":visible"))//&& $pdo -> query("SELECT status FROM messages WHERE status = 'uread'") )
                            {
                                r_line(message_id)
                            }
                            },3000)
                      

  







                    //whatsapp for desktop       
                    //jQuery("#WhatsApp").click(function(){window.location = "https://web.whatsapp.com/send?phone=0026658130843"})
                    jQuery("#WhatsApp").click(function(){window.location = "https://api.whatsapp.com/send?phone=<?php echo $whatsapp;?>"})
                    jQuery("#call").click(function(){window.location = "tel:<?php echo $phoneNumber;?>"})


                    jQuery("#add_fav").click(function(){jQuery("#add_fav").hide(20).show(20)})
                    jQuery(".fav_user").click(function(){jQuery("#p_fav").hide()})
                    jQuery("#fav, #not, #pro").click(function(){jQuery("#close_popkids").show()})
                    jQuery("#close_popkids").click(function(){jQuery("#p_fav, #p_not, #p_prof, #close_popkids").hide()})
                    jQuery("#up_pr").click(function(){window.location = "updateProfile.php"})


                    jQuery("#snd2").click(function()
                        {
                            jQuery("#txt2").attr('placeholder','Your massage has been sent...')
                        })

                    //This is statement hides THE CLOSE and BACK buttons from showing while page loads
                    if(jQuery("#services").is(":visible"))
                        {
                            jQuery("#ms_back").toggle()
                            jQuery("#box_close").toggle()
                        }

                    jQuery("#back_out").toggle()
                    jQuery("#mas").click(function(){
                                                        jQuery("#massages_container").toggle()
                                                        jQuery("#services").toggle()
                                                        jQuery("#p_fav, #p_prof, #p_not").hide()
                                                    
                                                        if(jQuery("#in_msg").is(":visible"))
                                                                {
                                                                    jQuery("#in_msg").empty()
                                                                    jQuery("#msg_div").hide()
                                                                    jQuery("#in_msg").hide()
                                                                    jQuery("#massages_container").toggle()
                                                                    jQuery("#back_out").hide()
                                                                }
                                                    }
                                        )



                    jQuery("#massages_container").on("click", "#close_msgContainer", function(){jQuery("#massages_container").toggle()
                                                                jQuery("#services").toggle()})

                    jQuery("#massages_container").on("click", ".sender", function()  {
                                                            jQuery("#massages_container").toggle()
                                                            jQuery("#msg_div").toggle()
                                                            jQuery("#in_msg").toggle()
                                                            jQuery("#back_out").toggle()                                                            
                                                        })


/*                    //This closes the massage container and re-displays the services box 
                    jQuery("#close_msgContainer").click(function(){jQuery("#massages_container").toggle()
                                                                jQuery("#services").toggle()})

                    jQuery(".sender").click(function()  {
                                                            jQuery("#massages_container").toggle()
                                                            jQuery("#msg_div").toggle()
                                                            jQuery("#in_msg").toggle()
                                                            jQuery("#back_out").toggle()                                        
                                                        })
*/                                                      
                    jQuery("#back_2massages").click(function()  {
                                                                    jQuery("#in_msg").empty()
                                                                    jQuery("#msg_div").toggle()
                                                                    jQuery("#in_msg").toggle()
                                                                    jQuery("#massages_container").toggle()
                                                                    jQuery("#back_out").toggle()
                                                                }
                                                    )
                                            

                    jQuery("#close_inbox").click(function(){
                                                                jQuery("#in_msg").empty()
                                                                jQuery("#msg_div").toggle()
                                                                jQuery("#in_msg").toggle()
                                                                jQuery("#services").toggle()
                                                                jQuery("#back_out").toggle()
                                                            }
                                                )
                                                    

                    jQuery("#fav").click(function(){
                                                        jQuery("#p_fav").toggle()
                                                        jQuery("#p_not, #p_prof").hide()
                                                    }
                                        )
                    jQuery("#fav").mouseup(function(){jQuery("#p_fav").hide()})

                    jQuery("#not").click(function(){
                                                        jQuery("#p_not").toggle()
                                                        jQuery("#p_fav, #p_prof").hide()
                                                    }
                                        )

                    jQuery("#pro").click(function(){
                                                        jQuery("#p_prof").toggle()
                                                        jQuery("#p_not, #p_fav").hide()
                                                    }
                                        )

                })

        </script>
        
        
    </body>
</html>

