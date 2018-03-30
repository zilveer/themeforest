<?php

function tdUploadEventPrimForm() {

	$error = 0;

  	if ( isset( $_POST['tdUploadEventPrimForm_nonce'] ) && wp_verify_nonce( $_POST['tdUploadEventPrimForm_nonce'], 'tdUploadEventPrimForm_html' ) ) {

  		global $wpdb, $td_slot_type, $td_slot_id, $eventsTotal;
  		global $current_user, $user_id, $user_info;
		get_currentuserinfo();
		$user_id = $current_user->ID;

		$tdSlotId = sanitize_text_field($_POST['tdSlotId']);
		list($td_slot_type,$td_slot_id) = explode("-",$tdSlotId);

		if($td_slot_type == "regular") {
			
			$postID = $td_slot_id;

			$totalPackages = 0;
			$totalPrice = 0;
			$totalRegularListings = 0;
			$totalRegularListingsUSed = 0;
			$regularListings = 0;

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

				$package_items_amount = get_post_meta($transaction_package_id, 'package_events_amount', true);

				$regular_listings_used = get_user_meta($user_id, "user_regular_events_used_".$transaction_custom_id, true);
				if(empty($regular_listings_used)) {
					$regular_listings_used = 0;
				}

				$totalRegularListings      = $totalRegularListings + $package_items_amount;
				$totalRegularListingsUSed  = $totalRegularListingsUSed + $regular_listings_used;
				$regularListings           = $totalRegularListings - $totalRegularListingsUSed;

				if($package_items_amount > $regular_listings_used) {
					$customID = $transaction_custom_id;
				}

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

				$package_items_feat_amount = get_post_meta($transaction_package_id, 'package_events_feat_amount', true);
				if(empty($package_items_feat_amount)) {
					$package_items_feat_amount = 0;
				}

				$feat_listings_used = get_user_meta($user_id, "user_featured_events_used_".$transaction_custom_id, true);
				if(empty($feat_listings_used)) {
					$feat_listings_used = 0;
				}

				$totalFeaturedListings     = $totalFeaturedListings + $package_items_feat_amount;
				$totalFeaturedListingsUSed = $totalFeaturedListingsUSed + $feat_listings_used;
				$featuredListings          = $totalFeaturedListings - $totalFeaturedListingsUSed;

				if($package_items_feat_amount > $feat_listings_used) {
					$customID = $transaction_custom_id;
				}

			}

			if($featuredListings > 0) {

				$response = 1;

			} else {

				$response = 2;

			}

		}

		if($response == 1) {

			// Save listing (main settings)
			$post_information = array(
				'post_title' => $_POST['listingFormTitle'],
				'post_content' => $_POST['postContent'],
				'post_type' => 'event',
					'comment_status' => 'open',
					'ping_status' => 'open',
				'post_status' => 'draft'
		  	);

		  	$post_id = wp_insert_post($post_information);

		  	$postStatus = sanitize_text_field($_POST['postStatus']);
		  	$package_approve_item = get_post_meta($td_slot_id, 'package_approve_item', true);

		  	global $redux_demo; 
		  	$package_approve_item = $redux_demo['events-review'];
										
			if($package_approve_item == 1) {
											
				if($postStatus == 'draft') {

				  	$my_post = array(
					  	'ID' => $post_id,
					  	'post_status' => 'draft'
				  	);

				  	wp_update_post( $my_post );

				} else {

				  	$my_post = array(
					  	'ID' => $post_id,
					  	'post_status' => 'publish'
				  	);

				  	wp_update_post( $my_post );

				}
										
			} else {

				if($postStatus == 'draft') {

				  	$my_post = array(
					  	'ID' => $post_id,
					  	'post_status' => 'draft'
				  	);

				  	wp_update_post( $my_post );

				} else {

				  	$my_post = array(
					  	'ID' => $post_id,
					  	'post_status' => 'pending'
				  	);

				  	wp_update_post( $my_post );

				}

				wp_update_post( $my_post );
										
			}

			if(current_user_can('administrator')) {

				if($postStatus == 'draft') {

				  	$my_post = array(
					  	'ID' => $post_id,
					  	'post_status' => 'draft'
				  	);

				  	wp_update_post( $my_post );

				} else {

				  	$my_post = array(
					  	'ID' => $post_id,
					  	'post_status' => 'publish'
				  	);

				  	wp_update_post( $my_post );

				}

			}

			// Listing expiration data
			if($td_slot_type == "regular") {

				$regular_listings_used = get_user_meta($user_id, "user_regular_events_used_".$customID, true);
				$regular_listings_used++;
				update_user_meta($user_id, "user_regular_events_used_".$customID, $regular_listings_used);

				update_post_meta($post_id, 'item_status', 'regular');

			}

			if($td_slot_type == "featured") {

				$feat_listings_used = get_user_meta($user_id, "user_featured_events_used_".$customID, true);
				$feat_listings_used++;
				update_user_meta($user_id, "user_featured_events_used_".$customID, $feat_listings_used);

				update_post_meta($post_id, 'item_status', 'featured');

			}

			update_post_meta($post_id, 'item_package_id', $td_slot_id);

			update_post_meta($post_id, 'event_status', 'upcoming');

			$events_used_slots = get_user_meta($user_id, "user_events_used", true);
			if(empty($events_used_slots)) {
				$events_used_slots = 0;
			}
			$events_used_slots++;
			update_user_meta($user_id, "user_events_used", $events_used_slots);

			$append = false;

			$terms_cat = sanitize_text_field($_POST['listingFormCat']);
			wp_set_post_terms( $post_id, $terms_cat, "event_cat", $append );

			$terms_loc = sanitize_text_field($_POST['listingFormLoc']);
			wp_set_post_terms( $post_id, $terms_loc, "event_loc", $append );

			$event_place = sanitize_text_field($_POST['locationName']);
			wp_insert_term(
                $event_place, // the term 
               	'event_place', // the taxonomy
                array(
                    'description'=> '',
                    'slug' => $event_place,
                    'parent' => 0
                )
            );

            $term_id = term_exists( $event_place, 'event_place', 0 );
            wp_set_post_terms( $post_id, $term_id, "event_place", false );

			// Featured image
			$attach_id = sanitize_text_field($_POST['avatar-image-id']);
			update_post_meta($post_id, '_thumbnail_id', $attach_id);

			// TicketTailor Shortcode
			if(isset($_POST['item_ticketailor'])) { 
				$item_ticketailor = $_POST['item_ticketailor'];
				update_post_meta($post_id, 'item_ticket_tailor', $item_ticketailor);
			};

			// Details
			if(isset($_POST['eventStartDate'])) {
				$event_start_date = sanitize_text_field($_POST['eventStartDate']);
				update_post_meta($post_id, 'event_start_date', $event_start_date);
			}

			if(isset($_POST['eventStartTime'])) {
				$event_start_time = sanitize_text_field($_POST['eventStartTime']);
				update_post_meta($post_id, 'event_start_time', $event_start_time);
			}

			if(isset($_POST['eventStartDate']) AND isset($_POST['eventStartTime'])) {
				$date = "".$event_start_date." ".$event_start_time."";
				$event_start_date_number = strtotime($date);
				update_post_meta($post_id, 'event_start_date_number', $event_start_date_number);
			}


			if(isset($_POST['eventEndDate'])) {
				$event_end_date = sanitize_text_field($_POST['eventEndDate']);
				update_post_meta($post_id, 'event_end_date', $event_end_date);
			}

			if(isset($_POST['eventEndTime'])) {
				$event_end_time = sanitize_text_field($_POST['eventEndTime']);
				update_post_meta($post_id, 'event_end_time', $event_end_time);
			}

			if(isset($_POST['eventEndDate']) AND isset($_POST['eventEndTime'])) {
				$date = "".$event_end_date." ".$event_end_time."";
				$event_end_date_number = strtotime($date);
				update_post_meta($post_id, 'event_end_date_number', $event_end_date_number);
			}

			// Video
			if(isset($_POST['item_video'])) { 
				$item_video = sanitize_text_field($_POST['item_video']);
				update_post_meta($post_id, 'event_video', $item_video);
			}

			global $allowed;
			update_post_meta($post_id, 'event_video', $_POST['item_video'], $allowed);

			// Address
			if(isset($_POST['listingFormCountry'])) { $item_address_country = sanitize_text_field($_POST['listingFormCountry']); };
			update_post_meta($post_id, 'event_address_country', $item_address_country);

			if(isset($_POST['listingFormState'])) { $item_address_state = sanitize_text_field($_POST['listingFormState']); };
			update_post_meta($post_id, 'event_address_state', $item_address_state);

			if(isset($_POST['listingFormCity'])) { $item_address_city = sanitize_text_field($_POST['listingFormCity']); };
			update_post_meta($post_id, 'event_address_city', $item_address_city);

			if(isset($_POST['listingFormAddress'])) { $item_address_address = sanitize_text_field($_POST['listingFormAddress']); };
			update_post_meta($post_id, 'event_address_address', $item_address_address);

			if(isset($_POST['listingFormZipCode'])) { $item_address_zip = sanitize_text_field($_POST['listingFormZipCode']); };
			update_post_meta($post_id, 'event_address_zip', $item_address_zip);

			if(isset($_POST['listingFormPhone'])) { $item_phone = sanitize_text_field($_POST['listingFormPhone']); };
			update_post_meta($post_id, 'event_phone', $item_phone);

			if(isset($_POST['listingFormEmail'])) { $item_email = sanitize_text_field($_POST['listingFormEmail']); };
			update_post_meta($post_id, 'event_email', $item_email);

			if(isset($_POST['listingFormWebsite'])) { $item_website = sanitize_text_field($_POST['listingFormWebsite']); };
			update_post_meta($post_id, 'event_website', $item_website);

			// Map 
			if(isset($_POST['item_address_latitude'])) { $item_address_latitude = sanitize_text_field($_POST['item_address_latitude']); };
			update_post_meta($post_id, 'event_address_latitude', $item_address_latitude);

			if(isset($_POST['item_address_longitude'])) { $item_address_longitude = sanitize_text_field($_POST['item_address_longitude']); };
			update_post_meta($post_id, 'event_address_longitude', $item_address_longitude);

			if(isset($_POST['item_address_streetview'])) { 
				$item_address_streetview = sanitize_text_field($_POST['item_address_streetview']); 
				update_post_meta($post_id, 'event_address_streetview', $item_address_streetview);
			};

			if(isset($_POST['item_googleaddress'])) { $item_googleaddress = sanitize_text_field($_POST['item_googleaddress']); };
			update_post_meta($post_id, 'event_googleaddress', $item_googleaddress);

			// Amenities
			if(isset($_POST['item_amenities'])) { 
				$event_amenities = sanitize_text_field($_POST['item_amenities']);
				wp_set_post_terms($post_id, $event_amenities, 'event_tag' );
			};

			// Social
			if(isset($_POST['item_facebook'])) { $item_facebook = sanitize_text_field($_POST['item_facebook']); };
			update_post_meta($post_id, 'item_facebook', $item_facebook);

			if(isset($_POST['item_foursquare'])) { $item_foursquare = sanitize_text_field($_POST['item_foursquare']); };
			update_post_meta($post_id, 'item_foursquare', $item_foursquare);

			if(isset($_POST['item_skype'])) { 
				$item_skype = sanitize_text_field($_POST['item_skype']);
				update_post_meta($post_id, 'item_skype', $item_skype);
			}

			// Event Stats
			if(isset($_POST['eventStatsCrowd'])) { 
				$item_crowd = sanitize_text_field($_POST['eventStatsCrowd']);
				update_post_meta($post_id, 'item_crowd', $item_crowd);
			}

			if(isset($_POST['eventStatsInvolvement'])) { 
				$item_involvement = sanitize_text_field($_POST['eventStatsInvolvement']);
				update_post_meta($post_id, 'item_involvement', $item_involvement);
			}

			if(isset($_POST['eventStatsPreparation'])) { 
				$item_preparation = sanitize_text_field($_POST['eventStatsPreparation']);
				update_post_meta($post_id, 'item_preparation', $item_preparation);
			}

			if(isset($_POST['eventStatsTransformation'])) { 
				$item_transformation = sanitize_text_field($_POST['eventStatsTransformation']);
				update_post_meta($post_id, 'item_transformation', $item_transformation);
			}


			if(isset($_POST['item_googleplus'])) { $item_googleplus = sanitize_text_field($_POST['item_googleplus']); };
			update_post_meta($post_id, 'item_googleplus', $item_googleplus);

			if(isset($_POST['item_twitter'])) { $item_twitter = sanitize_text_field($_POST['item_twitter']); };
			update_post_meta($post_id, 'item_twitter', $item_twitter);

			if(isset($_POST['item_dribbble'])) { $item_dribbble = sanitize_text_field($_POST['item_dribbble']); };
			update_post_meta($post_id, 'item_dribbble', $item_dribbble);

			if(isset($_POST['item_behance'])) { $item_behance = sanitize_text_field($_POST['item_behance']); };
			update_post_meta($post_id, 'item_behance', $item_behance);

			if(isset($_POST['item_linkedin'])) { $item_linkedin = sanitize_text_field($_POST['item_linkedin']); };
			update_post_meta($post_id, 'item_linkedin', $item_linkedin);

			if(isset($_POST['item_pinterest'])) { $item_pinterest = sanitize_text_field($_POST['item_pinterest']); };
			update_post_meta($post_id, 'item_pinterest', $item_pinterest);

			if(isset($_POST['item_tumblr'])) { $item_tumblr = sanitize_text_field($_POST['item_tumblr']); };
			update_post_meta($post_id, 'item_tumblr', $item_tumblr);

			if(isset($_POST['item_youtube'])) { $item_youtube = sanitize_text_field($_POST['item_youtube']); };
			update_post_meta($post_id, 'item_youtube', $item_youtube);

			if(isset($_POST['item_delicious'])) { $item_delicious = sanitize_text_field($_POST['item_delicious']); };
			update_post_meta($post_id, 'item_delicious', $item_delicious);

			if(isset($_POST['item_medium'])) { $item_medium = sanitize_text_field($_POST['item_medium']); };
			update_post_meta($post_id, 'item_medium', $item_medium);

			if(isset($_POST['item_soundcloud'])) { $item_soundcloud = sanitize_text_field($_POST['item_soundcloud']); };
			update_post_meta($post_id, 'item_soundcloud', $item_soundcloud);

			// Gallery
			$item_image_gallery = $_POST['listing-upload-gallery-image-data'];

			if(!empty($item_image_gallery)) {

				for ($i = 0; $i <= (count($item_image_gallery)-1); $i++) {

					$attachID = $item_image_gallery[$i][1];

					if(!empty($attachID)) {

						$my_post = array(
					      	'ID' => $attachID,
					      	'post_parent' => $post_id
					  	);

					  	wp_update_post( $my_post );

					}

				}

			}
			
			$error = 0;

		} else {

			$error = 1;

		}

        //=========================================

	} else {

		$error = 1;

  	}

  	echo esc_attr($error);

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdUploadEventPrimForm', 'tdUploadEventPrimForm' );
add_action( 'wp_ajax_nopriv_tdUploadEventPrimForm', 'tdUploadEventPrimForm' );



