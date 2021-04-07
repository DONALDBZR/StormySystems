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
        <link rel="stylesheet" href="http://stormysystem.ddns.net/StormySystems/Stylesheets/ConsoleUser.css" />
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
            Users
        </h1>
        <!-- Display Button -->
        <form method="get" class="Select">
            <input type="submit" value="Display" id="Select" name="Select" />
        </form>
        <!-- User Table -->
        <div class="Users">
            <table>
                <tr>
                    <th>
                        Username
                    </th>
                    <th>
                        First Name
                    </th>
                    <th>
                        Last Name
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Password
                    </th>
                </tr>
                <?php
                if (isset($_GET['Select'])) {
                    // Instantiating Stormy Systems class
                    $StormySystems = new StormySystems();
                    // The query that will verify if there is any user registered in the user table.
                    $UserQuery = "SELECT * FROM users";
                    $Statement = $StormySystems->Query($UserQuery);
                    // Executing the query
                    $StormySystems->Execute();
                    // Retrieving the query's answer in the User Result variable.
                    $UserResult = $StormySystems->ResultSet();
                    // Displaying every row of the database by using a for-each loop.
                    foreach ($UserResult as $Row) {
                        echo "<tr><td>" . $Row['UsersUsername'] . "</td><td>" . $Row['UsersFirstName'] . "</td><td>" . $Row['UsersLastName'] . "</td><td>" . $Row['UsersType'] . "</td><td>" . $Row['UsersEmail'] . "</td><td>" . $Row['UsersPassword'] . "</td></tr>";
                    }
                }
                ?>
            </table>
        </div>
        <div class="Forms">
            <!-- Form to delete users from the database -->
            <div class="DeleteForm">
                <form method="post" class="Delete">
                    <!-- Guide -->
                    <h2>
                        Deletion Form
                    </h2>
                    <p>
                        Use this form to make changes to the database!
                    </p>
                    <input type="text" name="Username" id="Username" placeholder="Enter the Username to be deleted!">
                    <input type="submit" value="Delete" id="Delete" name="Delete" />
                    <?php
                    // Delete class which will retrive the values from the Delete form for be handled.
                    class Delete {
                        // Username Accessor Method
                        function getUsername() {
                            return $_POST['Username'];
                        }
                    }
                    if (isset($_POST['Delete'])) {
                        // Instantiating Delete class
                        $User = new Delete();
                        $UsersUsername = $User->getUsername();
                        // Instantiating Stormy Systems class
                        $StormySystems = new StormySystems();
                        // The query that will delete the user which is associated to the value entered.
                        $UserDeleteQuery = "DELETE FROM users WHERE UsersUsername = :UsersUsername";
                        $Statement = $StormySystems->Query($UserDeleteQuery);
                        // Binding all the values
                        $StormySystems->bind(":UsersUsername", $UsersUsername);
                        // Executing the query
                        $StormySystems->Execute();
                    }
                    ?>
                </form>
            </div>
            <!-- Form to update users from the database -->
            <div class="UpdateForm">
                <form method="post" class="Delete">
                    <!-- Guide -->
                    <h2>
                        Updating Form
                    </h2>
                    <p>
                        Use this form to make changes to the database!
                    </p>
                    <div class="UserTypes">
                        <input type="text" name="Username" id="Username" placeholder="Username">
                        <select name="Type" id="Type">
                            <option value="Contributor">
                                Contributor
                            </option>
                            <option value="Administrator">
                                Administrator
                            </option>
                            <option value="Owner">
                                Owner
                            </option>
                        </select>
                    </div>
                    <div class="Names">
                        <input type="text" name="FirstName" id="FirstName" placeholder="First Name">
                        <input type="text" name="LastName" id="LastName" placeholder="Last Name">
                    </div>
                    <div class="Credentials">
                        <input type="email" name="Email" id="Email" placeholder="Email">
                        <input type="password" name="Password" id="Password" placeholder="Password">
                    </div>
                    <input type="submit" value="Update" id="Update" name="Update" />
                    <?php
                    // Update class which will retrive the values from the Update form for be handled.
                    class Update {
                        // Username Accessor Method
                        function getUsername() {
                            return $_POST['Username'];
                        }
                        // Type Accessor Method
                        function getType() {
                            return $_POST['Type'];
                        }
                        // First Name Accessor Method
                        function getFirstName() {
                            return $_POST['FirstName'];
                        }
                        // Last Name Accessor Method
                        function getLastName() {
                            return $_POST['LastName'];
                        }
                        // Email Accessor Method
                        function getEmail() {
                            return $_POST['Email'];
                        }
                        // Password Accessor Method
                        function getPassword() {
                            return $_POST['Password'];
                        }
                    }
                    if (isset($_POST['Update'])) {
                        // Instantiating Update class
                        $User = new Update();
                        $UsersUsername = $User->getUsername();
                        $UsersType = $User->getType();
                        $UsersFirstName = $User->getFirstName();
                        $UsersLastName = $User->getLastName();
                        $UsersEmail = $User->getEmail();
                        $UsersPassword = $User->getPassword();
                        // Instantiating Stormy Systems class
                        $StormySystems = new StormySystems();
                        // The query that will update the user which is associated to the value entered.
                        $UserUpdateQuery = "UPDATE users SET UsersFirstName = :UsersFirstName, UsersLastName = :UsersLastName, UsersType = :UsersType, UsersEmail = :UsersEmail, UsersPassword = :UsersPassword WHERE UsersUsername = :UsersUsername";
                        $Statement = $StormySystems->Query($UserUpdateQuery);
                        // Binding all the values
                        $StormySystems->bind(":UsersUsername", $UsersUsername);
                        $StormySystems->bind(":UsersFirstName", $UsersFirstName);
                        $StormySystems->bind(":UsersLastName", $UsersLastName);
                        $StormySystems->bind(":UsersType", $UsersType);
                        $StormySystems->bind(":UsersEmail", $UsersEmail);
                        $StormySystems->bind(":UsersPassword", $UsersPassword);
                        // Executing the query
                        $StormySystems->Execute();
                    }
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>