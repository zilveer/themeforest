<?php
/**
 * Functions related to demo import
 */


/**
 * Include one click demo import library
 */
if ( is_admin() ) {
	global $pagenow;
	if( $pagenow == 'themes.php' ) {
		require_once( get_template_directory() . '/framework/one-click-demo-install/init.php' );
	}
}


if ( ! function_exists( 'inspiry_settings_after_content_import' ) ) {
	/**
	 * Set Home as front page and Blog as Posts Page after demo contents import.
	 *
	 * Also initial theme option to demo values.
	 */
	function inspiry_settings_after_content_import() {

		// set homepage as front page and blog page as posts page
		$home_page = get_page_by_title( 'Home' );
		$blog_page = get_page_by_title( 'News' );

		if ( $home_page || $blog_page ) {
			update_option( 'show_on_front', 'page' );
		}

		if ( $home_page ) {
			update_option( 'page_on_front', $home_page->ID );
		}

		if ( $blog_page ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

		// basic theme options configuration
		$admin_email = get_option( 'admin_email' );
		$demo_theme_options = array(
			'theme_show_social_menu' => 'true',
			'theme_twitter_link' => '#',
			'theme_facebook_link' => '#',
			'theme_google_link' => '#',
			'theme_header_email' => $admin_email,
			'theme_header_phone' => '0-123-456-789',
			'theme_homepage_module' => 'properties-slider',
			'theme_number_of_slides' => 3,
			'theme_show_home_search' => 'true',
			'theme_search_module' => 'properties-map',
			'theme_home_advance_search_title' => 'Find Your Home',
			'theme_search_fields' => array(
				'keyword-search', 'location', 'status', 'type', 'min-beds', 'min-baths', 'min-max-price', 'min-max-area', 'features'
			),
			'theme_show_home_properties' => 'true',
			'theme_slogan_title' => 'Slogan title  will appear on Homepage below slider.',
			'theme_slogan_text' => 'Slogan text  will appear on Homepage below slider.',
			'theme_home_properties' => 'recent',
			'theme_sorty_by' => 'recent',
			'theme_show_featured_properties' => 'true',
			'theme_show_news_posts' => 'true',
			'theme_property_detail_variation' => 'default',
			'theme_additional_details_title' => 'Additional Details',
			'theme_property_features_title' => 'Features',
			'theme_display_video' => 'true',
			'theme_display_google_map' => 'true',
			'theme_property_map_title' => 'Property Map',
			'theme_display_social_share' => 'true',
			'theme_display_attachments' => 'true',
			'theme_property_attachments_title' => 'Property Attachments',
			'theme_child_properties_title' => 'Sub Properties',
			'theme_display_agent_info' => 'true',
			'theme_display_similar_properties' => 'true',
			'theme_similar_properties_title' => 'Similar Properties',
			'theme_news_banner_title' => 'News',
			'theme_news_banner_sub_title' => 'Know about market updates',
			'theme_gallery_banner_title' => 'Gallery',
			'theme_gallery_banner_sub_title' => 'Look for your desired property more efficiently',
			'theme_currency_sign' => '$',
			'theme_currency_position' => 'before',
			'theme_decimals' => 2,
			'theme_dec_point' => '.',
			'theme_thousands_sep' => ',',
			'theme_no_price_text' => '',
			'theme_minimum_price_values' => '1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000',
			'theme_maximum_price_values' => '5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000',
			'theme_status_for_rent' => 'for-rent',
			'theme_minimum_price_values_for_rent' => '500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000',
			'theme_maximum_price_values_for_rent' => '1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000',
			'theme_listing_module' => 'simple-banner',
			'theme_listing_layout' => 'list',
			'theme_number_of_properties' => 6,
			'theme_listing_default_sort' => 'date-desc',
			'theme_number_posts_agent' => 3,
			'theme_lightbox_plugin' => 'swipebox',
			'theme_show_contact_map' => 'true',
			'theme_map_lati' => '-37.817917',
			'theme_map_longi' => '144.965065',
			'theme_map_zoom' => 17,
			'theme_contact_form_heading' => 'Send us a message',
			'theme_contact_email' => $admin_email,
			'theme_show_partners' => 'true',
			'theme_partners_title' => 'Partners',
			'theme_enable_user_nav' => 'true',
			'theme_submitted_status' => 'pending',
			'theme_submit_default_address' => '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
			'theme_submit_default_location' => '25.7308309,-80.44414899999998',
			'theme_submit_message' => 'Thanks for Submitting Property!',
			'theme_submit_notice_email' => $admin_email,
			'theme_enable_fav_button' => 'true',
			'theme_enable_paypal' => 'false',
		);

		if ( get_option( 'permalink_structure' ) ) {  // if pretty permalinks are enabled

			// search page
			$search_page = get_page_by_title( 'Property Search' );
			if ( $search_page ) {
				$demo_theme_options[ 'theme_search_url' ] = get_permalink( $search_page->ID );
			}

			// profile page
			$edit_profile = get_page_by_title( 'Edit Profile' );
			if ( $edit_profile ) {
				$demo_theme_options[ 'theme_profile_url' ] = get_permalink( $edit_profile->ID );
			}

			// submit page
			$submit_page = get_page_by_title( 'Submit Property' );
			if ( $submit_page ) {
				$demo_theme_options[ 'theme_submit_url' ] = get_permalink( $submit_page->ID );
			}

			// my properties page
			$my_properties_page = get_page_by_title( 'My Properties' );
			if ( $search_page ) {
				$demo_theme_options[ 'theme_my_properties_url' ] = get_permalink( $my_properties_page->ID );
			}

			// favorites page
			$favorites_page = get_page_by_title( 'Favorites' );
			if ( $search_page ) {
				$demo_theme_options[ 'theme_favorites_url' ] = get_permalink( $favorites_page->ID );
			}

		}

		// loop over all options in array and update the options table in database.
		foreach ( $demo_theme_options as $key => $value ) {
			$existing_value = get_option( $key );
			if ( empty( $existing_value ) ) {
				update_option( $key, $value );
			}
		}

	}

	add_action( 'radium_importer_after_content_import', 'inspiry_settings_after_content_import' );
}

