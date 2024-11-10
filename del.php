<!DOCTYPE html>
<html>
    <head>
        <link href='del.css' rel='stylesheet'>

        <script src='http://code.jquery.com/jquery-3.5.1.min.js'></script>
    </head>
    <body>
        <button onclick="sc2()">fill</button>
        <!--<button >fill</button>-->
        <div id="container">
            <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div id="here">heeeee  </div>
            <form id="chat_form">
                <br />
                <textarea name="t" id="txt" cols="30" rows="1" placeholder="Send a message....." onkeypress="autoHeigt(this)"  onkeyup="autoHeigt(this)" maxlength="115"></textarea>
                <br />
                <div id="snd">send</div>
            </form>
            <div class="inside"></div>-->
        </div>
        <script>
                /*var sls = document.getElementById("container")
                sls.scrollTop = sls.scrollHeight;*/

                function sc(){ var sls = document.getElementById("container"); sls.scrollTop = sls.scrollHeight;}


                function sc2()   //This will be executed by the onclick parameter

                    {
                        var sls = document.getElementById("container"); sls.scrollTop = sls.scrollHeight;
                        var slr = new XMLHttpRequest()
                        slr.open("POST", "http://localhost:3000/lynx/del2.php", true)//must not use $_GET method
                        slr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                        v = 'n=1'
                        slr.send(v)
                        slr.onreadystatechange = function()

                            {
                                if( slr.readyState ==4 && slr.status == 200)
                                    {
                                        document.getElementById("container").innerHTML = slr.responseText
                                        setTimeout(function(){jQuery("#container").scrollTop(jQuery("#container")[0].scrollHeight) }, 1);
                                        
                                    }
                            }
                            /*var sls = document.getElementById("container"); sls.scrollTop = sls.scrollHeight;*/
                            
                    }
        </script>

    </body>
    
</html>