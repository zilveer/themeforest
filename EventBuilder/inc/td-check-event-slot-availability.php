<?php

function tdCheckEventSlotAvailabilityForm() {

	$response = 0;

  	if ( isset( $_POST['tdCheckEventSlotAvailability_nonce'] ) && wp_verify_nonce( $_POST['tdCheckEventSlotAvailability_nonce'], 'tdCheckEventSlotAvailability_html' ) ) {

  		global $wpdb;
  		$user_id = $_POST['user_id'];
		$tdSlotId = $_POST['td-slot-id'];
		list($td_slot_type,$td_slot_id) = explode("-",$tdSlotId);

		if($td_slot_type == "regular") {
			
			$postID = $td_slot_id;

			$totalPackages = 0;
			$totalPrice = 0;
			$totalRegularListings = 0;
			$totalRegularListingsUSed = 0;
			$regularListings = 0;
			$totalFeaturedListings = 0;
			$totalFeaturedListingsUSed = 0;
			$featuredListings = 0;

			$user_email = get_the_author_meta('user_email', $user_id);

			$my_transactions = $wpdb->get_results( "SELECT * FROM `td_payments` WHERE email = '".$user_email."' AND package_id = '".$postID."' AND status = 'success' ORDER BY `ID` DESC");

			foreach ($my_transactions as $key) {

				$transaction_id           = $key->id;
				$transaction_package_id   = $key->package_id;
				$transaction_name         = $key->package_name;
				$transaction_price        = $key->price;
				$transaction_currency     = $key->currency;
				$transaction_payment_type = $key->payment_type;
				$transaction_status       = $key->status;
				$transaction_charge_id    = $key->transaction_id;
				$transaction_date         = $key->created;
				$transaction_custom_id    = $key->custom_id;

				$package_events_amount = get_post_meta($transaction_package_id, 'package_events_amount', true);

				$package_items_feat_amount = get_post_meta($transaction_package_id, 'package_items_feat_amount', true);
				if(empty($package_items_feat_amount)) {
					$package_items_feat_amount = 0;
				}

				$regular_listings_used = get_user_meta($user_id, "user_regular_listings_used_".$transaction_custom_id, true);
				if(empty($regular_listings_used)) {
					$regular_listings_used = 0;
				}
				$feat_listings_used = get_user_meta($user_id, "user_featured_listings_used_".$transaction_custom_id, true);
				if(empty($feat_listings_used)) {
					$feat_listings_used = 0;
				}

				$totalRegularListings      = $totalRegularListings + $package_events_amount;
				$totalRegularListingsUSed  = $totalRegularListingsUSed + $regular_listings_used;
				$regularListings           = $totalRegularListings - $totalRegularListingsUSed;

				$totalFeaturedListings     = $totalFeaturedListings + $package_items_feat_amount;
				$totalFeaturedListingsUSed = $totalFeaturedListingsUSed + $feat_listings_used;
				$featuredListings          = $totalFeaturedListings - $totalFeaturedListingsUSed;

			}

			if($regularListings > 0) {

				$response = 1;

			} else {

				$response = 2;

			}

		}

		if($td_slot_type == "featured") {
			
			$postID = $td_slot_id;

			$totalPackages = 0;
			$totalPrice = 0;
			$totalRegularListings = 0;
			$totalRegularListingsUSed = 0;
			$regularListings = 0;
			$totalFeaturedListings = 0;
			$totalFeaturedListingsUSed = 0;
			$featuredListings = 0;

			$user_email = get_the_author_meta('user_email', $user_id);

			$my_transactions = $wpdb->get_results( "SELECT * FROM `td_payments` WHERE email = '".$user_email."' AND package_id = '".$postID."' AND status = 'success' ORDER BY `ID` DESC");

			foreach ($my_transactions as $key) {

				$transaction_id           = $key->id;
				$transaction_package_id   = $key->package_id;
				$transaction_name         = $key->package_name;
				$transaction_price        = $key->price;
				$transaction_currency     = $key->currency;
				$transaction_payment_type = $key->payment_type;
				$transaction_status       = $key->status;
				$transaction_charge_id    = $key->transaction_id;
				$transaction_date         = $key->created;
				$transaction_custom_id    = $key->custom_id;

				$package_events_amount = get_post_meta($transaction_package_id, 'package_events_amount', true);

				$package_items_feat_amount = get_post_meta($transaction_package_id, 'package_items_feat_amount', true);
				if(empty($package_items_feat_amount)) {
					$package_items_feat_amount = 0;
				}

				$regular_listings_used = get_user_meta($user_id, "user_regular_listings_used_".$transaction_custom_id, true);
				if(empty($regular_listings_used)) {
					$regular_listings_used = 0;
				}
				$feat_listings_used = get_user_meta($user_id, "user_featured_listings_used_".$transaction_custom_id, true);
				if(empty($feat_listings_used)) {
					$feat_listings_used = 0;
				}

				$totalRegularListings      = $totalRegularListings + $package_events_amount;
				$totalRegularListingsUSed  = $totalRegularListingsUSed + $regular_listings_used;
				$regularListings           = $totalRegularListings - $totalRegularListingsUSed;

				$totalFeaturedListings     = $totalFeaturedListings + $package_items_feat_amount;
				$totalFeaturedListingsUSed = $totalFeaturedListingsUSed + $feat_listings_used;
				$featuredListings          = $totalFeaturedListings - $totalFeaturedListingsUSed;

			}

			if($featuredListings > 0) {

				$response = 1;

			} else {

				$response = 2;

			}

		}

        //=========================================

	} else {

		$response = 3;

  	}

  	echo esc_attr($response);

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdCheckEventSlotAvailabilityForm', 'tdCheckEventSlotAvailabilityForm' );
add_action( 'wp_ajax_nopriv_tdCheckEventSlotAvailabilityForm', 'tdCheckEventSlotAvailabilityForm' );


