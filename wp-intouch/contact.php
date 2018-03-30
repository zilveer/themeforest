<?php
require_once('../../../wp-load.php');

$admin_email = get_bloginfo('admin_email');
define("WEBMASTER_EMAIL", $admin_email);

//define("WEBMASTER_EMAIL", 'your@domain.com'); // Enter yor e-mail
 
error_reporting (E_ALL); 
 
if(!empty($_POST)) {
	$_POST = array_map('trim', $_POST); 
	$name = htmlspecialchars($_POST['name']);
	$email = $_POST['email'];
	$url = htmlspecialchars($_POST['url']);
	$subject = htmlspecialchars($_POST['subject']);
	$message = htmlspecialchars($_POST['message']);
 
	$error = array();
 
	if(empty($name)) {
		$error[] = __('Please enter your name', 'color-theme-framework');
	}
 
	if(empty($email)) {
		$error[] = __('Please enter your e-mail', 'color-theme-framework');
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
		$error[] = __('e-mail is incorrect', 'color-theme-framework');
	}
 
	if(empty($message) || empty($message{15})) {
		$error[] = __('Please enter message more than 15 characters', 'color-theme-framework');
	}

	if(empty($error)) { 
		$mail_subject = __('Message from InTouch WordPress Theme', 'color-theme-framework');
		$message = __('Name: ', 'color-theme-framework') . $name . "\n" .
		__('Email: ', 'color-theme-framework') . $email . "\n" .
		__('URL: ', 'color-theme-framework') . $url . "\n" .
		__('Subject: ', 'color-theme-framework') . $subject . "\n" .
		__('Message: ', 'color-theme-framework') . $message;
		$mail = mail(WEBMASTER_EMAIL, '=?UTF-8?B?'.base64_encode($mail_subject).'?=', $message,
    		"From: ".$name." <".$email.">"." \r\n"
	    	."Reply-To: ".$email."\r\n"
	    	."Content-type: text/plain; charset=utf-8\r\n"
    		."X-Mailer: PHP/" . phpversion());

		if($mail) {
			echo 'OK';
		}
	}
	else {
		echo '<div class="alert alert-danger">'.implode('<br />', $error).'</div>';
	}
}