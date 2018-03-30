<?php 

//MailChimp

add_action('wp_ajax_nopriv_add_to_mailchimp_list', 'add_to_mailchimp_list');
add_action('wp_ajax_add_to_mailchimp_list', 'add_to_mailchimp_list');


function add_to_mailchimp_list() {
	
	global $ievent_data;
	
	check_ajax_referer('MailChimp', 'ajax_nonce');
	$_POST = array_map('stripslashes_deep', $_POST);

	$email = sanitize_email($_POST['email']);

	$api_key=$ievent_data['mailchimp_apikey'];
	//var_dump($api_key);
	
	$get_url=explode('-',$api_key);	
	$get_key=$get_url[1];	

	if (is_email($email)) {
		$submit_url = 'http://'.$get_key.'.api.mailchimp.com/1.3/?method=listSubscribe';
				
		$data = array(
			'email_address'	=> $email,
			'apikey'	=> $ievent_data['mailchimp_apikey'],
			'id'		=> $ievent_data['mailchimp_id'],
			'double_optin'	=> true,
			'send_welcome'	=> false,
			'email_type'	=> 'html'
		);
		
		$payload = json_encode($data);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $submit_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
		 
		$result = curl_exec($ch);
		curl_close ($ch);
		$data = json_decode($result);
		
		//var_dump($data);

		if ($data === true) {
		    echo 'added';
		} else if (is_object($data) && $data->error) {
		    echo ($data->code === 214) ? 'already subscribed' : 'error';	    
		} else if (is_null($data)) {
		    echo 'error';
		}
	} else {
		echo 'invalid email';	
	}
	die();
}


?>