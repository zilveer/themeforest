<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function process_get_response($args = array()) {

	require_once dirname(__FILE__) . '/inc/jsonRPCClient.php';

	# your API key is available at
	# https://app.getresponse.com/my_api_key.html
	$api_key = $args['akey'];
	$list_id = empty($args['lid']) ? '' : $args['lid'];

	# API 2.x URL
	$api_url = 'http://api2.getresponse.com';

	# add contact to the campaign

	try {
		# initialize JSON-RPC client
		$client = new jsonRPCClient($api_url);

		# find campaign named 'test'
		$campaigns = $client->get_campaigns(
		    $api_key,
		    array (
		        # find by name literally
		        'name' => array ( 'EQUALS' => $list_id )
		    )
		);

		$campaign_id = array_pop(array_keys($campaigns));

		$result = $client->add_contact(
			$api_key,
			array (
				# identifier of 'test' campaign
				'campaign'  => $campaign_id,
				# basic info
				'name'      => implode(' ', array($args['fname'], $args['lname']) ),
				'email'     => $args['email'],
				# custom fields
				// 'customs' => array(
				// 	// array(
				// 	//     'name'       => 'likes_to_drink',
				// 	//     'content'    => 'tea'
				// 	// ),
				// 	// array(
				// 	//     'name'       => 'likes_to_eat',
				// 	//     'content'    => 'steak'
				// 	// )
				// )
			)
		);

	} catch(Exception $e) {

		error_log( 'Error: '.$e->getMessage() );
		return 'Error: '.$e->getMessage();
	}

	if (!empty($result['queued']) && $result['queued'] == 1) {
		return 'Success! You added to mailing list.';
	} else {
		if (!empty($result['message'])) {
			error_log( "Error: Code - {$result['code']}, Msg - {$result['message']}" ); // simple write data to wp-content/debug.log. Check it!!!
			return "Error: Code - {$result['code']}, Msg - {$result['message']}";
		}

	}

	return 'Error: Unknown error';
}
?>
