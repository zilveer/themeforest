<?php
require_once('recaptchalib.php');
require('../../../../wp-blog-header.php');
global $root;

$publickey = of_get_option(BRANKIC_VAR_PREFIX."recaptcha_public_api");
$privatekey = of_get_option(BRANKIC_VAR_PREFIX."recaptcha_private_api"); 

if ($publickey == "") $publickey = "6Le5jNMSAAAAAO4zTrbL1-S2WY9HOD-1HynRDun3";
if ($privatekey == "") $privatekey = "6Le5jNMSAAAAALuhzPiADxAD44e9YJ7vUIlHQ3GG ";

$use_captcha = of_get_option(BRANKIC_VAR_PREFIX."use_captcha");

$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

//echo $_POST["recaptcha_challenge_field"] . " | " . $_POST["recaptcha_response_field"];
//print_r($resp);

if ($resp->is_valid || $use_captcha == "no") {
?>success<?php

$email_to = of_get_option(BRANKIC_VAR_PREFIX."email_to");
$email_from = of_get_option(BRANKIC_VAR_PREFIX."email_from"); 
$email_from_2 = of_get_option(BRANKIC_VAR_PREFIX."email_from_2");



$subject = of_get_option(BRANKIC_VAR_PREFIX."email_subject");
for($i=1 ; $i <=5 ; $i++)
{
    $captions[] = of_get_option(BRANKIC_VAR_PREFIX."field_". $i ."_caption");  
}
$form_post_data = htmlspecialchars(strip_tags($_POST["form_post_data"]));
$form_values = explode("|||", $form_post_data);
$form_values = array_filter($form_values, 'strlen');
$k = 0;
foreach($form_values as $form_value)
{   
    $text .= $captions[$k] . " - " . $form_value . "<br>";
    if (($email_from_2 - 1) == $k) $email_from = $form_value;
    $k++;
}

$text = str_replace("\\", "", $text);



$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html; charset=utf-8" . "\r\n"; 
$headers .= "From: <$email_from>" . "\r\n";
mail($email_to, $subject, $text, $headers);



}
else 
{
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .  "(reCAPTCHA said: " . $resp->error . ")");
}
 


?>