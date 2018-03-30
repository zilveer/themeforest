<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function process_aweber($args = array()) {
    if (empty($args)) {
        $args = $_REQUEST;
    }

	//$api_key = $args['akey'];

	$list_id = empty($args['lid']) ? '' : $args['lid'];

	$consumerKey    = startuply_option("vivaco_aweber_consumer_key", ''); # put your credentials here
	$consumerSecret = startuply_option("vivaco_aweber_consumer_secret", ''); # put your credentials here
	$accessKey      = startuply_option("vivaco_aweber_access_key", ''); # put your credentials here
	$accessSecret   = startuply_option("vivaco_aweber_access_secret", ''); # put your credentials here

	// error_log("list_id: $list_id");
	// error_log("consumerKey: $consumerKey");
	// error_log("consumerSecret: $consumerSecret");

	require_once dirname(__FILE__) . '/inc/aweber_api.php';

	$api = new AWeberAPI($consumerKey, $consumerSecret);

	try {
	    $account = $api->getAccount($accessKey, $accessSecret);

	    //error_log("account->lists:\r\n" . print_r($account->lists, 1));

	    $listURL = "/accounts/{$account->id}/lists/{$list_id}";
	    //error_log("listURL: $listURL");
	    $list = $account->loadFromUrl($listURL);

	    # create a subscriber
	    $params = array(
	        'email' => $args['email'],
	        'name' => implode(' ', array($args['fname'], $args['lname']) ),
	    );
	    $subscribers = $list->subscribers;
	    $new_subscriber = $subscribers->create($params);

	    # success!
	    return "Success! You added to mailing $list->name list!";

	} catch(AWeberAPIException $exc) {
	    error_log("Error: Type: $exc->type, Msg : $exc->message, $exc->documentation_url");
	    return "Error: Type: $exc->type, Msg : $exc->message, $exc->documentation_url";
	}


	return 'Error: Unknown error';
}
?>
