<?php
$name = '';	 
$subject = '';	
$email = '';
$message = '';
    
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

//taking the data from form	

$name = addslashes(trim($_POST['shc-name']));	
$lastname = addslashes(trim($_POST['shc-lastname']));
$phone = addslashes(trim($_POST['shc-phone']));	
$email = addslashes(trim($_POST['shc-email']));
$message = addslashes(trim($_POST['shc-message']));
$sendTo = html_entity_decode(addslashes(trim($_POST['slider_email'])));

//form validation
$errors = array();
$fields = array();
if(!$name || !$lastname) {
	$errors[] = "Please enter your first and last name.";
	if(!$name) $fields[] = "shc-name";
	if(!$lastname) $fields[] = "shc-lastname";
}
$email_pattern = "/^[a-zA-Z0-9][a-zA-Z0-9-_\.]+\@([a-zA-Z0-9-_\.]+\.)+[a-zA-Z]+$/";
if(!$email) {
	$errors[] = "Please enter your e-mail address.";
	$fields[] = "shc-email";
} else if(!preg_match($email_pattern, $email)) {
	$errors[] = "The e-mail address you provided is invalid.";
	$fields[] = "shc-email";	
}
if(!$message) {
	$errors[] = "Please enter your message.";
	$fields[] = "shc-message";
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

	$content = 'Name: '.$name.' '.$lastname.'<br>'.
	'E-mail: '.$email.'<br>'.
	'Phone: '.$phone.'<br>'.
	'Message: '.$message.'<br>'.
	'Time: '.$timestamp.'<br>'.
	'IP: '.$host.'<br>'.
	'User agent: '.$user_agent;	

	//sending mail
	$ok = mail("$sendTo", "Form Slider", "$content", "$headers");
	if($ok) {
		$response['msgStatus'] = "ok";
		$response['message'] = "Thank you for contacting the team at example.com.\nWe will respond to your inquiry as soon as possible.";
		$response['errorFields'] = array();
	} else {
		$response['msgStatus'] = "error";
		$response['message'] = "An error occured on server while trying to send your message. Please try again later.";
		$response['errorFields'] = array();
	}
} else {
	$response['msgStatus'] = "error";
	$response['message'] = "An error occured while checking your message. Please try again later.";
	$response['errors'] = $errors;
	$response['errorFields'] = $fields;
}

header('Content-type: application/json');
echo json_encode($response);
?>