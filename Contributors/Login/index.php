<?php
// Starting login session
session_start();
// Including the html file
include $_SERVER['DOCUMENT_ROOT'] . "/StormySystems/Pages/Login.html";
// Adding the API that will handle the form
require $_SERVER['DOCUMENT_ROOT'] . "/StormySystems/StormySystems.php";
// Login class will retrieve all the values from the form.
class Login {
    // Username Accessor Method
    public function getUsername() {
        return $_POST["Username"];
    }
    // Password Accessor Method
    public function getPassword() {
        return $_POST["Password"];
    }
}
// The conditions to handle the form
if (isset($_POST["LogIn"])) {
    // Instantiating Login class
    $Users = new Login();
    $UsersUsername = $Users->getUsername();
    $UsersPassword = $Users->getPassword();
    // Instantiating Stormy Systems class
    $UserTable = new StormySystems();
    // Verifying the usernames and the passwords simultaneuously.
    $Query = "SELECT * FROM users WHERE UsersUsername = :UsersUsername AND UsersPassword = :UsersPassword";
    $Statement = $UserTable->Query($Query);
    // Binding all the values
    $UserTable->bind(":UsersUsername", $UsersUsername);
    $UserTable->bind(":UsersPassword", $UsersPassword);
    // Executing the query
    $UserTable->Execute();
    // Retrieving the query's answer in the Result variable.
    $Result = $UserTable->ResultSet();
    // print_r($Result);
    // Verifying whether the combination is valid
    if (count($Result) == 0) {
        echo "<h1 class='Failure'> Incorrect Credentials! </h1>";
    } else {
        // Storing the Username as a session variable.
        $Username = $Result[0]['UsersUsername'];
        $_SESSION['UsersUsername'] = $Username;
        // Verifying the types of account
        $Type = $Result[0]['UsersType'];
        switch (true) {
            case ($Type == "Contributor"):
                header('location: ../Member/index.php');
            break;
            case ($Type == "Administrator"):
                header('location: ../Admin/index.php');
            break;
            case ($Type == "Owner"):
                header('location: ../Admin/index.php');
            break;
            default:
            echo "<h1 class='Failure'> You are not allowed to login due to a bug in the Login.php </h1>";
        }
    }
} elseif ($UsersUsername = "" || $UsersPassword = '') {
    echo "<h1 class='Failure'> Incorrect Credentials! </h1>";
}
?>