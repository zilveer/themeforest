<?php

function process_mailchimp($args = array()) {
    if (empty($args)) {
        $args = $_REQUEST;
    }

	// grab an API Key from http://admin.mailchimp.com/account/api/
	$api_key = $args['akey'];

	// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
	// Click the "settings" link for the list - the Unique Id is at the bottom of that page.
	$list_id = $args['lid'];

	require_once dirname(__FILE__) . '/inc/MailChimp.php';

	$dopt = (!empty($args['dopt']) && ($args['dopt'] == 'true' || $args['dopt'] == 1)) ? true : false;

	$email = $args['email'];

	$merge_vars = array(
		'FNAME' => !empty($args['fname']) ? $args['fname'] : '',
		'LNAME' => !empty($args['lname']) ? $args['lname'] : '',
	);

	$api = new MailChimp($api_key);
	$valid_key = $api->validateApiKey();

	if( !$valid_key ) {
		return 'Error: please, check your api-key';
	}

	$result = $api->call('lists/subscribe', array(
        'id'                => $list_id,
        'email'             => array('email' => $email),
        'merge_vars'        => $merge_vars,
        'double_optin'      => $dopt,
        'update_existing'   => true,
        'replace_interests' => false,
        'send_welcome'      => false,
    ));

	if (!empty($result['email']) && !empty($result['euid']) && !empty($result['leid'])) {
		return 'Success! You added to mailing list.';
	} else {
		$message = array();

		if( !empty($result['error']) ) {
			$message[] = $result['error'];
		}

        error_log('Error: '.implode(' - ', $message));
		return 'Error: '.implode(' - ', $message);
	}

}
?>
