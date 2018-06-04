# PHPmailer
Simple PHP mailer package. No extra packages needed to work.

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

## Configuration
To enable IP Ban and/or Activity Log.

Open includes/init.php in your favourite editor and uncomment these

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
And also you can specify log file path and file name
```php
// Log Activity
logActivity('path/filename.log');
```

By default it validates emails. 
To disable, open send_mail.php in your favourite editor and change
```php
$mail->validateInput()->send();
```
To
```php
$mail->send();
```

ENJOY.
