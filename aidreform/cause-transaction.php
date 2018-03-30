<?php

/*

Template Name: Paypal Notification Template

*/

$req = 'cmd=_notify-validate';

get_header();

if ( isset($_POST['txn_id']) &&  $_POST['txn_id'] <> '') {

foreach ($_POST as $key => $value) {

$value = urlencode(stripslashes($value));

$req .= "&$key=$value";

}

// post back to PayPal system to validate

$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";

$header .= "Content-Type: application/x-www-form-urlencoded\r\n";

$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);

$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);



	if (!$fp) {

// HTTP ERROR

	} else {

	fputs ($fp, $header . $req);

		while (!feof($fp)) {

		$res = fgets ($fp, 1024);

			if (strcmp ($res, "VERIFIED") == 0) {	

				

				$trnx_exit =0;
// need this code
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

			}

		}

	fclose ($fp);

	}

}

 get_footer(); ?>