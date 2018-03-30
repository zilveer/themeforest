<?php

/**
 * Mail Request
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

$target_email = $_POST['target_email'];

//If the form is submitted
if(isset($_POST['submitted'])) {
	/* checking if 'checking' field is checked*/
	
	if(trim($_POST['checking']) !== '') {
		$checking_error = true;
	} else {
		/* checking 'target_email' */
		if($target_email == '')
			$is_error = true; 

		/* checking 'author_cf' field */
		if(trim($_POST['author_cf']) === '')
			$is_error = true;
		else 
			$name = trim($_POST['author_cf']);
				
		/* checking 'email' address is submitted */
		if(trim($_POST['email_cf']) === '')  
			$is_error = true;
		// email validation
		else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['email_cf']))) 
			$is_error = true;
		else 
			$email = trim($_POST['email_cf']);

		/* checking 'comment' field - if there is any text */	
		if(trim($_POST['message_cf']) === '') {
			$is_error = true;
		} else {
			if(function_exists('stripslashes')) 
				$comment = stripslashes(trim($_POST['message_cf']));
			else
				$comment = trim($_POST['message_cf']);
		}

		/* if there is no errors email is send */	
		if(!isset($is_error)) {
			$emailTo	= $target_email; // default wordpress email address
			$from 		= $_POST['from_text']; 
			$subject	= $_POST['subject_text'].$name;
			$body		= $_POST['body_name_text'].$name.PHP_EOL.PHP_EOL.$_POST['body_email_text'].$email.PHP_EOL.PHP_EOL.$_POST['body_msg_text'].$comment;
			$headers	= $_POST['header_text'].$from.'<'.$email.'>';

			$send		= mail($emailTo, $subject, $body, $headers);
			
			if($send)
				echo 'success';
			else
				echo 'not_send';
		}
		else {
			echo 'error';
		}
	}
}