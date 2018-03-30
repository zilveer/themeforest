<?php
require_once('recaptchalib.php');
if (file_exists('../../../../wp-blog-header.php')){
	require('../../../../wp-blog-header.php');
} else {
	require('../../../../../wp-blog-header.php');
}
global $qode_options;

$publickey = $qode_options['recaptcha_public_key'];
$privatekey = $qode_options['recaptcha_private_key'];

if ($publickey == "") $publickey = "6Ld5VOASAAAAABUGCt9ZaNuw3IF-BjUFLujP6C8L";
if ($privatekey == "") $privatekey = "6Ld5VOASAAAAAKQdKVcxZ321VM6lkhBsoT6lXe9Z";

$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

$use_captcha = $qode_options['use_recaptcha'];
if ($resp->is_valid || $use_captcha == "no") {?>success<?php

$email_to = $qode_options['receive_mail'];
$email_from = $qode_options['email_from'];
$subject = $qode_options['email_subject'];

$text = "Name: " . $_POST["name"] . " " . $_POST["lastname"] . "\n";
$text .= "Email: " . $_POST["email"] . "\n";
$text .= "WebSite: " . $_POST["website"] . "\n";
$text .= "Message: " . $_POST["message"];

$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/plain; charset=utf-8" . "\r\n"; 
$headers .= "From: '".$_POST['name']." ".$_POST['lastname']."' <".$email_from."> " . "\r\n";
$headers .= "Reply-To: '" . $_POST["email"] . "'" . "\r\n";
$result = wp_mail($email_to, $subject, $text, $headers);
if(!$result) {
	global $phpmailer;
	var_dump($phpmailer->ErrorInfo);
}

}
else 
{
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .  "(reCAPTCHA said: " . $resp->error . ")");
}
?>