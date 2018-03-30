<?php
require_once( '../../../../wp-load.php' );


if(isset($_POST["name"]) && $_POST["name"] && isset($_POST["email"]) && $_POST["email"] && isset($_POST["question"]) && $_POST["question"]){

	$name=urldecode(stripcslashes($_POST["name"]));
	$subject = "A message from ".$name;

	$notes = urldecode(stripcslashes($_POST["question"]));

	$from = $_POST['email'];
	$email_recepient=get_opt('_email');

	$sender = get_opt('_email_from');
	$original_sender = false;
	if(empty($sender)){
		if(strpos($from, 'yahoo')!==false && strpos($email_recepient, 'yahoo')===false){
		//the visitor's email address is on Yahoo, set the recepient address as sender
			$sender = $email_recepient;
		}else{
			$original_sender = true;
			$sender = $from;
		}
	}

	$message = "From: $name, e-mail address: $from \r\nMessage: $notes \r\n";

	$headers = array();
	if($original_sender){
		$headers[] = 'From: '.$name.' <'.$sender.'>';
	}else{
		$headers[] = 'From: '.$sender;
	}
	$headers[] = 'Reply-To: '.$name.' <'.$from.'>';
	$mail_res=wp_mail($email_recepient, $subject, $message, $headers);
	$res=$mail_res?'1':'0';
	echo $res;
	exit();
}

?>
