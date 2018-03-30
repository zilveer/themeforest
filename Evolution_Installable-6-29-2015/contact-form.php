<?php


//If the form is submitted
if(isset($_POST['send'])) {
	$al_options = explode('|', $_POST['options']);
	$email= '';
	$message = '';
	$website = stripslashes(trim($_POST['contactwebsite']));
	$contactName = stripslashes(trim($_POST['contactname']));
	
	//If there is no error, send the email
	if(!isset($hasError)) {
		if($contactName === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} 
		
		//Check to make sure sure that a valid email address is submitted
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['contactemail']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['contactemail']))) {
            $emailError = 'You entered an invalid email address.';
            $hasError = true;
		} else {
			$email = trim($_POST['contactemail']);
		}
		 
		//Check to make sure comments were entered 
		if(trim($_POST['contactmessage']) === '') {
			$messageError = 'You forgot to enter your message.';
			$hasError = true;
		} 
		else {
			if(function_exists('stripslashes')) {
		  		$message = stripslashes(trim($_POST['contactmessage']));
		 	} 
		 	else {
		  		$message = trim($_POST['contactmessage']);
			}
		}
	}
	if(!isset($hasError)) {
		
		$status = "";
		
		require_once "library/class.phpmailer.php";
		$mail = new PHPMailer();
		$mail->IsMail();
		$mail->IsHTML(true);    
		$mail->CharSet  = "utf-8";
		$mail->From     = $email;
		$mail->FromName = $contactName.' '.$website;
		$mail->WordWrap = 50;    
		$mail->Subject  = $al_options[2];
		$mail->Body     =  $message; 
		$mail->AddAddress($al_options[3]);
		$mail->AddReplyTo($email);
		
		if(!$mail->Send()) {  // send e-mail
			$status =  '<div class="error">'.$al_options[0].'</div>';
		}
		else
		{
			$status =  '<div class="success">'.$al_options[1].'</div>';
		}
		echo $status; die();	
	} 
	die;
} 
?>
