<?php
	define('WP_USE_THEMES', false);
	require('../../../../wp-load.php');

	$email_to = $_POST['emailAddress']; //the address to which the email will be sent
	$name = $_POST['contact_name'];
	$email = $_POST['contact_email'];
	$message = $_POST['contact_message'];
	$message = wordwrap($message, 70);

	/* the $header variable is for the additional headers in the mail function,
	  we are asigning 2 values, first one is FROM and the second one is REPLY-TO.
	  That way when we want to reply the email gmail(or yahoo or hotmail...) will know
	  who are we replying to. */
	$headers = "From: $name <$email>\r\n";
	$headers .= "Reply-To: $email\r\n";

	if (wp_mail($email_to, 'WP Mail from your site..', $message, $headers)) {
		echo 'sent'; // we are sending this text to the ajax request telling it that the mail is sent..      
	} else {
		echo 'failed'; // ... or this one to tell it that it wasn't sent    
	}
?>