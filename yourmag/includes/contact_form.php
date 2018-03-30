<?php

function r_contact_form($email) {

	$email_adress_reciever = $email != "" ? $email : get_option('admin_email');
	
	if(isset($_POST['submittedContact'])) {
	get_template_part('submit'); 
	}
	
	if(isset($emailSent) && $emailSent == true) {
		
		$out .= '<a name="contact_"></a>';
		$out .= '<p class="thanks"><strong>Thanks!</strong> Your email was successfully sent.</p>';
		
	} else {
		
		$out .= '<a name="contact_"></a>';
		$out .= '<form action="' .get_permalink(). '#contact_" id="contact_form" method="post">';
		$out .= '<p><input type="text" name="contactName" id="contactName" value="';
		
		if(isset($_POST['contactName'])) {
			$out .= $_POST['contactName'];
		}
		$out .= '"';
		$out .= ' class="requiredFieldContact textfield';
		
		if($emailError != '') {
			$out .= ' inputError';
		}
		$out .= '"';
		$out .= ' /><label class="textfield_label" for="contactName"> Name *</label></p>';
		
		$out .= '<p><input type="text" name="email" id="email" value="';
		
		if(isset($_POST['email'])) {
			$out .= $_POST['email'];
		}
		$out .= '"';
		$out .= ' class="requiredFieldContact email textfield';
		
		if($emailError != '') {
			$out .= ' inputError';
		}
		$out .= '"';
		$out .= ' /><label class="textfield_label" for="email"> Email *</label></p>';
		
		$out .= '<p><textarea name="comments" id="commentsText" class="requiredFieldContact textarea';
		
		if($commentError != '') {
			$out .= ' inputError';
		}
		$out .= '">';
		
		if(isset($_POST['comments'])) { 
			if(function_exists('stripslashes')) { 
				$out .= stripslashes($_POST['comments']); 
				} else { 
					$out .= $_POST['comments']; 
				} 
			}
		$out .= '</textarea></p>';
		
		$out .= '<p><button name="submittedContact" id="submittedContact" type="submit" value="Submit" ><span>Submit</span></button></p>';
		
		$out .= '<p class="screenReader"><input id="submitUrl" type="hidden" name="submitUrl" value="' .get_template_directory_uri(). '/submit.php" /></p>';
	    $out .= '<p class="screenReader"><input id="emailAddress" type="hidden" name="emailAddress" value="' .royal_nospam($email_adress_reciever). '" /></p>';
				
		$out .= '</form>';

	}
	return $out;
}

function royal_nospam($email, $filterLevel = 'normal')
{
	$email = strrev($email);
	$email = preg_replace('[@]', '//', $email);
	$email = preg_replace('[\.]', '/', $email);

	if($filterLevel == 'low')
	{
		$email = strrev($email);
	}

	return $email;
}
?>
