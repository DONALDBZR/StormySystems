<?php
// Adding the API that will handle the connection between the web application and the database.
require "../StormySystems.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>
            Stormy Systems
        </title>
        <link rel="stylesheet" href="../Stylesheets/Projects.css" />
        <link
            rel="shortcut icon"
            href="../Images/Logo.ico"
            type="image/x-icon"
        />
    </head>
    <body>
        <!-- Navigation Bar -->
        <nav>
            <div class="Logo">
                <a href="../index.php">
                    <img src="../Images/Logo.png" alt="Logo" class="Logo" />
                </a>
            </div>
            <div class="NavigationBar">
                <a href="../Portfolio/index.php">
                    Portfolio
                </a>
            </div>
            <div class="NavigationBar">
                <a href="../Projects/index.php">
                    Projects
                </a>
            </div>
            <div class="NavigationBar">
                <a href="../Services/index.php">
                    Services
                </a>
            </div>
            <div class="NavigationBar">
                <a href="../ContactUs/index.php">
                    Contact Us
                </a>
            </div>
            <div class="NavigationBar">
                <a href="../Contributors/index.php">
                    Contributor Us
                </a>
            </div>
        </nav>
        <div>
            <!-- Title -->
            <h1 class="Title">
                Projects
            </h1>
            <?php
            // Instantiating Stormy Systems class
            $StormySystems = new StormySystems();
            // The query that will verify if there is any project in the Project table.
            $Query = "SELECT * FROM project";
            $Statement = $StormySystems->Query($Query);
            // Executing the query
            $StormySystems->Execute();
            // Retrieving the query's answer in the Project Result variable.
            $ProjectResult = $StormySystems->ResultSet();
            // Displaying every row by using a for-each loop.
            foreach ($ProjectResult as $Part) {
                echo "<div class='Projects'><div class='ProjectsTitle'><img src='{$Part['ProjectImage']}' alt='{$Part['ProjectName']}' id='ProjectsTitle' /></div><div class='ProjectsDetails'><div class='Name'><h2 id='Name'>Name:</h2><h2 id='ProjectsName'>{$Part['ProjectName']}</h2></div><div class='Description'><h2 id='Description'>Description:</h2><p id='ProjectsDescription'>{$Part['ProjectDescription']}</p></div><div class='Link'><h2 id='Link'>Link:</h2><a href='{$Part['ProjectLink']}' id='ProjectsLink'>{$Part['ProjectName']}</a></div><div class='SourceCodes'><h2 id='SourceCodes'>Source Codes:</h2><a href='{$Part['ProjectSourceCode']}' id='ProjectsSourceCodes'><img src='../Images/GitHub.png' alt='GitHub' class='GitHub' /></a></div></div></div></div>";
            }
            ?>
        </div>
    </body>
</html>
