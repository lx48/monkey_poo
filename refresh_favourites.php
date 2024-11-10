<?php

session_start();
require_once "functions.php";
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