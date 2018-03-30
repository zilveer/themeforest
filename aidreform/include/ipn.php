<?php
// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 1);
// Set to 0 once you're ready to go live
define("USE_SANDBOX", 0);
define("LOG_FILE", "./ipn.log");
// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
include_once('../../../../wp-load.php');
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "&$key=$value";
}
// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data
//$cs_theme_options = get_option('cs_theme_options');
global $cs_theme_option;
if(isset($cs_theme_option['cs_paypal_sandbox']) && $cs_theme_option['cs_paypal_sandbox'] == 'on'){
	define("USE_SANDBOX", 1);
} else {
	define("USE_SANDBOX", 0);
}


if(USE_SANDBOX == true) {
	$paypal_url = wp_remote_get("https://www.sandbox.paypal.com/cgi-bin/webscr" , array( 'decompress' => false ));
} else {
	$paypal_url = wp_remote_get("https://www.paypal.com/cgi-bin/webscr" ,  array( 'decompress' => false ));
}
//$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
$ch = curl_init($paypal_url);
if ($ch == FALSE) {
	return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
if(DEBUG == true) {
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}
// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.
//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);
$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
	{
	if(DEBUG == true) {	
		error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
	}
	curl_close($ch);
	exit;
} else {
		// Log the entire HTTP response if debug is switched on.
		if(DEBUG == true) {
			error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
			error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
		}
		curl_close($ch);
}
// Inspect IPN validation result and act accordingly
// Split response headers and payload, a better way for strcmp
$tokens = explode("\r\n\r\n", trim($res));

$res = trim(end($tokens));
if (strcmp ($res, "VERIFIED") == 0) {
	$cause_id = $_POST['item_number'];
	// check whether the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment and mark item as paid.
	// assign posted variables to local variables
	//$item_name = $_POST['item_name'];
	//$item_number = $_POST['item_number'];
	//$payment_status = $_POST['payment_status'];
	//$payment_amount = $_POST['mc_gross'];
	//$payment_currency = $_POST['mc_currency'];
	//$txn_id = $_POST['txn_id'];
	//$receiver_email = $_POST['receiver_email'];
	//$payer_email = $_POST['payer_email'];
	$item_number = $_POST['item_number'];
	$cs_cause = get_post_meta($item_number, "cs_cause_transaction_meta", true);

	$sxe = new SimpleXMLElement("<cause_transaction></cause_transaction>");

	$cs_counter = 0;

	if ( isset($_POST['txn_id']) ) {

		if ( $cs_cause <> "" ) {

			$cs_xmlObject = new SimpleXMLElement($cs_cause);
			
			if(count($cs_xmlObject_transaction->transaction)>0){
				$payment_gross =$_POST['payment_gross'];
				
				foreach ( $cs_xmlObject_transaction->transaction as $transct ){
					$payment_gross = $payment_gross+$transct->payment_gross;
				}
			
				update_post_meta( $_POST['item_number'], 'cs_cause_raised_amount', $payment_gross );
			}
		}

		if(isset($cs_xmlObject->transaction) && count($cs_xmlObject->transaction)>0){

			foreach ( $cs_xmlObject->transaction as $trans ){

				$track = $sxe->addChild('transaction');

				if($trans->txn_id == $_POST['txn_id']){

					$trnx_exit =1;

				}

				$track->addChild('txn_id', $trans->txn_id );

				$track->addChild('item_number', $trans->item_number );

				$track->addChild('payer_id', $trans->payer_id );

				$track->addChild('payment_date', $trans->payment_date );

				$track->addChild('payer_email', $trans->payer_email );

				$track->addChild('payment_gross', $trans->payment_gross );

				$track->addChild('address_name', $trans->address_name  );

			}

		}

		if($trnx_exit <> '1'){

			$track = $sxe->addChild('transaction');

			$track->addChild('txn_id', htmlspecialchars($_POST['txn_id']) );

			$track->addChild('item_number', htmlspecialchars($_POST['item_number']) );

			$track->addChild('payer_id', htmlspecialchars($_POST['payer_id']) );

			$track->addChild('item_number', htmlspecialchars($_POST['item_number']) );

			$track->addChild('payment_date', htmlspecialchars($_POST['payment_date']) );

			$track->addChild('payer_email', htmlspecialchars($_POST['payer_email']) );

			$track->addChild('payment_gross', htmlspecialchars($_POST['payment_gross']) );

			$track->addChild('address_name', htmlspecialchars($_POST['address_name']) );

		}
	}
	update_post_meta($_POST['item_number'], 'cs_cause_transaction_ipn', $sxe->asXML());
	update_post_meta($_POST['item_number'], 'cs_cause_transaction_meta', $sxe->asXML());
	// end need this code
} else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
	// Add business logic here which deals with invalid IPN messages
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
	}
}