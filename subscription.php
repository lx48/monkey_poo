<!DOCTYPE html>
<html>
    <head>
    <link href="subscription.css" rel="stylesheet" type="text/css">
    <?php
        require_once 'header.php';
        ?>
    </head>
    <body>
        <!--
        <p>Mpsa Till Number<br>Ewallt Till Number</p>
        <form action="subConfirm.php" method="post">
            <label>OTP</label>
            <input type="text" name="otp" ><br><br>
            <input type="submit"  value="Send">

        </form>   -->
        
        
        <div id="mainContainer" >
            
            <div id="subscription">subscription</div>
            <div id="body">
                
                Step One
                <br />
                Romela M20.00 ho till number ea mpesa kapa ecocash
                <br />
                <br />
                Step Two
                <br />
                U tla romelloa nomoro ea OTP fonong eo o patetseng ka eona
                
                <br />
                <br />
                <div>
                    mpesa till number: 580023
                </div>
                
                <div>
                    ecocash till number: 255023
                </div>
                
                <div>
                    till name: minx
                </div>

            </div>
            <div id="form">
                <form>
                    <input id="otp" type="text" name="otp" require placeholder="Kenya nomoro ea OTP mona...">
                    <br/>
                    <button id="button">Subscribe</button>
                </form>
            </div>
        </div>
    </body>
</html>