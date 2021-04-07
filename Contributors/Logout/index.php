<?php
// Starting Logout session
session_start();
// Ending session
session_destroy();
// Messages
$LogOut = "<h1 class='Success'> You have been successfully logged out from the site! </h1>";
// Buttons
$Options = "<div class='Button'><a href='http://stormysystem.ddns.net/StormySystems/index.php'> Home </a><a href='http://stormysystem.ddns.net/StormySystems/Contributors/Login/index.php'> Login </a></div>";
?>
<!-- Front-End Page -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Stormy Systems
        </title>
        <link rel="stylesheet" href="http://stormysystem.ddns.net/StormySystems/Stylesheets/Logout.css" />
    </head>
    <body>
        <!-- Header -->
        <header>
            <!-- Logo -->
            <img src="http://stormysystem.ddns.net/StormySystems/Images/Logo.png" alt="Logo" class="Logo">
        </header>
        <!-- Contents -->
        <div class="Contents">
            <?php
            echo $LogOut;
            echo "<br>";
            echo $Options;
            ?>
        </div>
    </body>
</html>