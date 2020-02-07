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

// Instantiate the mail object
$mail = new SendMail($subject, $message, $from, $to, $sendToGroup);

if (isset($emailList) && is_file($emailList)) {
    $mail = new SendMail($subject, $message, $from, $emailList, $sendToGroup);
}

// Validate & Send the Mail
$mail->validateInput()->send();

// Redirect to index page
header('Location: ./index.php');
