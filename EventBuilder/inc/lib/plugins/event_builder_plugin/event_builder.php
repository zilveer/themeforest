<?php

	/*
	Plugin Name: Event Builder Plugin
	Plugin URI: hhttp://themesdojo.com/
	Description: Declares custom post types for Event Builder WordPress Theme.
	Version: 1.0.0
	Author: Alex Gurghis
	Author URI: http://alexgurghis.com/
	License: Commercial
	*/

	/*------------------------------------------------------------------
		Events Custom Post Types
	-------------------------------------------------------------------*/
	function post_type_event() {
		$labels = array(
	    	'name' => __('Event', 'post type general name', 'themesdojo'),
	    	'singular_name' => __('Event', 'post type singular name', 'themesdojo'),
	    	'add_new' => __('Add New Event', 'book', 'themesdojo'),
	    	'add_new_item' => __('Add New Event', 'themesdojo'),
	    	'edit_item' => __('Edit Event', 'themesdojo'),
	    	'new_item' => __('New Event', 'themesdojo'),
	    	'view_item' => __('View Event', 'themesdojo'),
	    	'search_items' => __('Search event', 'themesdojo'),
	    	'not_found' =>  __('No event found', 'themesdojo'),
	    	'not_found_in_trash' => __('No event found in Trash', 'themesdojo'), 
	    	'parent_item_colon' => ''
		);		
		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
	    	'publicly_queryable' => true,
	    	'show_ui' => true, 
	    	'query_var' => true,
	    	'rewrite' => true,
	    	'capability_type' => 'post',
	    	'hierarchical' => false,
	    	'menu_position' => null,
	    	'supports' => array('title','editor','thumbnail','author', 'comments', 'amenities'),
	    	'menu_icon' => 'dashicons-tickets-alt'
		); 		

		register_post_type( 'event', $args );	
							  
	} 
									  
	add_action('init', 'post_type_event');

	function td_event_amenities() {

			$labels = array(			  
		  	  	'name' => __( 'Tags', 'taxonomy general name' , 'themesdojo'),
		  	  	'singular_name' => __( 'Tags', 'taxonomy singular name' , 'themesdojo'),
		  	  	'search_items' =>  __( 'Search Tags', 'themesdojo'),
		  	  	'all_items' => __( 'All Amenities', 'themesdojo' ),
		  	  	'parent_item' => __( 'Parent Tags', 'themesdojo' ),
		  	  	'parent_item_colon' => __( 'Parent Tags:', 'themesdojo' ),
		  	  	'edit_item' => __( 'Edit Tags', 'themesdojo' ), 
		  	  	'update_item' => __( 'Update Tags', 'themesdojo' ),
		  	  	'add_new_item' => __( 'Add New Tags', 'themesdojo' ),
		  	  	'new_item_name' => __( 'New Tags Name', 'themesdojo' ),
		  	); 							  
		  	
		  	register_taxonomy(
				'event_tag',
				'event',
				array(
					'hierarchical' => false,
					'labels'=> $labels,
					'query_var' => 'event_tag',
					'rewrite' => true,
				)
			);

	}
	add_action( 'init', 'td_event_amenities', 0 );

	function td_event_category() {

			$labels = array(			  
		  	  	'name' => __( 'Categories', 'taxonomy general name' , 'themesdojo'),
		  	  	'singular_name' => __( 'Category', 'taxonomy singular name' , 'themesdojo'),
		  	  	'search_items' =>  __( 'Search Category', 'themesdojo'),
		  	  	'all_items' => __( 'All Categories', 'themesdojo' ),
		  	  	'parent_item' => __( 'Parent Category', 'themesdojo' ),
		  	  	'parent_item_colon' => __( 'Parent Category:', 'themesdojo' ),
		  	  	'edit_item' => __( 'Edit Category', 'themesdojo' ), 
		  	  	'update_item' => __( 'Update Category', 'themesdojo' ),
		  	  	'add_new_item' => __( 'Add New Category', 'themesdojo' ),
		  	  	'new_item_name' => __( 'New Category Name', 'themesdojo' ),
		  	); 							  
		  	
		  	register_taxonomy(
				'event_cat',
				'event',
				array(
					'public'=>true,
					'hierarchical' => true,
					'labels'=> $labels,
					'query_var' => 'event_cat',
					'show_ui' => true,
					'rewrite' => array( 'slug' => 'event_cat', 'with_front' => false ),
				)
			);

	}
	add_action( 'init', 'td_event_category', 0 );

	function td_event_place() {

			$labels = array(			  
		  	  	'name' => __( 'Places', 'taxonomy general name' , 'themesdojo'),
		  	  	'singular_name' => __( 'Place', 'taxonomy singular name' , 'themesdojo'),
		  	  	'search_items' =>  __( 'Search Place', 'themesdojo'),
		  	  	'all_items' => __( 'All Places', 'themesdojo' ),
		  	  	'parent_item' => __( 'Parent Place', 'themesdojo' ),
		  	  	'parent_item_colon' => __( 'Parent Place:', 'themesdojo' ),
		  	  	'edit_item' => __( 'Edit Place', 'themesdojo' ), 
		  	  	'update_item' => __( 'Update Place', 'themesdojo' ),
		  	  	'add_new_item' => __( 'Add New Place', 'themesdojo' ),
		  	  	'new_item_name' => __( 'New Place Name', 'themesdojo' ),
		  	); 							  
		  	
		  	register_taxonomy(
				'event_place',
				'event',
				array(
					'public'=>true,
					'hierarchical' => true,
					'labels'=> $labels,
					'query_var' => 'event_place',
					'show_ui' => true,
					'rewrite' => array( 'slug' => 'event_place', 'with_front' => false ),
				)
			);

	}
	add_action( 'init', 'td_event_place', 0 );

	function td_event_location() {

			$labels = array(			  
		  	  	'name' => __( 'Locations', 'taxonomy general name' , 'themesdojo'),
		  	  	'singular_name' => __( 'Location', 'taxonomy singular name' , 'themesdojo'),
		  	  	'search_items' =>  __( 'Search Location', 'themesdojo'),
		  	  	'all_items' => __( 'All Locations', 'themesdojo' ),
		  	  	'parent_item' => __( 'Parent Location', 'themesdojo' ),
		  	  	'parent_item_colon' => __( 'Parent Location:', 'themesdojo' ),
		  	  	'edit_item' => __( 'Edit Location', 'themesdojo' ), 
		  	  	'update_item' => __( 'Update Location', 'themesdojo' ),
		  	  	'add_new_item' => __( 'Add New Location', 'themesdojo' ),
		  	  	'new_item_name' => __( 'New Location Name', 'themesdojo' ),
		  	); 							  
		  	
		  	register_taxonomy(
				'event_loc',
				'event',
				array(
					'public'=>true,
					'hierarchical' => true,
					'labels'=> $labels,
					'query_var' => 'event_loc',
					'show_ui' => true,
					'rewrite' => array( 'slug' => 'event_loc', 'with_front' => false ),
				)
			);

	}
	add_action( 'init', 'td_event_location', 0 );

	/**************************************
	Custom Post Meta Boxes
	***************************************/

	/*--------------------------------------*/
	/*        Featured Post Option          */
	/*--------------------------------------*/
	add_action('add_meta_boxes', 'register_event_settings');
	function register_event_settings () {
		add_meta_box('themesdojo_events', 'Event Details', 'display_events','event');
	}

	function display_events ($post) { 

		// Location & Date
		$event_start_date = get_post_meta($post->ID, 'event_start_date', true);
		$event_start_time = get_post_meta($post->ID, 'event_start_time', true);
		$event_end_date = get_post_meta($post->ID, 'event_end_date', true);
		$event_end_time = get_post_meta($post->ID, 'event_end_time', true);
		$event_location = get_post_meta($post->ID, 'event_location', true);

		// Event Stats
		$item_crowd = get_post_meta($post->ID, 'item_crowd', true);
		$item_involvement = get_post_meta($post->ID, 'item_involvement', true);
		$item_preparation = get_post_meta($post->ID, 'item_preparation', true);
		$item_transformation = get_post_meta($post->ID, 'item_transformation', true);

		// Social
		$item_facebook = get_post_meta($post->ID, 'item_facebook', true);
		$item_foursquare = get_post_meta($post->ID, 'item_foursquare', true);
		$item_skype = get_post_meta($post->ID, 'item_skype', true);
		$item_googleplus = get_post_meta($post->ID, 'item_googleplus', true);
		$item_twitter = get_post_meta($post->ID, 'item_twitter', true);
		$item_dribbble = get_post_meta($post->ID, 'item_dribbble', true);
		$item_behance = get_post_meta($post->ID, 'item_behance', true);
		$item_linkedin = get_post_meta($post->ID, 'item_linkedin', true);
		$item_pinterest = get_post_meta($post->ID, 'item_pinterest', true);
		$item_tumblr = get_post_meta($post->ID, 'item_tumblr', true);
		$item_youtube = get_post_meta($post->ID, 'item_youtube', true);
		$item_delicious = get_post_meta($post->ID, 'item_delicious', true);
		$item_medium = get_post_meta($post->ID, 'item_medium', true);
		$item_soundcloud = get_post_meta($post->ID, 'item_soundcloud', true);

		// Address & Contact Details
		$event_address_country = get_post_meta($post->ID, 'event_address_country', true);
		$event_address_state = get_post_meta($post->ID, 'event_address_state', true);
		$event_address_city = get_post_meta($post->ID, 'event_address_city', true);
		$event_address_address = get_post_meta($post->ID, 'event_address_address', true);
		$event_address_zip = get_post_meta($post->ID, 'event_address_zip', true);
		$event_phone = get_post_meta($post->ID, 'event_phone', true);
		$event_email = get_post_meta($post->ID, 'event_email', true);
		$event_website = get_post_meta($post->ID, 'event_website', true);

		$event_address_latitude = get_post_meta($post->ID, 'event_address_latitude', true);
		$event_address_longitude = get_post_meta($post->ID, 'event_address_longitude', true);
		$event_address_streetview = get_post_meta($post->ID, 'event_address_streetview', true);

		if(empty($event_address_latitude)) { $event_address_latitude = 0; };
		if(empty($event_address_longitude)) { $event_address_longitude = 0; };

		$event_googleaddress = get_post_meta($post->ID, 'event_googleaddress', true);

		// Video
		$item_video = get_post_meta($post->ID, 'event_video', true);

		// Ticket
		$item_ticket_tailor = get_post_meta($post->ID, 'item_ticket_tailor', true);

	?>
		
	<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

	<style>
		#options-popup {
			display: block;
		}

		#post-body #normal-sortables {
			display: none;
		}

		#options-popup .option-item {
			background: #FFF;
			margin: 0 -10px 0 -10px;
			border-bottom: 1px solid #EEE;
			padding: 14px 10px 14px 10px;
			width: 100%;
			float: left;
		}

		#options-popup .option-item span.text {
			float: left;
			display: block;
			width: 150px;
			margin-top: 5px;
		}

		#options-popup .option-item .criteria-name {
			float: left;
			margin-right: 36px;
			width: 400px;
		}

		#options-popup .option-item span.text {
			width: 150px;
			margin-right: 10px;
		}

		#options-popup .option-item input {
			float: left;
			margin-right: 20px;
			margin-top: 5px;
		}

		.full {
			width: 100%;
			display: inline-block;
			margin-bottom: 20px;
		}

		.info-text {
			font-style: italic;
			float: left;
			margin-top: 10px;
			width: 70%;
			margin-left: 113px;
		}

		.criteria-image {
			max-width: 590px;
			height: auto;
		}

		.option-item {
			border-bottom: 1px solid #EEE;
			padding: 14px 10px 14px 10px;
			width: 100%;
		}

		.option-item h3 {
			padding-left: 0 !important;
			margin-bottom: 30px !important;
			padding-bottom: 20px !important;
			border-bottom: solid 1px #eee;
		}

		.help-block {
			font-style: italic;
			margin-left: 160px;
			float: left;
		}

		.option-item .rating_slider {
			width: 200px;
			float: left;
			margin-right: 16px;
			margin-top: 6px;
			height: 10px;
		}

		.option-item .slider_value {
			width: 34px;
			margin-right: 12px;
			float: left;
		}

	</style>

	<div id='options-popup'>

		<div id="property-details">

			<!--

			<div class="option-item">

				<h3><?php _e( 'Select Event Slot', 'themesdojo' ); ?></h3>

				<div class="full">

					<select id="select-listing-slot" name="select-listing-slot" style="min-width: 240px;">

						<option value='none' autocomplete="off">None</option>

						<?php	

							global $current_user, $user_id, $user_info;

							$user_id = td_get_current_user_id();

							$myActivePlans = 0;				

							$custom_posts = new WP_Query();
							$custom_posts->query( array('post_type' => 'package',  'posts_per_page' => -1, 'order' => 'DESC' ));

							if ($custom_posts->have_posts()) : while ($custom_posts->have_posts()) : $custom_posts->the_post();

							$postID = get_the_ID();

							$totalPackages = 0;
							$totalPrice = 0;
							$totalRegularListings = 0;
							$totalRegularListingsUSed = 0;
							$regularListings = 0;
							$totalFeaturedListings = 0;
							$totalFeaturedListingsUSed = 0;
							$featuredListings = 0;

							$user_email = get_the_author_meta('user_email', $user_id);

							global $wpdb;
					        $table_name = "td_payments";

					        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

								$my_transactions = $wpdb->get_results( "SELECT * FROM `td_payments` WHERE email = '".$user_email."' AND package_id = '".$postID."' AND status = 'success' ORDER BY `ID` DESC");

							} else {

								$my_transactions = "";

							}

							if(!empty($my_transactions)) {

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

									$regular_listings_used = get_user_meta($user_id, "user_regular_events_used_".$transaction_custom_id, true);
									if(empty($regular_listings_used)) {
										$regular_listings_used = 0;
									}
									$feat_listings_used = get_user_meta($user_id, "user_featured_events_used_".$transaction_custom_id, true);
									if(empty($feat_listings_used)) {
										$feat_listings_used = 0;
									}

									$totalPrice                = $totalPrice + $transaction_price;

									$totalRegularListings      = $totalRegularListings + $package_events_amount;
									$totalRegularListingsUSed  = $totalRegularListingsUSed + $regular_listings_used;
									$regularListings           = $totalRegularListings - $totalRegularListingsUSed;

									$totalFeaturedListings     = $totalFeaturedListings + $package_items_feat_amount;
									$totalFeaturedListingsUSed = $totalFeaturedListingsUSed + $feat_listings_used;
									$featuredListings          = $totalFeaturedListings - $totalFeaturedListingsUSed;

									$totalPackages++;

						?>

						<?php

							}

							if(($totalPackages > 0)) {

								if(($featuredListings > 0) OR ($regularListings > 0)) {

									if($regularListings > 0) {

										$myActivePlans++;

						?>

							<option value='regular-<?php echo esc_attr($transaction_package_id); ?>' autocomplete="off"><?php the_title(); ?> - <?php echo esc_attr($regularListings); ?> <?php _e( 'Slots available for', 'themesdojo' ); ?></option>

						<?php } ?>

						<?php } } } ?>
											
						<?php endwhile; endif; ?>
						<?php wp_reset_postdata(); ?>

					</select>

				</div>

			</div>

			-->

			<div class="option-item">

				<h3><?php _e( 'Event Details', 'themesdojo' ); ?></h3>

				<div class="full">
					<span class='text'><?php _e( 'Place Name (Building/Facility)', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_location' name='event_location' value='<?php if(!empty($event_location)) { echo esc_attr($event_location); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Event Start Date', 'themesdojo' ); ?></span>
					<input style="width: 150px;" type='text' id='event_start_date' name='event_start_date' value='<?php if(!empty($event_start_date)) { echo esc_attr($event_start_date); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Event Start Time', 'themesdojo' ); ?></span>
					<input style="width: 150px;" type='text' id='event_start_time' name='event_start_time' value='<?php if(!empty($event_start_time)) { echo esc_attr($event_start_time); } ?>' placeholder="">
				</div>

				<script type="text/javascript">

					jQuery(document).ready(function($) {

						jQuery( "#event_start_date" ).datepicker();

					});

				</script>

				<div class="full">
					<span class='text'><?php _e( 'Event End Date', 'themesdojo' ); ?></span>
					<input style="width: 150px;" type='text' id='event_end_date' name='event_end_date' value='<?php if(!empty($event_end_date)) { echo esc_attr($event_end_date); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Event End Time', 'themesdojo' ); ?></span>
					<input style="width: 150px;" type='text' id='event_end_time' name='event_end_time' value='<?php if(!empty($event_end_time)) { echo esc_attr($event_end_time); } ?>' placeholder="">
				</div>

				<script type="text/javascript">

					jQuery(document).ready(function($) {

						jQuery( "#event_end_date" ).datepicker();

					});

				</script>
					
			</div>

			<div class="option-item">

				<h3><?php _e( 'Event Stats', 'themesdojo' ); ?></h3>

				<div class="full">
					<span class='text'><?php _e( 'Crowd', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='eventStatsCrowd' name='eventStatsCrowd' value='<?php if(!empty($item_crowd)) { echo esc_attr($item_crowd); } ?>' placeholder="80">
					<p class="help-block" style="margin-top: 5px; margin-left: 0;"><?php _e( 'Add crowd percent (ex: 80)', 'themesdojo' ); ?></p>
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Involvement', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='eventStatsInvolvement' name='eventStatsInvolvement' value='<?php if(!empty($item_involvement)) { echo esc_attr($item_involvement); } ?>' placeholder="80">
					<p class="help-block" style="margin-top: 5px; margin-left: 0;"><?php _e( 'Add involvement percent (ex: 80)', 'themesdojo' ); ?></p>
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Preparation', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='eventStatsPreparation' name='eventStatsPreparation' value='<?php if(!empty($item_preparation)) { echo esc_attr($item_preparation); } ?>' placeholder="80">
					<p class="help-block" style="margin-top: 5px; margin-left: 0;"><?php _e( 'Add preparation percent (ex: 80)', 'themesdojo' ); ?></p>
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Transformation', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='eventStatsTransformation' name='eventStatsTransformation' value='<?php if(!empty($item_transformation)) { echo esc_attr($item_transformation); } ?>' placeholder="80">
					<p class="help-block" style="margin-top: 5px; margin-left: 0;"><?php _e( 'Add transformation percent (ex: 80)', 'themesdojo' ); ?></p>
				</div>
					
			</div>

			<div class="option-item">

				<h3><?php _e( 'Address', 'themesdojo' ); ?></h3>

				<div class="full">
					<span class='text'><?php _e( 'Country', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_address_country' name='event_address_country' value='<?php if(!empty($event_address_country)) { echo esc_attr($event_address_country); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'State', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_address_state' name='event_address_state' value='<?php if(!empty($event_address_state)) { echo esc_attr($event_address_state); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'City', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_address_city' name='event_address_city' value='<?php if(!empty($event_address_city)) { echo esc_attr($event_address_city); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Address', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_address_address' name='event_address_address' value='<?php if(!empty($event_address_address)) { echo esc_attr($event_address_address); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Zip Code', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_address_zip' name='event_address_zip' value='<?php if(!empty($event_address_zip)) { echo esc_attr($event_address_zip); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Phone', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_phone' name='event_phone' value='<?php if(!empty($event_phone)) { echo esc_attr($event_phone); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'E-Mail', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_email' name='event_email' value='<?php if(!empty($event_email)) { echo esc_attr($event_email); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Website', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='event_website' name='event_website' value='<?php if(!empty($event_website)) { echo esc_attr($event_website); } ?>' placeholder="">
				</div>
					
			</div>

			<div class="option-item">

				<h3><?php _e( 'Social links', 'themesdojo' ); ?></h3>

				<div class="full">
					<span class='text'><?php _e( 'Facebook', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_facebook' name='item_facebook' value='<?php if(!empty($item_facebook)) { echo esc_attr($item_facebook); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Foursquare', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_foursquare' name='item_foursquare' value='<?php if(!empty($item_foursquare)) { echo esc_attr($item_foursquare); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Skype', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_skype' name='item_skype' value='<?php if(!empty($item_skype)) { echo esc_attr($item_skype); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Google+', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_googleplus' name='item_googleplus' value='<?php if(!empty($item_googleplus)) { echo esc_attr($item_googleplus); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Twitter', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_twitter' name='item_twitter' value='<?php if(!empty($item_twitter)) { echo esc_attr($item_twitter); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Dribbble', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_dribbble' name='item_dribbble' value='<?php if(!empty($item_dribbble)) { echo esc_attr($item_dribbble); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Behance', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_behance' name='item_behance' value='<?php if(!empty($item_behance)) { echo esc_attr($item_behance); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'LinkedIn', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_linkedin' name='item_linkedin' value='<?php if(!empty($item_linkedin)) { echo esc_attr($item_linkedin); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Pinterest', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_pinterest' name='item_pinterest' value='<?php if(!empty($item_pinterest)) { echo esc_attr($item_pinterest); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Tumblr', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_tumblr' name='item_tumblr' value='<?php if(!empty($item_tumblr)) { echo esc_attr($item_tumblr); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Youtube', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_youtube' name='item_youtube' value='<?php if(!empty($item_youtube)) { echo esc_attr($item_youtube); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Delicious', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_delicious' name='item_delicious' value='<?php if(!empty($item_delicious)) { echo esc_attr($item_delicious); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Medium', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_medium' name='item_medium' value='<?php if(!empty($item_medium)) { echo esc_attr($item_medium); } ?>' placeholder="">
				</div>

				<div class="full">
					<span class='text'><?php _e( 'Soundcloud', 'themesdojo' ); ?></span>
					<input style="width: 550px;" type='text' id='item_soundcloud' name='item_soundcloud' value='<?php if(!empty($item_soundcloud)) { echo esc_attr($item_soundcloud); } ?>' placeholder="">
				</div>
					
			</div>

			<div class="option-item" id="map-container">

				<div class="full">
					<span class='text overall'><?php _e( 'Google Map Address', 'themesdojo' ); ?></span>

					<input id="address" name="event_googleaddress" type="text" value="<?php echo esc_attr($event_googleaddress); ?>" style="width: 550px; float: left;">

					<p class="help-block" style="margin-top: 5px; margin-left: 0;"><?php _e('Start typing an address and select from the dropdown.', 'themesdojo') ?></p>
				</div>

				
				<div id="map-canvas"></div>

				<style>

					#map-canvas {
						display: block;
						width: 710px;
						height: 370px;
						position: relative;
						margin-bottom: 10px;
					}

				</style>

				<script type="text/javascript">

					jQuery(document).ready(function($) {

						var geocoder;
						var map;
						var marker;

						var geocoder = new google.maps.Geocoder();

						function geocodePosition(pos) {
							geocoder.geocode({
								latLng: pos
							}, function(responses) {
								if (responses && responses.length > 0) {
									updateMarkerAddress(responses[0].formatted_address);
								} else {
									updateMarkerAddress('Cannot determine address at this location.');
								}
							});
						}

						function updateMarkerPosition(latLng) {
							jQuery('#latitude').val(latLng.lat());
							jQuery('#longitude').val(latLng.lng());
						}

						function updateMarkerAddress(str) {
							jQuery('#address').val(str);
						}

						function initialize() {

							var latlng = new google.maps.LatLng(<?php echo esc_attr($event_address_latitude); ?>, <?php echo esc_attr($event_address_longitude); ?>);
							var mapOptions = {
								zoom: 16,
								center: latlng
							}

							map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

							geocoder = new google.maps.Geocoder();

							marker = new google.maps.Marker({
								position: latlng,
								map: map,
								draggable: true
							});

							// Add dragging event listeners.
							google.maps.event.addListener(marker, 'dragstart', function() {
								updateMarkerAddress('Dragging...');
							});
									  
							google.maps.event.addListener(marker, 'drag', function() {
								updateMarkerPosition(marker.getPosition());
							});
									  
							google.maps.event.addListener(marker, 'dragend', function() {
								geocodePosition(marker.getPosition());
							});

						}

						google.maps.event.addDomListener(window, 'load', initialize);

						jQuery(document).ready(function() { 
									         
							initialize();
									          
							jQuery(function() {
								jQuery("#address").autocomplete({
								//This bit uses the geocoder to fetch address values
								source: function(request, response) {
									        geocoder.geocode( {'address': request.term }, function(results, status) {
									          response(jQuery.map(results, function(item) {
									            return {
									              label:  item.formatted_address,
									              value: item.formatted_address,
									              latitude: item.geometry.location.lat(),
									              longitude: item.geometry.location.lng()
									            }
									          }));
									        })
								},
								//This bit is executed upon selection of an address
								select: function(event, ui) {
									jQuery("#latitude").val(ui.item.latitude);
									jQuery("#longitude").val(ui.item.longitude);

									var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);

									marker.setPosition(location);
									map.setZoom(16);
									map.setCenter(location);

								}
							});
						});
									  
						//Add listener to marker for reverse geocoding
						google.maps.event.addListener(marker, 'drag', function() {
							geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
								if (status == google.maps.GeocoderStatus.OK) {
									if (results[0]) {
									        jQuery('#address').val(results[0].formatted_address);
									        jQuery('#latitude').val(marker.getPosition().lat());
									        jQuery('#longitude').val(marker.getPosition().lng());
									    }
									}
								});
							});
									  
						});

					});

				</script>

			</div>

			<div class="option-item" style="height: 24px;">
				
				<span class='text overall'><?php _e( 'Latitude', 'themesdojo' ); ?></span>

				<input type="text" id="latitude" name="event_address_latitude" value="<?php echo esc_attr($event_address_latitude); ?>" size="12" maxlength="10" class="form-text required">
				
			</div>

			<div class="option-item" style="height: 24px;">
				
				<span class='text overall'><?php _e( 'Longitude', 'themesdojo' ); ?></span>

				<input type="text" id="longitude" name="event_address_longitude" value="<?php echo esc_attr($event_address_longitude); ?>" size="12" maxlength="10" class="form-text required">
				
			</div>

			<div class="option-item" style="height: 24px;">
				
				<span class='text overall'><?php _e( 'Enable Streetview', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="event_address_streetview" title="<?php echo $event_address_streetview; ?>" value="enabled-streetview" <?php if(!empty($event_address_streetview)) { ?>checked<?php } ?>>
				
			</div>

			<div class="option-item">

				<h3><?php _e( 'Video', 'themesdojo' ); ?></h3>

				<div class="full">
					<span class='text'><?php _e( 'Video Embeded Code (Youtube and Vimeo)', 'themesdojo' ); ?></span>
					<textarea style="width: 550px;" type='text' cols="70" rows="7" id='item_video' name='item_video'><?php if(!empty($item_video)) { echo $item_video; } ?></textarea>
				</div>
					
			</div>

			<div class="option-item">
				
				<h3><?php _e( 'Tickets', 'themesdojo' ); ?></h3>

				<div class="full">
					<span class='text'><?php _e( 'Buy Ticket Shortcode (Tickera or TicketTailor):', 'themesdojo' ); ?></span>
					<textarea style="width: 550px;" type='text' cols="70" rows="7" id='item_ticketailor' name='item_ticketailor'><?php if(!empty($item_ticket_tailor)) { echo $item_ticket_tailor; } ?></textarea>
					<p><?php _e( 'Add TicketTailor or Tickera shortcode here (<a href="http://www.tickettailor.com/?rf=ur8178-ex">https://www.tickettailor.com</a> or <a href="https://tickera.com/">https://tickera.com/</a>)', 'themesdojo' ); ?></p>
				</div>
				
			</div>

			<br>

		</div>


	</div>	<!-- end review_options_pop -->


	<?php

	}

	
	add_action ('save_post', 'update_events_settings');
	
	function update_events_settings ( $post_id ) {
		// verify nonce.  

		if (!isset($_POST['cmb_nonce'])) {
				return false;		
		}

		if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__))) {
			return false;
		}

		global  $allowed;

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

		
		// Location
		if(isset($_POST['event_location'])) { $event_location = sanitize_text_field($_POST['event_location']); };
		if(!empty($event_location)){
			update_post_meta($post_id, 'event_location', $event_location);
		}

		// Social
		if(isset($_POST['item_facebook'])) { $item_facebook = sanitize_text_field($_POST['item_facebook']); };
		if(!empty($item_facebook)){
			update_post_meta($post_id, 'item_facebook', $item_facebook);
		}

		if(isset($_POST['item_foursquare'])) { $item_foursquare = sanitize_text_field($_POST['item_foursquare']); };
		if(!empty($item_foursquare)){
			update_post_meta($post_id, 'item_foursquare', $item_foursquare);
		}

		if(isset($_POST['item_skype'])) { $item_skype = sanitize_text_field($_POST['item_skype']); };
		if(!empty($item_skype)){
			update_post_meta($post_id, 'item_skype', $item_skype);
		}

		if(isset($_POST['item_googleplus'])) { $item_googleplus = sanitize_text_field($_POST['item_googleplus']); };
		if(!empty($item_googleplus)){
			update_post_meta($post_id, 'item_googleplus', $item_googleplus);
		}

		if(isset($_POST['item_twitter'])) { $item_twitter = sanitize_text_field($_POST['item_twitter']); };
		if(!empty($item_twitter)){
			update_post_meta($post_id, 'item_twitter', $item_twitter);
		}

		if(isset($_POST['item_dribbble'])) { $item_dribbble = sanitize_text_field($_POST['item_dribbble']); };
		if(!empty($item_dribbble)){
			update_post_meta($post_id, 'item_dribbble', $item_dribbble);
		}

		if(isset($_POST['item_behance'])) { $item_behance = sanitize_text_field($_POST['item_behance']); };
		if(!empty($item_behance)){
			update_post_meta($post_id, 'item_behance', $item_behance);
		}

		if(isset($_POST['item_linkedin'])) { $item_linkedin = sanitize_text_field($_POST['item_linkedin']); };
		if(!empty($item_linkedin)){
			update_post_meta($post_id, 'item_linkedin', $item_linkedin);
		}

		if(isset($_POST['item_pinterest'])) { $item_pinterest = sanitize_text_field($_POST['item_pinterest']); };
		if(!empty($item_pinterest)){
			update_post_meta($post_id, 'item_pinterest', $item_pinterest);
		}

		if(isset($_POST['item_tumblr'])) { $item_tumblr = sanitize_text_field($_POST['item_tumblr']); };
		if(!empty($item_tumblr)){
			update_post_meta($post_id, 'item_tumblr', $item_tumblr);
		}

		if(isset($_POST['item_youtube'])) { $item_youtube = sanitize_text_field($_POST['item_youtube']); };
		if(!empty($item_youtube)){
			update_post_meta($post_id, 'item_youtube', $item_youtube);
		}

		if(isset($_POST['item_delicious'])) { $item_delicious = sanitize_text_field($_POST['item_delicious']); };
		if(!empty($item_delicious)){
			update_post_meta($post_id, 'item_delicious', $item_delicious);
		}

		if(isset($_POST['item_medium'])) { $item_medium = sanitize_text_field($_POST['item_medium']); };
		if(!empty($item_medium)){
			update_post_meta($post_id, 'item_medium', $item_medium);
		}

		if(isset($_POST['item_soundcloud'])) { $item_soundcloud = sanitize_text_field($_POST['item_soundcloud']); };
		if(!empty($item_soundcloud)){
			update_post_meta($post_id, 'item_soundcloud', $item_soundcloud);
		}

		// Video
		if(isset($_POST['item_video'])) { $item_video = sanitize_text_field($_POST['item_video']); };
		if(!empty($item_video)){
			update_post_meta($post_id, 'event_video', $item_video);
		}

		global $allowed;

		if(isset($_POST['item_video'])) { update_post_meta($post_id, 'event_video', $_POST['item_video'], $allowed); };

		// Details
		if(isset($_POST['event_start_date'])) { $event_start_date = sanitize_text_field($_POST['event_start_date']); };
		if(!empty($event_start_date)){
			update_post_meta($post_id, 'event_start_date', $event_start_date);
		}

		if(isset($_POST['event_start_time'])) { $event_start_time = sanitize_text_field($_POST['event_start_time']); };
		if(!empty($event_start_time)){
			update_post_meta($post_id, 'event_start_time', $event_start_time);
		}

		if(!empty($event_start_date) AND !empty($event_start_time)){
			$date = "".$event_start_date." ".$event_start_time."";
			$event_start_date_number = strtotime($date);
			if(!empty($event_start_date_number)) {
				update_post_meta($post_id, 'event_start_date_number', $event_start_date_number);
			}
		}

		if(isset($_POST['event_end_date'])) { $event_end_date = sanitize_text_field($_POST['event_end_date']); };
		if(!empty($event_end_date)){
			update_post_meta($post_id, 'event_end_date', $event_end_date);
		}

		if(isset($_POST['event_end_time'])) { $event_end_time = sanitize_text_field($_POST['event_end_time']); };
		if(!empty($event_end_time)){
			update_post_meta($post_id, 'event_end_time', $event_end_time);
		}

		if(!empty($event_end_date) AND !empty($event_end_time)){
			$date = "".$event_end_date." ".$event_end_time."";
			$event_end_date_number = strtotime($date);
			if(!empty($event_end_date_number)) {
				update_post_meta($post_id, 'event_end_date_number', $event_end_date_number);
			}
		}


		// Address
		if(isset($_POST['event_address_country'])) { $event_address_country = sanitize_text_field($_POST['event_address_country']); };
		if(!empty($event_address_country)){
			update_post_meta($post_id, 'event_address_country', $event_address_country);
		}

		if(isset($_POST['event_address_state'])) { $event_address_state = sanitize_text_field($_POST['event_address_state']); };
		if(!empty($event_address_state)){
			update_post_meta($post_id, 'event_address_state', $event_address_state);
		}

		if(isset($_POST['event_address_city'])) { $event_address_city = sanitize_text_field($_POST['event_address_city']); };
		if(!empty($event_address_city)){
			update_post_meta($post_id, 'event_address_city', $event_address_city);
		}

		if(isset($_POST['event_address_address'])) { $event_address_address = sanitize_text_field($_POST['event_address_address']); };
		if(!empty($event_address_address)){
			update_post_meta($post_id, 'event_address_address', $event_address_address);
		}

		if(isset($_POST['event_address_zip'])) { $event_address_zip = sanitize_text_field($_POST['event_address_zip']); };
		if(!empty($event_address_zip)){
			update_post_meta($post_id, 'event_address_zip', $event_address_zip);
		}

		if(isset($_POST['event_phone'])) { $event_phone = sanitize_text_field($_POST['event_phone']); };
		if(!empty($event_phone)){
			update_post_meta($post_id, 'event_phone', $event_phone);
		}

		if(isset($_POST['event_email'])) { $event_email = sanitize_text_field($_POST['event_email']); };
		if(!empty($event_email)){
			update_post_meta($post_id, 'event_email', $event_email);
		}

		if(isset($_POST['event_website'])) { $event_website = sanitize_text_field($_POST['event_website']); };
		if(!empty($event_website)){
			update_post_meta($post_id, 'event_website', $event_website);
		}

		if(isset($_POST['event_address_latitude'])) { $event_address_latitude = sanitize_text_field($_POST['event_address_latitude']); };
		if(!empty($event_address_latitude)){
			update_post_meta($post_id, 'event_address_latitude', $event_address_latitude);
		}

		if(isset($_POST['event_address_longitude'])) { $event_address_longitude = sanitize_text_field($_POST['event_address_longitude']); };
		if(!empty($event_address_longitude)){
			update_post_meta($post_id, 'event_address_longitude', $event_address_longitude);
		}

		if(isset($_POST['event_address_streetview'])) { $event_address_streetview = sanitize_text_field($_POST['event_address_streetview']); };
		if(!empty($event_address_streetview)){
			update_post_meta($post_id, 'event_address_streetview', $event_address_streetview);
		}

		if(isset($_POST['event_googleaddress'])) { $event_googleaddress = sanitize_text_field($_POST['event_googleaddress']); };
		if(!empty($event_googleaddress)){
			update_post_meta($post_id, 'event_googleaddress', $event_googleaddress);
		}

		// TicketTailor Shortcode
		if(isset($_POST['item_ticketailor'])) { $item_ticketailor = $_POST['item_ticketailor']; };
		if(!empty($item_ticketailor)){
			update_post_meta($post_id, 'item_ticket_tailor', $item_ticketailor);
		};

		update_post_meta($post_id, 'event_status', 'upcoming');

	}

	/*------------------------------------------------------------------
		Packages Custom Post Types
	-------------------------------------------------------------------*/
	function post_type_packages() {
		$labels = array(
	    	'name' => __('Packages', 'post type general name', 'themesdojo'),
	    	'singular_name' => __('Package', 'post type singular name', 'themesdojo'),
	    	'add_new' => __('Add New Package', 'book', 'themesdojo'),
	    	'add_new_item' => __('Add New Package', 'themesdojo'),
	    	'edit_item' => __('Edit Package', 'themesdojo'),
	    	'new_item' => __('New Package', 'themesdojo'),
	    	'view_item' => __('View Package', 'themesdojo'),
	    	'search_items' => __('Search Package', 'themesdojo'),
	    	'not_found' =>  __('No Package found', 'themesdojo'),
	    	'not_found_in_trash' => __('No Package found in Trash', 'themesdojo'), 
	    	'parent_item_colon' => ''
		);		
		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
	    	'publicly_queryable' => true,
	    	'show_ui' => true, 
	    	'query_var' => true,
	    	'rewrite' => true,
	    	'capability_type' => 'post',
	    	'hierarchical' => false,
	    	'menu_position' => null,
	    	'supports' => array('title','editor','thumbnail','author',),
	    	'menu_icon' => 'dashicons-store'
		); 		

		register_post_type( 'package', $args );	
							  
	} 
									  
	add_action('init', 'post_type_packages');

	/**************************************
	Custom Post Meta Boxes
	***************************************/

	/*--------------------------------------*/
	/*        Featured Post Option          */
	/*--------------------------------------*/
	add_action('add_meta_boxes', 'register_packages_settings');
	function register_packages_settings () {
		add_meta_box('themesdojo_properties', 'Package Details', 'display_packages','package');
	}

	function display_packages ($post) { 

		// Package Details
		$package_active = get_post_meta($post->ID, 'package_active', true);
		$package_approve_item = get_post_meta($post->ID, 'package_approve_item', true);
		$package_price = get_post_meta($post->ID, 'package_price', true);
		$package_events_amount = get_post_meta($post->ID, 'package_events_amount', true);

		// Package Capabilities
		$package_allow_feat_image = get_post_meta($post->ID, 'package_allow_feat_image', true);
		$package_allow_gallery = get_post_meta($post->ID, 'package_allow_gallery', true);
		$package_allow_map = get_post_meta($post->ID, 'package_allow_map', true);
		$package_allow_streetview = get_post_meta($post->ID, 'package_allow_streetview', true);
		$package_allow_phone = get_post_meta($post->ID, 'package_allow_phone', true);
		$package_allow_web = get_post_meta($post->ID, 'package_allow_web', true);
		$package_allow_social = get_post_meta($post->ID, 'package_allow_social', true);
		$package_allow_amenities = get_post_meta($post->ID, 'package_allow_amenities', true);
		$package_allow_video = get_post_meta($post->ID, 'package_allow_video', true);
		$package_allow_ratings = get_post_meta($post->ID, 'package_allow_ratings', true);

	?>
		
	<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

	<style>
		#options-popup {
			display: block;
		}

		#post-body #normal-sortables {
			display: none;
		}

		#options-popup .option-item {
			background: #FFF;
			margin: 0 -10px 0 -10px;
			border-bottom: 1px solid #EEE;
			padding: 14px 10px 14px 10px;
			width: 100%;
			float: left;
		}

		#options-popup .option-item span.text {
			float: left;
			display: block;
			width: 150px;
			margin-top: 5px;
		}

		#options-popup .option-item .criteria-name {
			float: left;
			margin-right: 36px;
			width: 400px;
		}

		#options-popup .option-item span.text {
			width: 250px;
			margin-right: 10px;
		}

		#options-popup .option-item input {
			float: left;
			margin-right: 20px;
			margin-top: 5px;
		}

		.full {
			width: 100%;
			display: inline-block;
			margin-bottom: 20px;
		}

		.info-text {
			font-style: italic;
			float: left;
			margin-top: 10px;
			width: 70%;
			margin-left: 113px;
		}

		.criteria-image {
			max-width: 590px;
			height: auto;
		}

		.option-item {
			border-bottom: 1px solid #EEE;
			padding: 14px 10px 14px 10px;
			width: 100%;
		}

		.option-item h3 {
			padding-left: 0 !important;
			margin-bottom: 30px !important;
			padding-bottom: 20px !important;
			border-bottom: solid 1px #eee;
		}

		.help-block {
			font-style: italic;
			margin-left: 160px;
			float: left;
		}

		.option-item .rating_slider {
			width: 200px;
			float: left;
			margin-right: 16px;
			margin-top: 6px;
			height: 10px;
		}

		.option-item .slider_value {
			width: 34px;
			margin-right: 12px;
			float: left;
		}

		.postbox,
		#options-popup {
			float: left;
			width: 100%;
		}

		#themesdojo_properties .inside {
			float: left;
		}

		.checkbox-text {
			margin-top: 3px;
			float: left;
		}

	</style>

	<div id='options-popup'>

		<div id="property-details">

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Active', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_active" value="package_active" <?php if(!empty($package_active)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Yes', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">

				<span class='text'><?php _e( 'Price', 'themesdojo' ); ?></span>
				<input style="width: 550px;" type='text' id='package_price' name='package_price' value='<?php if(!empty($package_price)) { echo esc_attr($package_price); } ?>' placeholder="">
					
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Admin must approve item before showing on frontend', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_approve_item" value="package_approve_item" <?php if(!empty($package_approve_item)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Yes', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">

				<span class='text'><?php _e( 'The number of events included', 'themesdojo' ); ?></span>
				<input style="width: 550px;" type='text' id='package_events_amount' name='package_events_amount' value='<?php if(!empty($package_events_amount)) { echo esc_attr($package_events_amount); } ?>' placeholder="">
					
			</div>

			<div class="option-item">

				<h3><?php _e( 'Package Capabilities', 'themesdojo' ); ?></h3>
				
				<span class='text overall'><?php _e( 'Cover Image', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_feat_image" value="package_allow_feat_image" <?php if(!empty($package_allow_feat_image)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Image Gallery', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_gallery" value="package_allow_gallery" <?php if(!empty($package_allow_gallery)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Ratings', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_ratings" value="package_allow_ratings" <?php if(!empty($package_allow_ratings)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Map', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_map" value="package_allow_map" <?php if(!empty($package_allow_map)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Streetview', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_streetview" value="package_allow_streetview" <?php if(!empty($package_allow_streetview)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Phone number', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_phone" value="package_allow_phone" <?php if(!empty($package_allow_phone)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Website', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_web" value="package_allow_web" <?php if(!empty($package_allow_web)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Social links', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_social" value="package_allow_social" <?php if(!empty($package_allow_social)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Amenities', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_amenities" value="package_allow_amenities" <?php if(!empty($package_allow_amenities)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<div class="option-item">
				
				<span class='text overall'><?php _e( 'Video box', 'themesdojo' ); ?></span>
				<input style="margin-left: 10px;" type="checkbox" name="package_allow_video" value="package_allow_video" <?php if(!empty($package_allow_video)) { ?>checked<?php } ?>><span class="checkbox-text"><?php _e( 'Allow', 'themesdojo' ); ?></span>
				
			</div>

			<br>

		</div>


	</div>	<!-- end review_options_pop -->


	<?php

	}

	
	add_action ('save_post', 'update_packages_settings');
	
	function update_packages_settings ( $post_id ) {
		// verify nonce.  

		if (!isset($_POST['cmb_nonce'])) {
				return false;		
		}

		if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__))) {
			return false;
		}

		global  $allowed;

		// Package Details
		if(isset($_POST['package_active'])) { 
			$package_active = sanitize_text_field($_POST['package_active']); 
		} else {
			$package_active = "";
		}
		update_post_meta($post_id, 'package_active', $package_active);

		if(isset($_POST['package_approve_item'])) { 
			$package_approve_item = sanitize_text_field($_POST['package_approve_item']); 
		} else {
			$package_approve_item = "";
		}
		update_post_meta($post_id, 'package_approve_item', $package_approve_item);

		if(isset($_POST['package_price'])) { 
			$package_price = sanitize_text_field($_POST['package_price']); 
		} else {
			$package_price = "";
		}
		update_post_meta($post_id, 'package_price', $package_price);

		if(isset($_POST['package_items_amount'])) { 
			$package_items_amount = sanitize_text_field($_POST['package_items_amount']); 
		} else {
			$package_items_amount = "";
		}
		update_post_meta($post_id, 'package_items_amount', $package_items_amount);

		if(isset($_POST['package_events_amount'])) { 
			$package_events_amount = sanitize_text_field($_POST['package_events_amount']); 
		} else {
			$package_events_amount = "";
		}
		update_post_meta($post_id, 'package_events_amount', $package_events_amount);

		if(isset($_POST['package_items_feat_amount'])) { 
			$package_items_feat_amount = sanitize_text_field($_POST['package_items_feat_amount']); 
		} else {
			$package_items_feat_amount = "";
		}
		update_post_meta($post_id, 'package_items_feat_amount', $package_items_feat_amount);

		if(isset($_POST['package_items_expiration'])) { 
			$package_items_expiration = sanitize_text_field($_POST['package_items_expiration']); 
		} else {
			$package_items_expiration = "";
		}
		update_post_meta($post_id, 'package_items_expiration', $package_items_expiration);

		// Package Capabilities
		if(isset($_POST['package_allow_feat_image'])) { 
			$package_allow_feat_image = sanitize_text_field($_POST['package_allow_feat_image']); 
		} else {
			$package_allow_feat_image = "";
		}
		update_post_meta($post_id, 'package_allow_feat_image', $package_allow_feat_image);

		if(isset($_POST['package_allow_gallery'])) { 
			$package_allow_gallery = sanitize_text_field($_POST['package_allow_gallery']); 
		} else {
			$package_allow_gallery = "";
		}
		update_post_meta($post_id, 'package_allow_gallery', $package_allow_gallery);

		if(isset($_POST['package_allow_map'])) { 
			$package_allow_map = sanitize_text_field($_POST['package_allow_map']); 
		} else {
			$package_allow_map = "";
		}
		update_post_meta($post_id, 'package_allow_map', $package_allow_map);

		if(isset($_POST['package_allow_streetview'])) { 
			$package_allow_streetview = sanitize_text_field($_POST['package_allow_streetview']); 
		} else {
			$package_allow_streetview = "";
		}
		update_post_meta($post_id, 'package_allow_streetview', $package_allow_streetview);

		if(isset($_POST['package_allow_phone'])) { 
			$package_allow_phone = sanitize_text_field($_POST['package_allow_phone']); 
		} else {
			$package_allow_phone = "";
		}
		update_post_meta($post_id, 'package_allow_phone', $package_allow_phone);

		if(isset($_POST['package_allow_web'])) { 
			$package_allow_web = sanitize_text_field($_POST['package_allow_web']); 
		} else {
			$package_allow_web = "";
		}
		update_post_meta($post_id, 'package_allow_web', $package_allow_web);

		if(isset($_POST['package_allow_social'])) { 
			$package_allow_social = sanitize_text_field($_POST['package_allow_social']); 
		} else {
			$package_allow_social = "";
		}
		update_post_meta($post_id, 'package_allow_social', $package_allow_social);

		if(isset($_POST['package_allow_workinghours'])) { 
			$package_allow_workinghours = sanitize_text_field($_POST['package_allow_workinghours']); 
		} else {
			$package_allow_workinghours = "";
		}
		update_post_meta($post_id, 'package_allow_workinghours', $package_allow_workinghours);

		if(isset($_POST['package_allow_amenities'])) { 
			$package_allow_amenities = sanitize_text_field($_POST['package_allow_amenities']); 
		} else {
			$package_allow_amenities = "";
		}
		update_post_meta($post_id, 'package_allow_amenities', $package_allow_amenities);

		if(isset($_POST['package_allow_video'])) { 
			$package_allow_video = sanitize_text_field($_POST['package_allow_video']); 
		} else {
			$package_allow_video = "";
		}
		update_post_meta($post_id, 'package_allow_video', $package_allow_video);

		if(isset($_POST['package_allow_bookonline'])) { 
			$package_allow_bookonline = sanitize_text_field($_POST['package_allow_bookonline']); 
		} else {
			$package_allow_bookonline = "";
		}
		update_post_meta($post_id, 'package_allow_bookonline', $package_allow_bookonline);

		if(isset($_POST['package_allow_ratings'])) { 
			$package_allow_ratings = sanitize_text_field($_POST['package_allow_ratings']); 
		} else {
			$package_allow_ratings = "";
		}
		update_post_meta($post_id, 'package_allow_ratings', $package_allow_ratings);

	}

	/*------------------------------------------------------------------
		Partners Custom Post Types
	-------------------------------------------------------------------*/
	function post_type_partner() {
		$labels = array(
	    	'name' => __('Partners', 'post type general name', 'themesdojo'),
	    	'singular_name' => __('Partners', 'post type singular name', 'themesdojo'),
	    	'add_new' => __('Add New Partner', 'book', 'themesdojo'),
	    	'add_new_item' => __('Add New Partner', 'themesdojo'),
	    	'edit_item' => __('Edit Partner', 'themesdojo'),
	    	'new_item' => __('New Partner', 'themesdojo'),
	    	'view_item' => __('View Partner', 'themesdojo'),
	    	'search_items' => __('Search Partners', 'themesdojo'),
	    	'not_found' =>  __('No Partners found', 'themesdojo'),
	    	'not_found_in_trash' => __('No Partners found in Trash', 'themesdojo'), 
	    	'parent_item_colon' => ''
		);		
		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
	    	'publicly_queryable' => true,
	    	'show_ui' => true, 
	    	'query_var' => true,
	    	'rewrite' => true,
	    	'capability_type' => 'post',
	    	'hierarchical' => false,
	    	'menu_position' => null,
	    	'supports' => array('title','thumbnail'),
	    	'menu_icon' => 'dashicons-menu'
		); 		

		register_post_type( 'partner', $args );						  
	} 
									  
	add_action('init', 'post_type_partner');

	/*------------------------------------------------------------------
		Testimonials Custom Post Types
	-------------------------------------------------------------------*/
	function post_type_Testimonials() {
		$labels = array(
	    	'name' => __('Testimonials', 'post type general name', 'themesdojo'),
	    	'singular_name' => __('Testimonials', 'post type singular name', 'themesdojo'),
	    	'add_new' => __('Add New Testimonial', 'book', 'themesdojo'),
	    	'add_new_item' => __('Add New Testimonial', 'themesdojo'),
	    	'edit_item' => __('Edit Testimonial', 'themesdojo'),
	    	'new_item' => __('New Testimonial', 'themesdojo'),
	    	'view_item' => __('View Testimonial', 'themesdojo'),
	    	'search_items' => __('Search Testimonials', 'themesdojo'),
	    	'not_found' =>  __('No Testimonials found', 'themesdojo'),
	    	'not_found_in_trash' => __('No Testimonials found in Trash', 'themesdojo'), 
	    	'parent_item_colon' => ''
		);		
		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
	    	'publicly_queryable' => true,
	    	'show_ui' => true, 
	    	'query_var' => true,
	    	'rewrite' => true,
	    	'capability_type' => 'post',
	    	'hierarchical' => false,
	    	'menu_position' => null,
	    	'supports' => array('title','editor','thumbnail','author'),
	    	'menu_icon' => 'dashicons-admin-comments'
		); 		

		register_post_type( 'testimonial', $args );	

		/*
		$labels = array(			  
	  	  	'name' => __( 'Testimonial Type', 'taxonomy general name' , 'themesdojo'),
	  	  	'singular_name' => __( 'Testimonial Type', 'taxonomy singular name' , 'themesdojo'),
	  	  	'search_items' =>  __( 'Search Types', 'themesdojo'),
	  	  	'all_items' => __( 'All Types', 'themesdojo' ),
	  	  	'parent_item' => __( 'Parent Type', 'themesdojo' ),
	  	  	'parent_item_colon' => __( 'Parent Type:', 'themesdojo' ),
	  	  	'edit_item' => __( 'Edit Type', 'themesdojo' ), 
	  	  	'update_item' => __( 'Update Type', 'themesdojo' ),
	  	  	'add_new_item' => __( 'Add New Type', 'themesdojo' ),
	  	  	'new_item_name' => __( 'New Type Name', 'themesdojo' ),
	  	); 							  
	  	
	  	register_taxonomy(
			'Testimonialtypes',
			'Testimonial',
			array(
				'public'=>true,
				'hierarchical' => true,
				'labels'=> $labels,
				'query_var' => 'Testimonialtypes',
				'show_ui' => true,
				'rewrite' => array( 'slug' => 'Testimonialtypes', 'with_front' => false ),
			)
		);
		*/					  
	} 
									  
	add_action('init', 'post_type_Testimonials');


