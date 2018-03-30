<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function process_madmimi($args = array()) {
    if (empty($args)) {
        $args = $_REQUEST;
    }

	$api_key = $args['akey'];

	$list_id = empty($args['lid']) ? '' : $args['lid'];

	$login = $args['madmimi_email'];

	require_once dirname(__FILE__) . '/inc/MadMimi.class.php';

	$api = new MadMimi($login, $api_key);

	$user = array(
		'email' => $args['email'],
		'firstName' => $args['fname'],
		'lastName' => $args['lname'],
		'add_list' => $list_id
	);

	ob_start();

	$result = $api->AddUser($user, true);

	$out = ob_get_contents();

	ob_end_clean();

	//error_log( print_r( $out, true ) ); // simple write data to wp-content/debug.log. Check it!!!

	if ($out && !is_numeric($out)) {
		error_log("Error: {$out}");
		return "Error: {$out}";
	}

	if ($result) {
		return 'Success! You added to mailing list.';
	}


	return 'Error: Unknown error';
}
?>
