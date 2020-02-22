# PHPmailer
A simple PHP mailer package with zero dependency.

This package let you send highly customizable HTML emails and works straight out of the box. 
Just drop it in your server and you are all set.

![logo](https://raw.githubusercontent.com/kodjunkie/PHPmailer/master/assets/PHPmailer.png)

<h3 align="center">
    <a href="https://kodjunkie.github.io/PHPmailer" target="_blank">Documentation Here</a>
</h3>

## Installation
It works straight out of the box. All you have to do is

-   Browse into your root directory (public_html or www)
-   In your terminal or CLI run `git clone git@github.com:kodjunkie/PHPmailer.git`
-   Lastly visit https://your-site-url/PHPmailer

<b>OR</b>

-   Download the latest version [here](https://github.com/kodjunkie/PHPmailer/archive/master.zip)
-   Unzip into your root directory (public_html or www)
-   Rename `PHPmailer-master` to `PHPmailer`
-   Lastly visit https://your-site-url/PHPmailer

## Configuration <small>(optional)</small>
To enable IP Ban and / or Activity Logging.

Open ``includes/init.php`` in your favourite editor and uncomment these

```php
//bannedIPs();

//logActivity();
```

<b>TO</b>

```php
bannedIPs();

logActivity();
```

By default it saves the log file in its root directory (PHPmailer) but you can specify log file name and location 
name as follows
```php
logActivity('path/filename.log');
```

By default it validates emails. 
To disable, open ``handler.php`` in your editor and change
```php
$mail->validateInput()->send();
```
To
```php
$mail->send();
```
## Mail Template
You can have as many mail templates as you desire.
Just put them in the ``templates`` folder and have these placeholders in them

    $recipientName (optional)   -   Gets replaced by the email(without @domain.com)
    $recipientEmail (optional)  -   Gets replaced by the full email(username@domain.com)
    $message (required)         -   Gets replaced by the message content

Then open ``handler.php`` and specify the template name as the sixth argument to `SendMail` class, like below.
```php
// Instantiate the mail object
$mail = new SendMail($subject, $message, $from, $to, $sendToGroup, 'template_name.html');
if (isset($emailList) && is_file($emailList)) {
    $mail = new SendMail($subject, $message, $from, $emailList, $sendToGroup, 'template_name.html');
}
```

:fire: :rocket:
