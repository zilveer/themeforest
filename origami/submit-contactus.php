<?php 
//Check to make sure that the name field is not empty
	if(trim($_POST['contactName']) === '') {
		$nameError = 'You forgot to enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) === '')  {
		$emailError = 'You forgot to enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	//Check to make sure comments were entered	
	if(trim($_POST['commentsText']) === '') {
		$commentError = 'You forgot to enter your comments.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['commentsText']));
		} else {
			$comments = trim($_POST['commentsText']);
		}
	}
		
	//If there is no error, send the email
	if(!isset($hasError)) {

		$emailTo = strrev($_POST['emailTo']);
		$emailTo = str_replace('//', "@", $emailTo);
		$emailTo = str_replace('/', ".", $emailTo);
		
		$subject = 'Contact Form Submission from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		
		mail($emailTo, $subject, $body, $headers);

		if($sendCopy == true) {
			$subject = 'You emailed Your Name';
			$headers = __('From: ','themeteam'). '' .$emailTo;
			wp_mail($email, $subject, $body, $headers);
		}

		$emailSent = true;

	}


?>