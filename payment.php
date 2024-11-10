

<!DOCTYPE html>
<html>
    <head>
        <link href='createClient.css' rel='stylesheet'>
    </head>
    <body>
        <p>
            creating an account as a client
        </p>
        <br>

<div class="loginClient">


        <form action="subscription.php" method="post">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Username"><br><br>
            <label>Password</label>
            <input type="text" name="password" required placeholder="Password"><br><br>
            <label>Date of birth</label>
            <input type="date" name="date" required><br><br><br>

            <label>District</label>
            <select name="district">
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
            <br><br><br>

            <!--
            <label>mpsa</label>
            <input type="radio" name="network" value="vodacom" checked>
            <label>ewallt</label>
            <input type="radio" name="network" value="econet" ><br><br><br>
            <label>Nomoro eo o tlo patala ka eona</label><br><br>
            <input type="text" name="code" value="+266" size="3px">
            <input type="text" name="phone" required placeholder="8 digits phone number"><br><br>
-->

            <label>Upload a profile picture</label><br>
            <input type="file" name="profilePic" ><br><br>
            <p>I am over the age of 21 and i have fully read and agree to the <a href="tsncs.php">terms and conditions</a> of this website<input type="checkbox" name="terms" value="agree"></p>
            <input type="text" name="type" value="buyer" hidden><br><br><br>
            <input type="submit" name="submit" value="Subscribe">

        </form>


</div>



    </body>
</html>





