<?php
// Including the html file
include "../Pages/ContactForm.html";
// Adding the API to post the retrieved data to the database
require "../StormySystems.php";
// Adding all the files for PHPMailer
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/SMTP.php";
// Mail class to retrieve the form from the page
class Mail {
    // Name Accessor Method
    public function getName() {
        return $_POST["Name"];
    }
    // Email Accessor Method
    public function getEmail() {
        return $_POST["Email"];
    }
    // Message Accessor Method
    public function getMessage() {
        return $_POST["Message"];
    }
}
// Function to verify the mail and to store a copy of it in the database.
function VerifyMail() {
    // Instantiating Mail class from ContactForm.php
    $Mail = new Mail();
    // Instantiating StormySystems class from StormySystems.php
    $MailTable = new StormySystems();
    $MailName = $Mail->getName();
    $MailEmail = $Mail->getEmail();
    $MailMessage = $Mail->getMessage();
    // Insertion Query
    $Query = "INSERT INTO mail (MailName, MailEmail, MailMessage) VALUES (:MailName, :MailEmail, :MailMessage)";
    $Statement = $MailTable->Query($Query);
    // Binding all the values from the form.
    $MailTable->bind(":MailName", $MailName);
    $MailTable->bind(":MailEmail", $MailEmail);
    $MailTable->bind(":MailMessage", $MailMessage);
    // Executing the query
    $MailTable->Execute();
}
// Function to send the mail
function SendMail() {
    // Instantiating Mail class from ContactForm.php
    $Request = new Mail();
    $CustomerName = $Request->getName();
    $CustomerEmail = $Request->getEmail();
    $CustomerMessage = $Request->getMessage();
    // Assigning all the mail variables to send the mail.
    $Message = "There was a message from $CustomerName which is: $CustomerMessage.  Please consider into replying to that message to his email as soon as possible which is $CustomerEmail";
    // Instantiating PHPMailer class.
    $SSMail = new PHPMailer\PHPMailer\PHPMailer();
    $SSMail->IsSMTP();
    $SSMail->CharSet = "UTF-8";
    $SSMail->Host = "ssl://smtp.gmail.com";
    $SSMail->SMTPDebug = 0;
    $SSMail->Port = 465;
    $SSMail->SMTPSecure = 'ssl';
    $SSMail->SMTPAuth = true;
    $SSMail->IsHTML(true);
    //Authentication
    $SSMail->Username = "";
    $SSMail->Password = "";
    // Setting parameters
    // Setting the sender.
    $SSMail->setFrom($SSMail->Username);
    // Adding the recipient.
    $SSMail->addAddress("andygaspard@hotmail.com");
    // Setting the subject.
    $SSMail->Subject = "Stormy Systems";
    // Setting the mail body.
    $SSMail->Body = $Message;
    // Sending the mail.
    $SSMail->send();
}
// Condition for handling the form
if (isset($_POST['SendMail'])) {
    // Function to verify and store the mail which is being handled
    VerifyMail();
    // Function to send the mail which after being handled
    SendMail();
    echo "<h1 class='Success'> Mail Sent! </h1>";
} elseif ($MailName = "" || $MailEmail = "" || $MailMessage = "") {
    echo "<h1 class='Failure'> Please fill all the fields! </h1>";
}
?>