<?php
// Starting session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>
            Stormy Systems
        </title>
        <link rel="stylesheet" href="http://stormysystem.ddns.net/StormySystems/Stylesheets/Console.css" />
        <link rel="shortcut icon" href="http://stormysystem.ddns.net/StormySystems/Images/Logo.ico" type="image/x-icon" />
    </head>
    <body>
        <!-- Header -->
        <header>
            <div class="Logo">
                <img src="http://stormysystem.ddns.net/StormySystems/Images/Logo.png" alt="Logo" class="Logo">
            </div>
        </header>
        <!-- Navigation Bar -->
        <nav>
            <!-- Welcoming Message -->
            <h4>
                Welcome, <?php echo $_SESSION['UsersUsername']; ?>
            </h4>
            <!-- It will redirect the user to the log out process. -->
            <a href="http://stormysystem.ddns.net/StormySystems/Contributors/Logout/index.php">
                Logout
            </a>
        </nav>
        <!-- Guide -->
        <h1>
            To access the website and the database, please click on the links below!
        </h1>
        <!-- Console Buttons -->
        <div class="ConsoleRedirectingButtons">
            <a href="./ConsoleMail/index.php">
                Mails
            </a>
            <a href="./ConsoleUser/index.php">
                Users
            </a>
            <a href="../Member/index.php">
                Contributor
            </a>
        </div>
    </body>
</html>