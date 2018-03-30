<?php


//If the form is submitted
if(isset($_POST['send'])) {
  
	$email= '';
	$message = '';
	$subject = stripslashes(trim($_POST['subject']));
	$website = stripslashes(trim($_POST['website']));
	$contactName = stripslashes(trim($_POST['name']));
	
	//If there is no error, send the email
	if(!isset($hasError)) {
		if(trim($_POST['name']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} 
		else {
			$contactName = trim($_POST['name']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = _e('You forgot to enter your email address.', 'Balance');
			$hasError = true;
		} else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email']))) {
            $emailError = 'You entered an invalid email address.';
            $hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
		 
		//Check to make sure comments were entered 
		if(trim($_POST['message']) === '') {
			$messageError = 'You forgot to enter your message.';
			$hasError = true;
		} 
		else {
			if(function_exists('stripslashes')) {
		  		$message = stripslashes(trim($_POST['message']));
		 	} 
		 	else {
		  		$message = trim($_POST['message']);
			}
		}
	}
	if(!isset($hasError)) {
		
		$status = "";
		
		require_once "class.phpmailer.php";
		$mail = new PHPMailer();
		$mail->IsMail();
		$mail->IsHTML(true);    
		$mail->CharSet  = "utf-8";
		$mail->From     = $email;
		$mail->FromName = $contactName.$website;
		$mail->WordWrap = 50;    
		$mail->Subject  =  $subject;
		$mail->Body     =  $message; 
		$mail->AddAddress('info@domain.com');
		$mail->AddReplyTo($email);
		
		if(!$mail->Send()) {  // send e-mail
			$status =  '<div class="error">Failed to send your e-mail. Please check everything and try again.</div>';
		}
		else
		{
			$status =  '<div class="success">E-mail was sent succesfully.</div>';
		}
		echo $status; die();
		
		
	} 

	die;
} 
?>