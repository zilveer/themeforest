<?php

if (!isset($_REQUEST['sg_post_id'])) die('(.)(.)');
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');

$post = array(
	'ID' => $_REQUEST['sg_post_id'],
	'post_type' => 'page',
);
$post = (object) $post;
sg_init_config($post);
$link = get_post_permalink($post->ID);

$aErrors = array();
$t = NULL;

if(!isset($_REQUEST['sg_ct_name']) OR empty($_REQUEST['sg_ct_name'])) {
	$aErrors[] = __('Please fill your name.', SG_TDN);
}
if(!isset($_REQUEST['sg_ct_email']) OR !preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $_REQUEST['sg_ct_email'])) {
	$aErrors[] = __('Please fill your mail.', SG_TDN);
}
if(!isset($_REQUEST['sg_ct_message']) OR empty($_REQUEST['sg_ct_message'])) {
	$aErrors[] = __('Please fill a message.', SG_TDN);
}

if(count($aErrors) === 0) {
	$name = strip_tags($_REQUEST['sg_ct_name']);
	$email = strip_tags($_REQUEST['sg_ct_email']);
	$website = strip_tags($_REQUEST['sg_ct_website']);

	$mail_to = _sg('Contact')->getEmail();
	$mail_to = empty($mail_to) ? get_bloginfo('admin_email') : $mail_to;
	$mail_subject = __('Message from', SG_TDN) . " " . get_bloginfo('name');

	$headers = "From: " . $name . " <" . $email . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/plain;\n";

	$mailbody = __('Message sent from IP', SG_TDN) . ": " . $_SERVER['REMOTE_ADDR'] . "\n";
	$mailbody .= __('Name', SG_TDN) . ": " . $name . "\n";
	$mailbody .= __('Email', SG_TDN) . ": " . $email . "\n";
	$mailbody .= __('WebSite', SG_TDN) . ": " . $website . "\n\n";
	$mailbody .= __('Message', SG_TDN) . ":\n";
	$mailbody .= strip_tags($_REQUEST['sg_ct_message']);

	if (mail($mail_to, $mail_subject, $mailbody, $headers)) {
		$msg = __('Your message was sent successfully.', SG_TDN);
		$msg .= isset($_REQUEST['ajax']) ? '' : '<br /><br /><a href="' . $link . '" class="button">' . __('Go Back', SG_TDN) . '</a>';
		$t = __('WordPress > Message', SG_TDN);
	} else {
		$msg = __('There was a problem. Try again later.', SG_TDN);
		$msg .= isset($_REQUEST['ajax']) ? '' : '<br /><br /><a href="' . $link . '" class="button">' . __('Go Back', SG_TDN) . '</a>';
	}
} else {
	$msg = '';
	foreach ($aErrors as $error) {
		$msg .= $error . '<br />';
	}
	$msg .= isset($_REQUEST['ajax']) ? '' : '<br /><a href="' . $link . '" class="button">' . __('Go Back', SG_TDN) . '</a>';
}

if (isset($_REQUEST['ajax'])) {
	die($msg);
} else {
wp_die($msg, $t);
}