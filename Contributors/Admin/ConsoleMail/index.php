<?php
// Starting session
session_start();
// Adding the API that will handle the connection between the web application and the database.
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
        <link rel="stylesheet" href="http://stormysystem.ddns.net/StormySystems/Stylesheets/ConsoleMail.css" />
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
            <a href="http://stormysystem.ddns.net/StormySystems/Contributors/Logout/index.php">
                Logout
            </a>
        </header>
        <h1>
            Mails
        </h1>
        <!-- Display Button -->
        <form method="get" class="Select">
            <input type="submit" value="Display" id="Select" name="Select" />
        </form>
        <!-- Mail Table -->
        <div class="Mails">
            <table>
                <tr>
                    <th id="MailID">
                        ID
                    </th>
                    <th id="MailName">
                        Name
                    </th>
                    <th id="MailEmail">
                        Email
                    </th>
                    <th id="MailMessage">
                        Message
                    </th>
                </tr>
                <?php
                if (isset($_GET['Select'])) {
                    // Instantiating Stormy Systems class
                    $StormySystems = new StormySystems();
                    // The query that will verify if there is any mail in the Mail table.
                    $MailQuery = "SELECT * FROM mail";
                    $Statement = $StormySystems->Query($MailQuery);
                    // Executing the query
                    $StormySystems->Execute();
                    // Retrieving the query's answer in the Mail Result variable.
                    $MailResult = $StormySystems->ResultSet();
                    // Displaying every row by using a for-each loop.
                    foreach ($MailResult as $Row) {
                        echo "<tr><td>" . $Row['MailID'] . "</td><td>" . $Row['MailName'] . "</td><td>" . $Row['MailEmail'] . "</td><td>" . $Row['MailMessage'] . "</td></tr>";
                    }
                }
                ?>
            </table>
        </div>
        <!-- Form to delete mails from the database -->
        <div class="DeleteForm">
            <form method="post" class="Delete">
                <!-- Guide -->
                <h2>
                    Deletion form
                </h2>
                <p>
                    Use this form to make changes to the database!
                </p>
                <input type="text" name="ID" id="ID" placeholder="Enter the Mail ID to be deleted">
                <input type="submit" value="Delete" id="Delete" name="Delete" />
                <?php
                // Delete class which will retrive the values from the Delete post for be handled.
                class Delete {
                    // ID Accessor Method
                    function getID() {
                        return $_POST['ID'];
                    }
                }
                if (isset($_POST['Delete'])) {
                    // Instantiating Delete class
                    $Mail = new Delete();
                    $MailID = $Mail->getID();
                    // Instantiating Stormy Systems class
                    $StormySystems = new StormySystems();
                    // The query that will delete the mail which is associated to the value entered.
                    $MailDeleteQuery = "DELETE FROM mail WHERE MailID = :MailID";
                    $Statement = $StormySystems->Query($MailDeleteQuery);
                    // Binding all the values
                    $StormySystems->bind(":MailID", $MailID);
                    // Executing the query
                    $StormySystems->Execute();
                }
                ?>
            </form>
        </div>
    </body>
</html>