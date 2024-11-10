

<!DOCTYPE html> <!-- This part of the program creates tables within the lynx database -->
<html>
    <head>
        <title>creating tables</title>
    </head>
    <body>
        <?php

            require_once 'functions.php';

            //minx table
            createTable('users',
                'joined VARCHAR(100),
                username VARCHAR(50),
                pass_word VARCHAR(4000),
                rating VARCHAR(10),
                age VARCHAR(50),
                district VARCHAR(50),
                phoneNumber VARCHAR(50),
                house VARCHAR(50),
                visitClient VARCHAR(50),
                overNight VARCHAR(50),
                serviceCharge VARCHAR(50),
                serviceDiscount VARCHAR(50),
                overNightCharge VARCHAR(50),
                on_line VARCHAR(50),
                whatsapp VARCHAR(50),
                verified VARCHAR(50),
                additionalInfo VARCHAR(4000),
                profilePic VARCHAR(50),
                PRIMARY KEY(username)');

            //clients table
            createTable('clients',
                'username VARCHAR(100),
                password VARCHAR(4000),
                age VARCHAR(100),
                district VARCHAR(100),
                subscriptionExpDate VARCHAR(100),
                subscriptionStatus VARCHAR(100),
                online VARCHAR(100),
                profilePic VARCHAR(100),
                PRIMARY KEY(username)');

            //notifications table
            createTable('notifications',
                'username VARCHAR(16),
                date VARCHAR(16),
                new VARCHAR(16),
                notification VARCHAR(100)');

            //user ratings table
/*            createTable('users_ratings',
                'username VARCHAR(16),
                stars VARCHAR(16),
                clients VARCHAR(100),
                PRIMARY KEY(username)');
*/

            //clients ratings table
            createTable('clients_ratings',
                'username VARCHAR(16),
                date VARCHAR(100),
                user VARCHAR(16),
                stars VARCHAR(16)');

            //clients' favourite users table
            createTable('favourites',
                'client VARCHAR(16),
                user VARCHAR(16)');

            //messages table
            createTable('messages',
                'date VARCHAR(100),
                time VARCHAR(16),
                sender VARCHAR(200),
                recipient VARCHAR(200),
                status VARCHAR(200),
                message VARCHAR(4096)');

/*
            //images table
            createTable('images',
                'username VARCHAR(16),
                filename VARCHAR(16)');
*/
        ?>
    </body>
</html>