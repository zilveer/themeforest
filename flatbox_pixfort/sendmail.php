<?php

global $smof_data;
$wpcontent_dir = (isset($smof_data['contact_wpcontent_dir'])) ? $smof_data['contact_wpcontent_dir'] : 'wp-content';

$parse_uri = explode( $wpcontent_dir, $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

// Who you want to recieve the emails from the form. (Hint: generally you.)
$sendto = $smof_data['contact_email'];

// The subject of the email you'll see in your inbox
$subject = $smof_data['contact_subject'];

// Message for the user when he/she doesn't fill in the form correctly.
$errormessage = __( 'There seems to have been a problem. May we suggest:', 'flatbox' );

// Message for the user when he/she fills in the form correctly.
$thanks = __( "Thanks for the email! We'll get back to you as soon as possible!", 'flatbox' );

// Message for the bot when it fills in in at all.
$honeypot = __( "You filled in the honeypot! If you're human, try again!", 'flatbox' );

// Various messages displayed when the fields are empty.
$emptyname =  __( 'Entering your name?', 'flatbox' );
$emptyemail = __( 'Entering your email address?', 'flatbox' );
$emptymessage = __( 'Entering a message?', 'flatbox' );

// Various messages displayed when the fields are incorrectly formatted.
$alertname = __( 'Entering your name using only the standard alphabet?', 'flatbox' );
$alertemail = __( 'Entering your email in this format: <em>name@example.com</em>?', 'flatbox' );
$alertmessage = __( "Making sure you aren't using any parenthesis or other escaping characters in the message? Most URLS are fine though!", 'flatbox' );

// Don't modify the code below

// Setting used variables.
$alert = '';
$pass = 0;

// Sanitizing the data, kind of done via error messages first. Twice is better!
function clean_var($variable) {
	$variable = strip_tags(stripslashes(trim(rtrim($variable))));
	return $variable;
}

// The first if for honeypot.
if ( empty($_REQUEST['last']) ) {

	// A bunch of if's for all the fields and the error messages.
	if ( empty($_REQUEST['name']) ) {
		$pass = 1;
		$alert .= "<li>" . $emptyname . "</li>";
	} elseif ( preg_match( "/[{}()*+?.\\^$|]/", $_REQUEST['name'] ) ) {
		$pass = 1;
		$alert .= "<li>" . $alertname . "</li>";
	}
	if ( empty($_REQUEST['email']) ) {
		$pass = 1;
		$alert .= "<li>" . $emptyemail . "</li>";
	} elseif ( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/", $_REQUEST['email']) ) {
		$pass = 1;
		$alert .= "<li>" . $alertemail . "</li>";
	}
	if ( empty($_REQUEST['message']) ) {
		$pass = 1;
		$alert .= "<li>" . $emptymessage . "</li>";
	} elseif ( preg_match( "/[][{}()*+?\\^$|]/", $_REQUEST['message'] ) ) {
		$pass = 1;
		$alert .= "<li>" . $alertmessage . "</li>";
	}

	// If the user err'd, print the error messages.
	if ( $pass==1 ) {
		// This first line is for ajax/javascript, comment it or delete it if this isn't your cup o' tea.
		echo "<script>jQuery(\".message\").hide(\"slow\").show(\"slow\"); </script>";
		echo '<h3 class="half-bottom">' . $errormessage . '</h3>';
		echo '<ul class="square">'.$alert.'</ul>';

	} elseif (isset($_REQUEST['message'])) {
		// If the user didn't err and there is in fact a message, time to email it.
		$message = clean_var($_REQUEST['message']);
		$header = 'From: ' . clean_var($_REQUEST['name']) . ' <' . clean_var($_REQUEST['email']) . '>';

		// Mail the message - for production
		mail($sendto, $subject, $message, $header);
		// This next line is for javascript, comment it or delete it if this isn't your cup o' tea.
		echo "<script>jQuery(\".message\").hide(\"slow\").show(\"slow\").animate({opacity: 1.0}, 4000).hide(\"slow\"); jQuery(':input').clearForm() </script>";
		echo '<h3 class="half-bottom">' . $thanks . '</h3>';

		// Echo the email message - for development
		// echo "<br/>" . $message;

		die();
	}

// If honeypot is filled, trigger the message that bot likely won't see.
} else {
	echo "<script>jQuery(\".message\").hide(\"slow\").show(\"slow\"); </script>";
	echo $honeypot;
}
?>