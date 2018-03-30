<?php

	include_once( '../../../../wp-load.php' );

	global $dd_sn;

	if ( ot_get_option( $dd_sn . 'paypal_sandbox', 'disabled' ) == 'enabled' ) {
		$sandbox = true;
	} else {
		$sandbox = false;
	}

	/* STEP 1: Read POST data */

	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();

	foreach ( $raw_post_array as $keyval ) {
		$keyval = explode ('=', $keyval);
		if ( count( $keyval ) == 2 ) {
			$myPost[$keyval[0]] = urldecode( $keyval[1] );
		}
	}
	
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


	/* STEP 2: Post IPN data back to paypal to validate */
	if ( $sandbox ) {
		$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
	} else {
		$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');	
	}

	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

	if(  ! ( $res = curl_exec( $ch ) ) ) {
		curl_close( $ch );
		exit;
	}
	curl_close( $ch );


	/* STEP 3: Inspect IPN validation result and act accordingly */

	if (strcmp ($res, "VERIFIED") == 0) {

		//// check whether the payment_status is Completed
		//// check that receiver_email is your Primary PayPal email
		//// check that payment_amount/payment_currency are correct
		//// process payment

		// assign posted variables to local variables

		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];

		// Get regular donate page id
		$donate_page_id = dd_get_post_id( 'template', 'template-donate.php' );

		// Donation splitting
		$donate_split = ot_get_option( $dd_sn . 'regular_donation_spread', 'enabled' );
		if ( $donate_split == 'enabled' ) {
			$donate_split = true;
		} else {
			$donate_split = false;
		}

		// If the payment was from regular donate page
		if ( $item_number == $donate_page_id ) {

			if ( $donate_split ) {

				$args = array(
					'paged' => $paged, 
					'post_type' => 'dd_causes',
					'posts_per_page' => $posts_per_page,
					'meta_key' => '_dd_cause_percentage',
					'order_by' => 'meta_value_num',
					'order' => 'DESC',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => '_dd_cause_status',
							'value' => 'funded',
							'compare' => '!=',
						)
					)
				);

				// Do the Query
				$dd_query = new WP_Query($args);

				// Loop
				if ( $dd_query->have_posts() ) {

					$causes_amount = $dd_query->found_posts ;
					$donation_per_cause = $payment_amount / $causes_amount;

					while ( $dd_query->have_posts() ) { 

						$dd_query->the_post();

						// Get current amount
						$cause_curr_amount = get_post_meta( get_the_ID(), $dd_sn . 'cause_amount_current', true );
						$cause_new_amount = $donation_per_cause + $cause_curr_amount;
						update_post_meta( get_the_ID(), $dd_sn . 'cause_amount_current', $cause_new_amount );

					} 

				}

				wp_reset_query();

			}

		// If the payment was from a cause page
		} else {

			$cause_curr_amount = get_post_meta( $item_number, $dd_sn . 'cause_amount_current', true );
			$cause_new_amount = $payment_amount + $cause_curr_amount;
			update_post_meta( $item_number, $dd_sn . 'cause_amount_current', $cause_new_amount );

		}		

	}

?>