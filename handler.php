<?php

/*
 * Handle the submitted form request
 * */

require_once("./includes/init.php");

// Variables
$subject = $_POST['subject'];
$message = $_POST['message'];
$from = $_POST['from'];
$to = $_POST['to'];
$emailList = $_FILES['email_to_list']['tmp_name'];
$sendToGroup = (bool)$_POST['send_to_group'];

try {
    // Instantiate the mail object if sending to a single email
    $mail = new SendMail($subject, $message, $from, $to, $sendToGroup);

    // Instantiate the mail object if sending to an email list
    if (isset($emailList) && is_file($emailList)) {
        $mail = new SendMail($subject, $message, $from, $emailList, $sendToGroup);
    }

    // Validate & Send the Mail
    $mail->validate()->send();

} catch (Exception $exception) {
    $_SESSION['msg'] = ['Oops! ' . $exception->getMessage(), false];
}

// Redirect to index page
header('Location: ./index.php');
