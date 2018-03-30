<?php 
function getIp()
	{if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip_address=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}

	if (!isset($ip_address)){
			if (isset($_SERVER['REMOTE_ADDR']))	
			$ip_address=$_SERVER['REMOTE_ADDR'];
	}
	return $ip_address;
}

function send_mail($name, $subject, $email, $message) {

	$name = addslashes(trim($name));	
	$subject = addslashes(trim($subject));	
	$email = addslashes(trim($email));
	$message = addslashes(trim($message));
	
	$contact_email = get_option('contact_email');
	$contact_msg_success = get_option('contact_msg_success');
	$contact_msg_err_no_name = get_option('contact_msg_err_no_name');
	$contact_msg_err_no_email = get_option('contact_msg_err_no_email');
	$contact_msg_err_inv_email = get_option('contact_msg_err_inv_email');
	$contact_msg_err_no_subject = get_option('contact_msg_err_no_subject');
	$contact_msg_err_no_message = get_option('contact_msg_err_no_message');
	$contact_msg_err = get_option('contact_msg_err');

	//form validation
	$errors = array();
	$fields = array();
	if(!$name) {
		$errors[] = $contact_msg_err_no_name;
		$fields[] = "sender_name";
	}
	$email_pattern = "/^[a-zA-Z0-9][a-zA-Z0-9-_\.]+\@([a-zA-Z0-9-_\.]+\.)+[a-zA-Z]+$/";
	if(!$email) {
		$errors[] = $contact_msg_err_no_email;
		$fields[] = "email";
	} else if(!preg_match($email_pattern, $email)) {
		$errors[] = $contact_msg_err_inv_email;
		$fields[] = "email";	
	}
	if(!$message) {
		$errors[] = $contact_msg_err_no_message;
		$fields[] = "message";
	}

	//preparing mail
	if(!$errors) {
		//taking info about date, IP and user agent
		$timestamp = date("Y-m-d H:i:s");
		$ip   = getIp();
		$host = gethostbyaddr($ip); 
		$user_agent = $_SERVER["HTTP_USER_AGENT"];

		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf-8\n";
		$headers .= "Content-Transfer-Encoding: quoted-printable\n";
		$headers .= "From: $email\n";

		$content = 'Subject: '.$subject.'<br>'.
		'Name: '.$name.'<br>'.
		'E-mail: '.$email.'<br>'.
		'Message: '.$message.'<br>'.
		'Time: '.$timestamp.'<br>'.
		'IP: '.$host.'<br>'.
		'User agent: '.$user_agent;	

		//sending mail
		$ok = mail($contact_email,$subject, $content, $headers);
		if($ok) {
			$response['msgStatus'] = "ok";
			$response['message'] = $contact_msg_success;
			$response['errorFields'] = array();
		} else {
			$response['msgStatus'] = "error";
			$response['message'] = $contact_msg_err;
			$response['errorFields'] = array();
		}
	} else {
		$response['msgStatus'] = "error";
		$response['errors'] = $errors;
		$response['errorFields'] = $fields;
	}

	if($response['msgStatus'] == "ok") {
		echo '<p class="msg success"><a class="hide" href="#">' . esc_attr__('hide this', 'multipurpose') . '</a>' . $response['message'] . '</p>';
	} else {
		if($response['errors']) {
			$error_list = "<ul><li>" . implode("</li><li>", $response['errors']) . '</li></ul>';
			echo '<div class="msg error"><a class="hide" href="#">' . esc_attr__('hide this', 'multipurpose') . '</a><p>' . esc_attr__('There were errors in your form', 'multipurpose') . ':</p>' . $error_list . '<p>' . esc_attr__('Please make the necessary changes and re-submit your form', 'multipurpose') . '</p></div>';
		} else {
			echo '<p class="msg error"><a class="hide" href="#">' . esc_attr__('hide this', 'multipurpose') . '</a>' . $response['message'] . '</p>';
		}
	}
	return $response;
}
?>