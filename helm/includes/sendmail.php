<?php
require_once( '../../../../wp-load.php' );

$sitename = get_bloginfo('name');
$siteurl =  get_bloginfo('siteurl');

	//Change the #emailTo to your email address
	$emailTo = of_get_option('ctemplate_email');
	$subject = $_REQUEST['subject'];
	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$msg=$_REQUEST['msg'];
	
	$body = "Name: $name \n\nEmail: $email \n\nMessage: $msg";
	$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
	
	wp_mail($emailTo, $subject, $body, $headers);
?>