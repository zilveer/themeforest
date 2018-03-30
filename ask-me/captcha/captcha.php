<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] <> "POST") 
	die(__("You can only reach this page by posting from the form","vbegy"));

if (($_REQUEST["ask_captcha"] == $_SESSION["security_code"]) && (!empty($_REQUEST["ask_captcha"]) && !empty($_SESSION["security_code"]))) {
	echo "ask_captcha_1";
}else {
	echo "ask_captcha_0";
}
?>