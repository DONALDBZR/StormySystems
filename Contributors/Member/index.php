<?php
// Starting session
session_start();
// Adding the API to post the retrieved data to the database
require $_SERVER['DOCUMENT_ROOT'] . "/StormySystems/StormySystems.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>
            Stormy Systems
        </title>
        <link rel="stylesheet" href="http://stormysystem.ddns.net/StormySystems/Stylesheets/UserInterface.css" />
        <link rel="shortcut icon" href="http://stormysystem.ddns.net/StormySystems/Images/Logo.ico" type="image/x-icon" />
    </head>
    <body>
        <!-- Header -->
        <header>
            <div class="Logo">
                <img src="http://stormysystem.ddns.net/StormySystems/Images/Logo.png" alt="Logo" class="Logo">
            </div>
            <!-- Username -->
            <h4>
                <?php echo $_SESSION['UsersUsername']; ?>
            </h4>
            <!-- It will redirect the user to the log out process. -->
            <a href="../Logout/index.php">
                Logout
            </a>
        </header>
        <h1>
            Post
        </h1>
        <!-- Posting Form -->
        <div class="PostingForm">
            <!-- Guide -->
            <h2>
                Posting form
            </h2>
            <p>
                Please fill in this form to be able to post on the Portfolio page!
            </p>
            <form method="post" enctype="multipart/form-data">
                <div class="ImagePoster">
                    <input type="file" name="Image" accept="image/*" id="ImageButton" required>
                    <div id="Image">
                        Choose a file
                    </div>
                </div>
                <input type="text" name="Name" id="Name" placeholder="Name" required>
                <input type="text" name="Description" id="Description" placeholder="Description" required>
                <input type="url" name="Link" id="Link" placeholder="Link" required>
                <input type="url" name="SourceCodeDirectory" id="SourceCodeDirectory" placeholder="Source Code Directory" required>
                <input type="submit" value="Post" id="Post" name="Post">
            </form>
            <?php
            if (isset($_POST['Post'])) {
                $ImageDirectory = "../Images/";
                // Basename function will return the name of the file
                $ImageFile = $ImageDirectory . basename($_FILES["Image"]["name"]);
                // Conditions to post the project!
                if (move_uploaded_file($_FILES["Image"]["tmp_name"], $ImageFile)) {
                    // Project class which will retrieve the form to handle all the storing process
                    class Project {
                        // Image Directory Accessor Method
                        public function getImageDirectory() {
                            return "../Images/" . $_FILES["Image"]["name"];
                        }
                        // Name Accessor Method
                        public function getName() {
                            return $_POST["Name"];
                        }
                        // Description Accessor Method
                        public function getDescription() {
                            return $_POST["Description"];
                        }
                        // Link Accessor Method
                        public function getLink() {
                            return $_POST["Link"];
                        }
                        // Source Code Directory Accessor Method
                        public function getSourceCodeDirectory() {
                            return $_POST["SourceCodeDirectory"];
                        }
                    }
                    // Instantiating Project class 
                    $Project = new Project();
                    $ProjectImage = $Project->getImageDirectory();
                    $ProjectName = $Project->getName();
                    $ProjectDescription = $Project->getDescription();
                    $ProjectLink = $Project->getLink();
                    $ProjectSourceCode = $Project->getSourceCodeDirectory();
                    // Instantiating Stormy Systems class
                    $StormySystems = new StormySystems();
                    // Insertion query for storing the project for later use
                    $Query = "INSERT INTO project (ProjectImage, ProjectName, ProjectDescription, ProjectLink, ProjectSourceCode) VALUES (:ProjectImage, :ProjectName, :ProjectDescription, :ProjectLink, :ProjectSourceCode)";
                    $Statement = $StormySystems->Query($Query);
                    // Binding all the values from the form.
                    $StormySystems->bind(":ProjectImage", $ProjectImage);
                    $StormySystems->bind(":ProjectName", $ProjectName);
                    $StormySystems->bind(":ProjectDescription", $ProjectDescription);
                    $StormySystems->bind(":ProjectLink", $ProjectLink);
                    $StormySystems->bind(":ProjectSourceCode", $ProjectSourceCode);
                    // Executing the query
                    $StormySystems->Execute();
                    $Message = "<h1 class='Success'> The project has been successfully posted! </h1>";
                    echo $Message;
                } else {
                    $Message = "<h1 class='Failure'> The file cannot be uploaded to the server.  Therefore, the project cannot be posted! </h1>";
                    echo $Message;
                }
            }
            ?>
        </div>
    </body>
</html>