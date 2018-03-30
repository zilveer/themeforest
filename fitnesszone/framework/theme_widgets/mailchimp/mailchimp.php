<?php
function dt_theme_mailchimp_list_ids($apiKey) {
	
	$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
	$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/';
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$result = curl_exec($ch);
	curl_close($ch);

	$result_decode = json_decode($result, true);
	
	return $result_decode['lists'];
	
}

add_action( 'wp_ajax_dt_theme_mailchimp_subscribe', 'dt_theme_mailchimp_subscribe' );
add_action( 'wp_ajax_nopriv_dt_theme_mailchimp_subscribe', 'dt_theme_mailchimp_subscribe' );
function dt_theme_mailchimp_subscribe() {

	global $dt_allowed_html_tags;	
	$out = '';
	
	$apiKey = $_REQUEST['mc_apikey'];
	$listId = $_REQUEST['mc_listid'];
	
	if($apiKey != '' && $listId != '') {
		$data = array();

		if($_REQUEST['mc_fname'] == ''):
			$data = array('email' => sanitize_email($_REQUEST['mc_email']), 'status' => 'subscribed');
		else:
			$data = array('email' => sanitize_email($_REQUEST['mc_email']), 'status' => 'subscribed', 'merge_fields' => array ( 'FNAME' => $_REQUEST['mc_fname'] ));
		endif;

		if(dt_theme_mailchimp_check_member_already_registered($data, $apiKey, $listId)) {
			$out = '<span class="error-msg"><b>'.esc_html__('Error:', 'iamd_text_domain').'</b> '.esc_html__('You have already subscribed with us !', 'iamd_text_domain').'</span>';
		} else {
			$out = dt_theme_mailchimp_register_member($data, $apiKey, $listId);
		}
				
	} else {
		$out = '<span class="error-msg"><b>'.esc_html__('Error:', 'iamd_text_domain').'</b> '.esc_html__('Please make sure valid mailchimp details are provided.', 'iamd_text_domain').'</span>';
	}
	
	echo wp_kses($out, $dt_allowed_html_tags);
		
	die();

}

function dt_theme_mailchimp_check_member_already_registered($data, $apiKey, $listId) {
	
	$memberId = md5(strtolower($data['email']));
	$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
	$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members';

	$json = json_encode(array(
					'email_address' => $data['email'],
					'status'        => $data['status'],
				));

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$result = curl_exec($ch);
	curl_close($ch);

	$result_decode = json_decode($result, true);
	
	foreach($result_decode['members'] as $key => $value) {
		if($value['email_address'] == $data['email']) {
			return true;
		}
	}
	
	return false;
	
}

function dt_theme_mailchimp_register_member($data, $apiKey, $listId) {
	
	$memberId = md5(strtolower($data['email']));
	$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
	$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

	$temp = array( 'email_address' => $data['email'], 'status' => $data['status'] );
	$json = '';

	if(array_key_exists('merge_fields', $data)):
		$json = json_encode( array( 'email_address' => $data['email'], 'status' => $data['status'], 'merge_fields' => array ( 'FNAME' => $data['merge_fields']['FNAME'] ) ));
	else:
		$json = json_encode( array( 'email_address' => $data['email'], 'status' => $data['status'] ));
	endif;

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);   

	$result = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	$result_decode = json_decode($result, true);

	if($httpCode == 200) {
		$out = '<span class="success-msg">'.esc_html__('Success! Please check your inbox or spam folder.', 'iamd_text_domain').'</span>';
	} else {
		$out = '<span class="error-msg"><b>'.$result_decode['title'].':</b> '.$result_decode['detail'].'</span>';
	}
	
	return $out;
	
}
?>