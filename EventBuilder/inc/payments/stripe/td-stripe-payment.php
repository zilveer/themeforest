<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( 'stripe-php/init.php' );

function sc_set_stripe_key() {
	global $sc_options;
	$key = '';

	// Check first if in live or test mode.
	global $redux_demo;
	$stripe_test = $redux_demo['stripe-state'];

	if($stripe_test == 2) {
		$key = $redux_demo['stripe-test-secret-key'];
	} elseif($stripe_test == 1){
		$key = $redux_demo['stripe-live-secret-key'];
	}

	\Stripe\Stripe::setApiKey( $key );
}


function paymentStripeForm() {

	if( isset( $_POST['stripeToken'] ) ) {

		$redirect      = $_POST['sc-redirect'];
		$fail_redirect = $_POST['sc-redirect-fail'];

		global $redux_demo;

		// Get the credit card details submitted by the form
		if ( !is_user_logged_in() ) {
			$planEMAIL     = $_POST['paymentPackageEmail'];
		} else {
			global $current_user, $user_id, $user_info;
			get_currentuserinfo();
			$user_id       = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.
			$user_email    = get_the_author_meta('user_email', $user_id);
			$planEMAIL     = $user_email;
		}	
		$planID        = $_POST['paymentPackageID'];
		$package_price = get_post_meta($planID, 'package_price', true);

		$token         = $_POST['stripeToken'];
		$amount        = $package_price*100;
		$store_name    = get_bloginfo('name');
		$description   = get_the_title( $planID );
		$currency      = $redux_demo['currency-code'];
		$test_mode     = ( isset( $_POST['sc_test_mode'] ) ? $_POST['sc_test_mode'] : 'false' );

		$charge = array();
		$query_args = array();

		$meta = array();
		$meta = apply_filters( 'sc_meta_values', $meta );

		sc_set_stripe_key();

		// Create new customer
		$new_customer = \Stripe\Customer::create( array(
			'email' => $planEMAIL,
			'card'  => $token
		));

		require_once('stripe-php/lib/Stripe.php');
		try {
		    $charge = \Stripe\Charge::create(array(
		        'amount'      => $amount, // amount in cents, again
				'currency'    => $currency,
				'customer'    => $new_customer['id'],
				'description' => $description,
				'metadata'    => $meta
		    ));

		    $chargeID = $charge->id;

			// Add Stripe charge ID to querystring.
			$redirect_url = "?charge=".$chargeID."&store_name=".$store_name;

			$failed = false;

			saveStripePayment($planEMAIL, $planID, $chargeID);

		} catch (Stripe_CardError $e) {

			// Catch Stripe errors
			$redirect = $fail_redirect;
			
			$e = $e->getJsonBody();
			
			// Add failure indicator to querystring.
			$redirect_url = "?charge_failed=".$chargeID;

			$failed = true;

		}

		unset( $_POST['stripeToken'] );

	}

	$response = $redirect_url;

	echo esc_attr($response);

	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_paymentStripeForm', 'paymentStripeForm' );
add_action( 'wp_ajax_nopriv_paymentStripeForm', 'paymentStripeForm' );


function saveStripePayment($planEMAIL, $planID, $chargeID) {
	
	session_start();
	/**
	 * Form posting handler
	 */
	$pagePath = explode('/wp-content/', dirname(__FILE__));
    include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));

	/**
	* Add transaction info to database 
	*/

	global $wpdb;

	$wpdb->query('CREATE TABLE IF NOT EXISTS `td_payments` (
	        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        `token` TEXT NOT NULL,
	        `email` TEXT NOT NULL,
	        `package_id` TEXT NOT NULL,
	        `package_name` TEXT NOT NULL,
	        `price` TEXT NOT NULL,
	        `currency` TEXT NOT NULL,
	        `payment_type` TEXT NOT NULL,
	        `status` TEXT NOT NULL,
	        `custom_id` TEXT NOT NULL,
        	`transaction_id` TEXT NOT NULL,
        	`sumary` TEXT NOT NULL,
	        `created` INT( 4 ) UNSIGNED NOT NULL
	) ENGINE = MYISAM ;');

	$planTOKEN = "";
	if ( !is_user_logged_in() ) {
		$planEMAIL     = $_POST['stripe-payment-package'];
	} else {
		global $current_user, $user_id, $user_info;
		get_currentuserinfo();
		$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.
		$user_email = get_the_author_meta('user_email', $user_id);
		$planEMAIL     = $user_email;
	}	
	$planCustomID = uniqid();

	$package_price = get_post_meta($planID, 'package_price', true);

	global $redux_demo;

	if(empty($package_price) or $package_price == 0) {
		$package_price = __( 'Free', 'themesdojo' );
		$currency_symbol = "";
	} else {
		$currency_symbol = $redux_demo['currency-symbol'];
	}

	$planPACKAGE = get_the_title( $planID );

	$planPRICE = $package_price;
	$planCURRENCY = $currency_symbol;
	$planTYPE = "Stripe";
	$planSTATUS = "success";

	$price_plan_information = array(
		'token' => $planTOKEN,
		'email' => $planEMAIL,
		'package_id' => $planID,
		'package_name' => $planPACKAGE,
		'price' => $planPRICE,
		'currency' => $planCURRENCY,
		'payment_type' => $planTYPE,
		'transaction_id' => $chargeID,
		'status' => $planSTATUS,
		'created' => time(),
		'custom_id' => $planCustomID
	); 

	$insert_format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');
	        
	$wpdb->insert('td_payments', $price_plan_information, $insert_format);

	//=========================================
	// add package info to user ===============
	//=========================================
	$user = get_user_by( 'email', $planEMAIL );
	$user_id = $user->ID;

	update_user_meta( $user_id, "user_featured_listings_used_".$planCustomID, "0" );
	update_user_meta( $user_id, "user_regular_listings_used_".$planCustomID, "0" );

	//=========================================
	// Send email to admin ====================
	//=========================================

	global $redux_demo;
	$admin_email = $redux_demo['contact-email'];
	$admin_email_title = $redux_demo['payment-admin-title'];
	$admin_email_message = $redux_demo['payment-admin-message'];

	if(empty($admin_email)) {
		$admin_email = "test@mail.com";
	}

	if(empty($admin_email_title)) {
		$admin_email_title = "New payment!";
	}

	if(empty($admin_email_message)) {
		$admin_email_message = "Master, you have a new payment: ";
	}

	$blog_title = get_bloginfo('name');

	$emailTo = $admin_email;
    $subject = $admin_email_title; 
    $body = $admin_email_message. "\r\n\r\n" .$planNAME. "\r\n" .$planEMAIL. "\r\n\r\n" .$planPACKAGE. "\r\n" .$planPRICE." ".$planCURRENCY. "\r\n via " .$planTYPE ;
    $headers = 'From website' . "\r\n" . 'Reply-To: ' . $email;
                      
    wp_mail($emailTo, $subject, $body, $headers);

    //=========================================

    //=========================================
	// Send email to subscriber ===============
	//=========================================

	global $redux_demo;
	$admin_email = $redux_demo['contact-email'];
	$user_email_title = $redux_demo['payment-user-title'];
	$user_email_message = $redux_demo['payment-user-message'];

	if(empty($admin_email)) {
		$admin_email = "test@mail.com";
	}

	if(empty($user_email_title)) {
		$user_email_title = "Payment notification!";
	}

	if(empty($user_email_message)) {
		$user_email_message = "Congratulations. Your payment went through!";
	}

	$blog_title = get_bloginfo('name');

	$from  = $admin_email;
	$headers = 'From: '.$from . "\r\n";
    $subject = $user_email_title; 
    $body = $user_email_message. "\r\n\r\n" .$planNAME. "\r\n" .$planEMAIL. "\r\n" .$planPACKAGE. "\r\n" .$planPRICE."".$planCURRENCY. "\r\n" .$planTYPE;
                      
    wp_mail($planEMAIL, $subject, $body, $headers);
}


