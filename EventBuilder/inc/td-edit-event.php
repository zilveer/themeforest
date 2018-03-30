<?php

function tdEditEventForm() {

	$error = 0;

  	if ( isset( $_POST['tdEditEvent_nonce'] ) && wp_verify_nonce( $_POST['tdEditEvent_nonce'], 'tdEditEvent_html' ) ) {

		$post_id = sanitize_text_field($_POST['post_id']);

		$td_slot_id = get_post_meta($post_id, 'event_package_id', true);

		global $current_user, $user_id, $user_info;
		get_currentuserinfo();
		$user_id = $current_user->ID;

		$post_author_id = get_post_field( 'post_author', $post_id );
		if($post_author_id == $user_id)  { 

			$response = 1;

		} else {

			$response = 2;

		}

		if($response == 1) {

			// Save listing (main settings)
			$post_information = array(
				'ID' => $post_id,
				'post_title' => $_POST['listingFormTitle'],
				'post_content' => $_POST['postContent'],
				'post_type' => 'event',
					'comment_status' => 'open',
					'ping_status' => 'open',
				'post_status' => 'draft'
		  	);

		  	wp_insert_post($post_information);

		  	$postStatus = sanitize_text_field($_POST['postStatus']);
		  	$package_approve_item = get_post_meta($td_slot_id, 'package_approve_item', true);
										
			if(empty($package_approve_item)) {
											
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
			} else {
				$item_ticketailor = "";
			}
			update_post_meta($post_id, 'item_ticket_tailor', $item_ticketailor);

			// Details
			if(isset($_POST['eventStartDate'])) {
				$event_start_date = sanitize_text_field($_POST['eventStartDate']);
			} else {
				$event_start_date = "";
			}
			update_post_meta($post_id, 'event_start_date', $event_start_date);

			if(isset($_POST['eventStartTime'])) {
				$event_start_time = sanitize_text_field($_POST['eventStartTime']);
			} else {
				$event_start_time = "";
			}
			update_post_meta($post_id, 'event_start_time', $event_start_time);

			if(isset($_POST['eventStartDate']) AND isset($_POST['eventStartTime'])) {
				$date = "".$event_start_date." ".$event_start_time."";
				$event_start_date_number = strtotime($date);
			} else {
				$event_start_date_number = "";
			}
			update_post_meta($post_id, 'event_start_date_number', $event_start_date_number);


			if(isset($_POST['eventEndDate'])) {
				$event_end_date = sanitize_text_field($_POST['eventEndDate']);
			} else {
				$event_end_date = "";
			}
			update_post_meta($post_id, 'event_end_date', $event_end_date);

			if(isset($_POST['eventEndTime'])) {
				$event_end_time = sanitize_text_field($_POST['eventEndTime']);
			} else {
				$event_end_time = "";
			}
			update_post_meta($post_id, 'event_end_time', $event_end_time);

			if(isset($_POST['eventEndDate']) AND isset($_POST['eventEndTime'])) {
				$date = "".$event_end_date." ".$event_end_time."";
				$event_end_date_number = strtotime($date);
			} else {
				$event_end_date_number = "";
			}
			update_post_meta($post_id, 'event_end_date_number', $event_end_date_number);

			// Video
			if(isset($_POST['item_video'])) { 
				$item_video = sanitize_text_field($_POST['item_video']);
			} else {
				$item_video = "";
			}
			update_post_meta($post_id, 'event_video', $item_video);
			global $allowed;
			update_post_meta($post_id, 'event_video', $_POST['item_video'], $allowed);

			// Address
			if(isset($_POST['listingFormCountry'])) { 
				$item_address_country = sanitize_text_field($_POST['listingFormCountry']);
			} else {
				$item_address_country = "";
			}
			update_post_meta($post_id, 'event_address_country', $item_address_country);

			if(isset($_POST['listingFormState'])) { 
				$item_address_state = sanitize_text_field($_POST['listingFormState']);
			} else {
				$item_address_state = "";
			}
			update_post_meta($post_id, 'event_address_state', $item_address_state);

			if(isset($_POST['listingFormCity'])) { 
				$item_address_city = sanitize_text_field($_POST['listingFormCity']);
			} else {
				$item_address_city = "";
			}
			update_post_meta($post_id, 'event_address_city', $item_address_city);

			if(isset($_POST['listingFormAddress'])) { 
				$item_address_address = sanitize_text_field($_POST['listingFormAddress']);
			} else {
				$item_address_address = "";
			}
			update_post_meta($post_id, 'event_address_address', $item_address_address);

			if(isset($_POST['listingFormZipCode'])) { 
				$item_address_zip = sanitize_text_field($_POST['listingFormZipCode']);
			} else {
				$item_address_zip = "";
			}
			update_post_meta($post_id, 'event_address_zip', $item_address_zip);

			if(isset($_POST['listingFormPhone'])) { 
				$item_phone = sanitize_text_field($_POST['listingFormPhone']);
			} else {
				$item_phone = "";
			}
			update_post_meta($post_id, 'event_phone', $item_phone);

			if(isset($_POST['listingFormEmail'])) { 
				$item_email = sanitize_text_field($_POST['listingFormEmail']);
			} else {
				$item_email = "";
			}
			update_post_meta($post_id, 'event_email', $item_email);

			if(isset($_POST['listingFormWebsite'])) { 
				$item_website = sanitize_text_field($_POST['listingFormWebsite']);
			} else {
				$item_website = "";
			}
			update_post_meta($post_id, 'event_website', $item_website);

			// Map 
			if(isset($_POST['item_address_latitude'])) { 
				$item_address_latitude = sanitize_text_field($_POST['item_address_latitude']);
			} else {
				$item_address_latitude = "";
			}
			update_post_meta($post_id, 'event_address_latitude', $item_address_latitude);

			if(isset($_POST['item_address_longitude'])) { 
				$item_address_longitude = sanitize_text_field($_POST['item_address_longitude']);
			} else {
				$item_address_longitude = "";
			}
			update_post_meta($post_id, 'event_address_longitude', $item_address_longitude);

			if(isset($_POST['item_address_streetview'])) { 
				$item_address_streetview = sanitize_text_field($_POST['item_address_streetview']); 
			} else {
				$item_address_streetview = "";
			}
			update_post_meta($post_id, 'event_address_streetview', $item_address_streetview);

			if(isset($_POST['item_googleaddress'])) { 
				$item_googleaddress = sanitize_text_field($_POST['item_googleaddress']);
				update_post_meta($post_id, 'event_googleaddress', $item_googleaddress);
			};

			// Amenities
			if(isset($_POST['item_amenities'])) { 
				$event_amenities = sanitize_text_field($_POST['item_amenities']);
			} else {
				$event_amenities = "";
			}
			wp_set_post_terms($post_id, $event_amenities, 'event_tag' );

			// Event Stats
			if(isset($_POST['eventStatsCrowd'])) { 
				$item_crowd = sanitize_text_field($_POST['eventStatsCrowd']);
			} else {
				$item_crowd = "";
			}
			update_post_meta($post_id, 'item_crowd', $item_crowd);

			if(isset($_POST['eventStatsInvolvement'])) { 
				$item_involvement = sanitize_text_field($_POST['eventStatsInvolvement']);
			} else {
				$item_involvement = "";
			}
			update_post_meta($post_id, 'item_involvement', $item_involvement);

			if(isset($_POST['eventStatsPreparation'])) { 
				$item_preparation = sanitize_text_field($_POST['eventStatsPreparation']);
			} else {
				$item_preparation = "";
			}
			update_post_meta($post_id, 'item_preparation', $item_preparation);

			if(isset($_POST['eventStatsTransformation'])) { 
				$item_transformation = sanitize_text_field($_POST['eventStatsTransformation']);
			} else {
				$item_transformation = "";
			}
			update_post_meta($post_id, 'item_transformation', $item_transformation);

			// Social
			if(isset($_POST['item_facebook'])) { 
				$item_facebook = sanitize_text_field($_POST['item_facebook']);
			} else {
				$item_facebook = "";
			}
			update_post_meta($post_id, 'item_facebook', $item_facebook);

			if(isset($_POST['item_foursquare'])) { 
				$item_foursquare = sanitize_text_field($_POST['item_foursquare']);
			} else {
				$item_foursquare = "";
			}
			update_post_meta($post_id, 'item_foursquare', $item_foursquare);

			if(isset($_POST['item_skype'])) { 
				$item_skype = sanitize_text_field($_POST['item_skype']);
			} else {
				$item_skype = "";
			}
			update_post_meta($post_id, 'item_skype', $item_skype);


			if(isset($_POST['item_googleplus'])) { 
				$item_googleplus = sanitize_text_field($_POST['item_googleplus']);
			} else {
				$item_googleplus = "";
			}
			update_post_meta($post_id, 'item_googleplus', $item_googleplus);

			if(isset($_POST['item_twitter'])) { 
				$item_twitter = sanitize_text_field($_POST['item_twitter']);
			} else {
				$item_twitter = "";
			}
			update_post_meta($post_id, 'item_twitter', $item_twitter);

			if(isset($_POST['item_dribbble'])) { 
				$item_dribbble = sanitize_text_field($_POST['item_dribbble']);
			} else {
				$item_dribbble = "";
			}
			update_post_meta($post_id, 'item_dribbble', $item_dribbble);

			if(isset($_POST['item_behance'])) { 
				$item_behance = sanitize_text_field($_POST['item_behance']);
			} else {
				$item_behance = "";
			}
			update_post_meta($post_id, 'item_behance', $item_behance);

			if(isset($_POST['item_linkedin'])) { 
				$item_linkedin = sanitize_text_field($_POST['item_linkedin']);
			} else {
				$item_linkedin = "";
			}
			update_post_meta($post_id, 'item_linkedin', $item_linkedin);

			if(isset($_POST['item_pinterest'])) { 
				$item_pinterest = sanitize_text_field($_POST['item_pinterest']);
			} else {
				$item_pinterest = "";
			}
			update_post_meta($post_id, 'item_pinterest', $item_pinterest);

			if(isset($_POST['item_tumblr'])) { 
				$item_tumblr = sanitize_text_field($_POST['item_tumblr']);
			} else {
				$item_tumblr = "";
			}
			update_post_meta($post_id, 'item_tumblr', $item_tumblr);

			if(isset($_POST['item_youtube'])) { 
				$item_youtube = sanitize_text_field($_POST['item_youtube']);	
			} else {
				$item_youtube = "";
			}
			update_post_meta($post_id, 'item_youtube', $item_youtube);

			if(isset($_POST['item_delicious'])) { 
				$item_delicious = sanitize_text_field($_POST['item_delicious']);
			} else {
				$item_delicious = "";
			}
			update_post_meta($post_id, 'item_delicious', $item_delicious);

			if(isset($_POST['item_medium'])) { 
				$item_medium = sanitize_text_field($_POST['item_medium']);
			} else {
				$item_medium = "";
			}
			update_post_meta($post_id, 'item_medium', $item_medium);

			if(isset($_POST['item_soundcloud'])) { 
				$item_soundcloud = sanitize_text_field($_POST['item_soundcloud']);
			} else {
				$item_soundcloud = "";
			}
			update_post_meta($post_id, 'item_soundcloud', $item_soundcloud);

			// Gallery
			$attachments = get_children(array('post_parent' => $post_id,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order ID'));

			foreach($attachments as $att_id => $attachment) {

				$full_img_id = $attachment->ID;

				$my_post = array(
					'ID' => $full_img_id,
					'post_parent' => ''
				);

				wp_update_post( $my_post );		

			}

			if(isset($_POST['listing-upload-gallery-image-data'])) {
				
				$item_image_gallery = $_POST['listing-upload-gallery-image-data'];

				if(!empty($item_image_gallery)) {

					for ($i = 1; $i <= (count($item_image_gallery)); $i++) {

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

			};
			
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
add_action( 'wp_ajax_tdEditEventForm', 'tdEditEventForm' );
add_action( 'wp_ajax_nopriv_tdEditEventForm', 'tdEditEventForm' );



