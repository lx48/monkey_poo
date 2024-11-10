

<!DOCTYPE html>
<html>
    <head>
        <link href='rate_user.css' rel='stylesheet'>
        <?php
        require_once 'header.php';
        login_client($pdo);
        session_start();
        $usern = $_SESSION['usr'];
        $girl = $_GET['model'];
        ?>
    </head>
    <body>






        <div id="container">
        
            <div id="logo">MINX</div>
            <div id="rate">
                <div class="stars_container" id="s1" onclick="rate_1('1')"><img class="stars" src="icons/star-empty-icon.webp"></div>
                <div class="stars_container" id="s2" onclick="rate_2('2')"><img class="stars" src="icons/star-empty-icon.webp"></div>
                <div class="stars_container" id="s3" onclick="rate_3('3')"><img class="stars" src="icons/star-empty-icon.webp"></div>
                <div class="stars_container" id="s4" onclick="rate_4('4')"><img class="stars" src="icons/star-empty-icon.webp"></div>
                <div class="stars_container" id="s5" onclick="rate_5('5')"><img class="stars" src="icons/star-empty-icon.webp"></div>
            </div>
            <div id="note">
                Ha morekisi a sa tshepahalle tumellano efe kapa 
                efe eo le e entseng ka kopo, mofe naleli e lengoe. 
                Ha a tshepahetse mofe tse hlano. Sena se tla thusa 
                ho pepesa baqhekanyetsi.
            </div>
            <div id="submit_rating"><button id="button" onclick="submit_rating(stars)">Submit</button></div>

        </div>
        

        <script>

            function submit_rating(rating)
                {

                    if (rating > 0)
                        {
                            var slr = new XMLHttpRequest()
                            slr.open("POST", "http://localhost:3000/lynx/submit_rating.php?girl=<?php echo $girl; ?>", true)//must not use $_GET method
                            slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                            v = 'n='+rating
                            slr.send(v)

                            history.go(-1)
                        }
                    else
                        {
                            location.reload()
                        }

                }
            function rate_1(star_id)
                {
                    document.getElementById("s1").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s2").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                    document.getElementById("s3").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                    document.getElementById("s4").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                    document.getElementById("s5").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                   
                    //Because stars is not preceeded by var they can be accesed outside this function
                    stars = star_id

                }

            function rate_2(star_id)
                {
                    document.getElementById("s1").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s2").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s3").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                    document.getElementById("s4").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                    document.getElementById("s5").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'                
                    
                    stars = star_id
                }

            function rate_3(star_id)
                {
                    document.getElementById("s1").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s2").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s3").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s4").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                    document.getElementById("s5").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                    
                    stars = star_id
                }

                function rate_4(star_id)
                {
                    document.getElementById("s1").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s2").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s3").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s4").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s5").innerHTML = '<img class="stars" src="icons/star-empty-icon.webp">'
                
                    stars = star_id
                }

            function rate_5(star_id)
                {
                    document.getElementById("s1").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s2").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s3").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s4").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                    document.getElementById("s5").innerHTML = '<img class="stars" src="icons/star-full-icon.webp">'
                
                    stars = star_id
                }
        </script>        

    </body>
</html>





