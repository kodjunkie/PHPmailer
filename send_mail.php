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
    $mail = new SendMail($_POST['subject'], $_POST['message'], $_POST['from'], $_FILES['email_to_list']['tmp_name'], (bool)$_POST['send_to_group']);
else
    $mail = new SendMail($_POST['subject'], $_POST['message'], $_POST['from'], $_POST['to'], (bool)$_POST['send_to_group']);

// Validate & Send the Mail
$mail->validateInput()->send();

// Redirect to index page
header('Location: ./index.php');
