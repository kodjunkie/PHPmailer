<?php

/*
 ****************************************************************************
             _______                      __
            /       \                    /  |
            $$$$$$$  | ______    ______  $$ |  ______   __   __   __
            $$ |__$$ |/      \  /      \ $$ | /      \ /  | /  | /  |
            $$    $$/ $$$$$$  |/$$$$$$  |$$ |/$$$$$$  |$$ | $$ | $$ |
            $$$$$$$/  /    $$ |$$ |  $$ |$$ |$$ |  $$ |$$ | $$ | $$ |
            $$ |     /$$$$$$$ |$$ |__$$ |$$ |$$ \__$$ |$$ \_$$ \_$$ |
            $$ |     $$    $$ |$$    $$/ $$ |$$    $$/ $$   $$   $$/
            $$/       $$$$$$$/ $$$$$$$/  $$/  $$$$$$/   $$$$$/$$$$/
                               $$ |
                               $$ |
                               $$/
 ****************************************************************************
 */

require_once("./includes/init.php");

// Instantiate the mail object
if (isset($_FILES['email_to_list']['tmp_name']) && is_file($_FILES['email_to_list']['tmp_name']))
    $mail = new SendMail(
        $_POST['subject'], // Subject
        $_POST['message'], // Message
        $_POST['from'], // From
        $_FILES['email_to_list']['tmp_name'], // To (Mail list file)
        (bool)$_POST['send_to_group'] // Send to group
    );
else
    $mail = new SendMail(
        $_POST['subject'], // Subject
        $_POST['message'], // Message
        $_POST['from'], // From
        $_POST['to'], // To
        (bool)$_POST['send_to_group'] // Send to single email
    );

// Validate & Send the Mail
$mail->validateInput()->send();

// Redirect to index page
header('Location: ./index.php');
