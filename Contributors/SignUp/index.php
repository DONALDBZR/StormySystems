<?php
// Including the html file
include $_SERVER['DOCUMENT_ROOT'] . "/StormySystems/Pages/SignUp.html";
// Adding the API to post the retrieved data to the database
require $_SERVER['DOCUMENT_ROOT'] . "/StormySystems/StormySystems.php";
// Registration class to retrieve all the values from the form.
class Registration {
    // First Name Accessor Method
    function getFirstName() {
        return $_POST['FirstName'];
    }
    // Last Name Accessor Method
    function getLastName() {
        return $_POST['LastName'];
    }
    // Username Accessor Method
    function getUsername() {
        return $_POST['Username'];
    }
    // Type Accessor Method
    function getType() {
        return $_POST['Type'];
    }
    // Email Accessor Method
    function getEmail() {
        return $_POST['Email'];
    }
    // Password Accessor Method
    function getPassword() {
        return $_POST['Password'];
    }
    // Confirm Password Accessor Method
    function getConfirmPassword() {
        return $_POST['ConfirmPassword'];
    }
}
// The conditions to handle the form
if (isset($_POST['SignUp'])) {
    // Instantiating Registration class
    $Users = new Registration();
    $UsersUsername = $Users->getUsername();
    $UsersFirstName = $Users->getFirstName();
    $UsersLastName = $Users->getLastName();
    $UsersType = $Users->getType();
    $UsersEmail = $Users->getEmail();
    $UsersPassword = $Users->getPassword();
    $UsersConfirmPassword = $Users->getConfirmPassword();
    // Instantiating Stormy Systems class
    $UsersTable = new StormySystems();
    if ($UsersPassword == $UsersConfirmPassword) {
        // Insertion query for the registration
        $Query = "INSERT INTO stormysystems.users (UsersUsername, UsersFirstName, UsersLastName, UsersType, UsersEmail, UsersPassword) VALUES (:UsersUsername, :UsersFirstName, :UsersLastName, :UsersType, :UsersEmail, :UsersPassword)";
        $Statement = $UsersTable->Query($Query);
        // Binding all the values from the form.
        $UsersTable->bind(":UsersUsername", $UsersUsername);
        $UsersTable->bind(":UsersFirstName", $UsersFirstName);
        $UsersTable->bind(":UsersLastName", $UsersLastName);
        $UsersTable->bind(":UsersType", $UsersType);
        $UsersTable->bind(":UsersEmail", $UsersEmail);
        $UsersTable->bind(":UsersPassword", $UsersPassword);
        // Executing the query
        $UsersTable->Execute();
        $Message = "<h1 class='Success'> Account created! </h1>";
        $LoginButton = "<a href='../Contributors/Login/index.php' id='LogIn'> Log In </a>";
        echo $Message;
        echo "<br>";
        echo $LoginButton;
        exit;
    } else {
        $Message = "<h1 class='Failure'> The passwords are not identical! </h1>";
        echo $Message;
    }
} elseif ($UsersUsername = "" || $UsersFirstName = "" || $UsersLastName = "" || $UsersType = "" || $UsersEmail = "" || $UsersPassword = "" || $UsersConfirmPassword = "") {
    $Message = "<h1 class='Failure'> Please fill all the fields! </h1>";
    echo $Message;
}
?>