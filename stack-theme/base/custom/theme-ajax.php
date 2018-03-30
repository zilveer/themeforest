<?php

add_action( 'wp_ajax_nopriv_do_contact', 'do_contact' );
add_action( 'wp_ajax_do_contact', 'do_contact' );
function do_contact(){
	
	if( $_POST['email'] != '' ) {
		$result = array('result' => false, 'response_text' => '<strong>'. __('Failed', 'theme_admin') .'</strong> : ' . __('Honey Pot!', 'theme_admin'));
		die( json_encode($result) );
	}

	$site_name = get_bloginfo('name');
	$site_url =  home_url();
	$site_email = get_bloginfo( 'admin_email' );
	
	$to = ( $_POST['to'] != '' ) ? $_POST['to'] : $site_email;
	$to = str_replace('[at]','@',$to);

	$from = $_POST['from'];
	$phone = $_POST['phone'];

	$message = isset( $_POST['message'] ) ? trim(nl2br($_POST['message'])):'';

	if( isset( $_POST['purpose'] ) ) {
		$subject = '[ ' . $_POST['purpose'] . ' ] ' . __('from', 'theme_admin') . ' ' . $site_name;
	} else {
		$subject = '[ '. __('Contact', 'theme_admin') .' ] ' . __('from', 'theme_admin') . ' ' . $site_name;
	}
	
	$color = '#FAFAFA';
	
	$body = '<div style="padding: 10px; background: ' . $color . '; line-height: 20px;">';
	$body .= '<strong>' . __('Email', 'theme_admin') . ':</strong> ';
	$body .= $from . '<br />';
	$body .= '<strong>' . __('Phone', 'theme_admin') . ':</strong> ';
	$body .= $phone . '<br />';
	$body .= '<strong>' . __('Message', 'theme_admin') . ':</strong> <br />';
	$body .= $message . '<br /><br />';
	$body .= '</div>';
	
	$body .= '<div style="padding: 10px; background: #555; line-height: 20px; color: #F1F1F1;">';
	$body .= '<small>' . __('This email has been sent from', 'theme_admin') . ' : <a href="' . $site_url . '" style="color: #F1F1F1; text-decoration: none;">' . $site_name . '</a></small>';
	$body .= "</div>";
	
	$headers  = "From: $site_email\r\n"; 
    $headers .= "Reply-To: $from\r\n";
    $headers .= 'MIME-Version: 1.0' . "\n"; 
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	
	if(wp_mail($to, $subject, $body, $headers)){
		$result = array('result' => true, 'response_text' => '<strong>' . __('Success', 'theme_admin') . '</strong> : ' . __('your message has been sent.', 'theme_admin'));
	}else{
		$result = array('result' => false, 'response_text' => '<strong>'. __('Failed', 'theme_admin') .'</strong> : ' . __('some issue occur while sending your message', 'theme_admin'));
	}
	
	die( json_encode($result) );
}


//Mail Subscribe
add_action( 'wp_ajax_nopriv_mail_subscribe', 'mail_subscribe' );
add_action( 'wp_ajax_mail_subscribe', 'mail_subscribe' );
function mail_subscribe() {
	// Switch the email subscriber
	minimailchimp_subscribe();
}

// Mailchimp Subscriber
function minimailchimp_subscribe() {
	// Validate email
	$email = $_POST['email'];

	// Validate mailchimp configuration
	$apikey = base64_decode( $_POST['mailchimp_api_key'] );
	$list_id = $_POST['mailchimp_list_id']; //895f5f58bf'; // 'test-wp-theme-dev';

	// Get our MailChimp API class in scope
	if (!class_exists('mailchimpSF_MCAPI')) {
		require_once(THEME_CUSTOM_LIBS_DIR.'/miniMCAPI.class.php');
	}

	// Initialize api
	$api = new mailchimpSF_MCAPI($apikey, false);

	// Subscribe email
	$response = $api->listSubscribe($list_id, $email); //$response is true or false

	// Handle response
	if($response == true) {
		$result = array('result' => true, 'response_text' => '<strong>' . __('Subscribe success', 'theme_front') . '</strong> : ' . __('The confirmation mail will be sent to you soon.', 'theme_front'));
	}
	else {
		$result = array('result' => false, 'response_text' => '<strong>'. __('Subscribe failed', 'theme_front') .'</strong> : ' . __('Please check your email address or contact the admin.', 'theme_front'));
	}

	die (json_encode($result));
}

add_action( 'wp_ajax_nopriv_do_tweet', 'do_tweet' );
add_action( 'wp_ajax_do_tweet', 'do_tweet' );
function do_tweet(){
	die( require_once(THEME_CUSTOM_LIBS_DIR.'/twitter/index.php') );
}

?>