<?php

/**
 * Post email for contact page
 *
 * @subpackage newidea
 * @since newidea 4.0
 */

$contact_name 		= $_GET['contactName'];
$contact_email 		= $_GET['email'];
$contact_message 	= $_GET['message'];
$receiver 			= $_GET['emailTo'];

if( $contact_name == true ) {
	// get sender mail
	$sender = $contact_email;
	
	// get sender ip
	$client_ip = $_SERVER['REMOTE_ADDR'];
	
	// mail content
	$email_body = "Name: $contact_name \n\nEmail: $sender \n\nMessage: \n\n$contact_message \n\nIP: $client_ip";		
	
	$extra = "Content-type: text/plain; charset=UTF-8\r\n" . "From: $sender\r\n" . "Reply-To: $sender \r\n" . "X-Mailer: PHP/" . phpversion();
	// mail send state
	if( mail( $receiver, "Contact Form-".$contact_name , $email_body, $extra ) ) {
		echo "yes";
	}else{
		echo "no";
	}
}else{
	echo "false";
}
?>