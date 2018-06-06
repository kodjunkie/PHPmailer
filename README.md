# PHPmailer
Simple PHP mailer package.

This package helps you to send highly customizable HTML emails with PHP.
And works straight out of the box. Just drop it on your server and you are good to go.

## Installation
It works straight out of the box. All you have to do is

	cd into your root directory (public_html or www)
	git clone git@github.com:Paplow/PHPmailer.git
	visit https://your-site-url/PHPmailer
    
	OR:

	Download the latest version at: https://github.com/Paplow/PHPmailer/archive/master.zip
	unzip in into your root directory (public_html or www)
	unzip master.zip
	mv PHPmailer-master PHPmailer
	visit https://your-site-url/PHPmailer

## Configuration (optional)
To enable IP Ban and/or Activity Log.

Open ``includes/init.php`` in your favourite editor and uncomment these

```php
// Ban IP Addresses
//bannedIPs();

// Log Activity
//logActivity();
```

To

```php
// Ban IP Addresses
bannedIPs();

// Log Activity
logActivity();
```
By default it saves the log file in its root directory(PHPmailer) but you can specify log file path and file name as follows
```php
// Log Activity
logActivity('path/filename.log');
```

By default it validates emails. 
To disable, open ``send_mail.php`` in your favourite editor and change
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

Then open ``send_mail.php`` and specify the template name as the sixth arguement / parameter
```php
$mail = new SendMail($_POST['subject'], $_POST['message'], $_POST['from'], $_FILES['email_to_list']['tmp_name'], (bool)$_POST['send_to_group'], "template_name.html");

And/Or

$mail = new SendMail($_POST['subject'], $_POST['message'], $_POST['from'], $_POST['to'], (bool)$_POST['send_to_group'], "template_name.html");
```

ENJOY.
