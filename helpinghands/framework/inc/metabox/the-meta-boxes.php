<?php
/**
 * Register Meta Boxes
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://skat.tf
 * @info http://metabox.io
 * @since HelpingHands 1.0
 */

if ( !function_exists( 'sd_register_meta_boxes' ) ) {
	function sd_register_meta_boxes( $meta_boxes ) {
		
		$prefix = 'sd_';
		
		// Post formats metaboxes		
		
		// gallery
		$meta_boxes[] = array(
			'title'   => __( 'Gallery Options', 'sd-framework' ),
			'pages'   => array( 'post' ),
			'show'    => array( 
				'relation'    => 'OR',
				'post_format' => array( 'Gallery' ),
			),
			'context' => 'normal',
			'fields'  => array(
				array(
					'name' => __( 'Gallery Images', 'sd-framework' ),
					'id'   => $prefix . 'gallery_images',
					'type' => 'image_advanced',
					'desc' => __( 'Insert the gallery images.', 'sd-framework' ),
				),
			),
		);
		// video
		$meta_boxes[] = array(
			'title'   => __( 'Video Options', 'sd-framework' ),
			'pages'   => array( 'post' ),
			'show'    => array( 
				'relation'    => 'OR',
				'post_format' => array( 'Video' ),
			),
			'context' => 'normal',
			'fields'  => array(
				array(
					'name' => __( 'Video Url', 'sd-framework' ),
					'id'   => $prefix . 'video_url',
					'type' => 'oembed',
					'desc' => __( 'Insert the video url.', 'sd-framework' ),
				),
			),
		);
		// audio
		$meta_boxes[] = array(
			'title'   => __( 'Audio Options', 'sd-framework' ),
			'pages'   => array( 'post' ),
			'show'    => array( 
				'relation'    => 'OR',
				'post_format' => array( 'Audio' ),
			),
			'context' => 'normal',
			'fields'  => array(
				array(
					'name' => __( 'Audio Url', 'sd-framework' ),
					'id'   => $prefix . 'audio_url',
					'type' => 'text',
					'size' => '50',
					'desc' => __( 'Insert the audio url.', 'sd-framework' ),
				),
			),
		);
		$meta_boxes[] = array(
			'title'   => __( 'Blog Options', 'sd-framework' ),
			'pages'   => array( 'page' ),
			'show'    => array( 
					'relation' => 'OR',
					'template' => array( 'blog.php' ),
				),
			'context' => 'normal',
			'fields'  => array(
				array(
					'name' => __( 'Category Ids', 'sd-framework' ),
					'id'   => $prefix . 'blog_category_ids',
					'type' => 'text',
					'size' => '50',
					'desc' => __( 'Insert the category ids you want to pull posts from (optional, comma separated, eg. 5,7).', 'sd-framework' ),
				),
			),
		);
		
		if ( post_type_exists( 'download' ) ) {
			
			//Add portfolio category checkboxes
		
				$types = get_terms( 'download_category', 'hide_empty=0' );
				$types_array[0] = __( 'All Categories', 'sd-framework' );
			
				if( $types ) {
					foreach( $types as $type ) {
						$types_array[$type->term_id] = $type->name;
					}
				}
			
			$meta_boxes[] = array(
				'id'      => 'campaign_page_options',
				'title'   => __( 'Campaign Template Options', 'sd-framework' ),
				'pages'   => array( 'page' ),
				'show'    => array( 
					'relation' => 'OR',
					'template' => array( 'campaigns.php' ),
				),
				'context' => 'normal',
				'fields'  => array(
					array(
						'name'    => __( 'Select Campaign Categories', 'sd-framework' ),
						'id'      => $prefix . "campaign-taxonomies",
						'type'    => 'checkbox_list',
						'options' => $types_array,
						'desc'    => __( 'Optional. Only if you use this page as a portfolio. Choose which portfolio filter you want to display on this page.', 'sd-framework' ),
					),
					array(
						'name'    => __( 'Page Layout', 'sd-framework' ),
						'id'      => $prefix . "camp-page-layout",
						'type'    => 'select',
						'desc'    => __( 'Select the layout of the page.', 'sd-framework' ),
						'options' => array (
										'1' => 'Grid',
										'2' => 'List',
									 ),
					),
					array(
						'name'          => __( 'Number of Items', 'sd-framework' ),
						'id'            => $prefix . 'campaign_items',
						'type'          => 'text',
						'desc'          => __( 'Number of items to display on the page. Default is 6.', 'sd-framework' ),
					),
				),
			);
		}
		
		if ( post_type_exists( 'events' ) ) {
			$meta_boxes[] = array(
				'id'      => 'events_page_options',
				'title'   => __( 'Event Options', 'sd-framework' ),
				'pages'   => array( 'events' ),
				'context' => 'normal',
				'fields'  => array(
					array(
						'name'          => __( 'Date & Time of event', 'sd-framework' ),
						'id'            => $prefix . 'dov',
						'type'          => 'datetime',
						'js_options' => array(
							'dateFormat' => _x( 'yy-mm-dd', 'event backend date format', 'sd-framework' ),

							'ampm'       => _x( 'true', 'change to false to turn am/pm off', 'sd-framework' ),
						),
						// Date format, default yy-mm-dd. Optional. See: http://goo.gl/po8vf
						'desc'          => __( 'Click to select the date & time of the event.', 'sd-framework' ),
						'timestamp'     => true,
					),
					array(
						'name'  => __( 'Show Event Countdown', 'sd-framework' ),
						'id'    => $prefix . 'ev_count',
						'type'  => 'checkbox',
						'desc'  => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name'          => __( 'Event Address', 'sd-framework' ),
						'id'            => $prefix . 'event_address',
						'type'          => 'text',
						'desc'          => __( '(eg. 123 Street, 90210)', 'sd-framework' ),
					),
					array(
						'name'          => __( 'Event City/State', 'sd-framework' ),
						'id'            => $prefix . 'event_city',
						'type'          => 'text',
						'desc'          => __( '(eg. Sanford, FL)', 'sd-framework' ),
					),
					array(
						'name'          => __( 'Button Url', 'sd-framework' ),
						'id'            => $prefix . 'event_button_url',
						'type'          => 'url',
						'desc'          => __( 'The url of the event button. Leve blank to hide the button.', 'sd-framework' ),
					),
					array(
						'name'          => __( 'Button Text', 'sd-framework' ),
						'id'            => $prefix . 'event_button_text',
						'type'          => 'text',
						'desc'          => __( 'The text on the event button.', 'sd-framework' ),
					),
					array(
						'name'  => __( 'Show Map?', 'sd-framework' ),
						'id'    => $prefix . 'ev_map',
						'type'  => 'checkbox',
						'desc'  => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name'          => __( 'Location Latitude', 'sd-framework' ),
						'id'            => $prefix . 'ev_lat',
						'type'          => 'text',
						'desc'          => __( '<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location.', 'sd-framework' ),
					),
					array(
						'name'          => __( 'Location Longitude', 'sd-framework' ),
						'id'            => $prefix . 'ev_lon',
						'type'          => 'text',
						'desc'          => __( '<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', 'sd-framework' ),
					),
				),
			);
		}
		if ( post_type_exists( 'events' ) ) {
			$meta_boxes[] = array(
				'id'      => 'events_listing_page_options',
				'title'   => __( 'Event Options', 'sd-framework' ),
				'pages'   => array( 'page' ),
				'show'    => array( 
					'relation' => 'OR',
					'template' => array( 'events.php' ),
				),
				'context' => 'normal',
				'fields'  => array(
					array(
						'name'          => __( 'Number of Items', 'sd-framework' ),
						'id'            => $prefix . 'ev_items',
						'type'          => 'text',
						'desc'          => __( 'Number of items to display on the page. Default is 6.', 'sd-framework' ),
					),
				),
			);
		}
		//Add case studies category checkboxes
		if ( post_type_exists( 'projects' ) ) {
	
			$projects_types = get_terms( 'projects_filters', 'hide_empty=0' );
			$projects_types_array[0] = __( 'All Filters', 'sd-framework' );
		
			if( $projects_types ) {
				foreach( $projects_types as $projects_type ) {
					$projects_types_array[$projects_type->term_id] = $projects_type->name;
				}
			}
		}
	
		// testimonials metaboxes
		
		if ( post_type_exists( 'testimonials' ) ) {
			$meta_boxes[] = array(
				'id'      => 'testimonials_page_options',
				'title'   => __( 'Testimonuals Options', 'sd-framework' ),
				'pages'   => array( 'testimonials' ),
				'context' => 'normal',
				'fields'  => array(
					array(
						'name' => __( 'Author Description', 'sd-framework' ),
						'id'   => $prefix . "testimonial_desc",
						'type' => 'text',
						'desc' => __( "Enter the testimonial's author description.", 'sd-framework' ),
					),
				),
			);
		}
		
		// staff metaboxes
		
		if ( post_type_exists( 'staff' ) ) {
			$meta_boxes[] = array(
				'id'      => 'staff_page_options',
				'title'   => __( 'Staff Options', 'sd-framework' ),
				'pages'   => array( 'staff' ),
				'context' => 'normal',
				'fields'  => array(
					array(
						'name' => __( 'Position', 'sd-framework' ),
						'id'   => $prefix . "staff_position",
						'type' => 'text',
						'desc' => __( "Enter the staff member's position.", 'sd-framework' ),
					),
					array(
						'name' => __( 'Social Profiles', 'sd-framework' ),
						'id'   => $prefix . "staff_social_heading",
						'type' => 'heading',
						'desc' => __( "Leave any field blank if you don't want to display it.", 'sd-framework' ),
					),
					array(
						'name' => __( 'E-Mail', 'sd-framework' ),
						'id'   => $prefix . "staff_email",
						'type' => 'text',
						'desc' => __( "Enter the staff member's email address.", 'sd-framework' ),
					),
					array(
						'name' => __( 'Phone Number', 'sd-framework' ),
						'id'   => $prefix . "staff_phone",
						'type' => 'text',
						'desc' => __( "Enter the staff member's phone number.", 'sd-framework' ),
					),
					array(
						'name' => __( 'Facebook', 'sd-framework' ),
						'id'   => $prefix . "staff_facebook",
						'type' => 'text',
						'desc' => __( "Enter the staff member's facebook profile url.", 'sd-framework' ),
					),
					array(
						'name' => __( 'Twitter', 'sd-framework' ),
						'id'   => $prefix . "staff_twitter",
						'type' => 'text',
						'desc' => __( "Enter the staff member's Twitter username.", 'sd-framework' ),
					),
					array(
						'name' => __( 'Linked In', 'sd-framework' ),
						'id'   => $prefix . "staff_linkedin",
						'type' => 'text',
						'desc' => __( "Enter the staff member's linkedin profile url.", 'sd-framework' ),
					),
					array(
						'name' => __( 'Google+', 'sd-framework' ),
						'id'   => $prefix . "staff_googleplus",
						'type' => 'text',
						'desc' => __( "Enter the staff member's Google+ profile url.", 'sd-framework' ),
					),
					array(
						'name' => __( 'Skype', 'sd-framework' ),
						'id'   => $prefix . "staff_skype",
						'type' => 'text',
						'desc' => __( "Enter the staff member's skype username.", 'sd-framework' ),
					),
					array(
						'name' => __( 'Website', 'sd-framework' ),
						'id'   => $prefix . "staff_website",
						'type' => 'url',
						'desc' => __( "Enter the staff member's website URL.", 'sd-framework' ),
					),
				),
			);
		}
		
		// page metaboxes
		
		$meta_boxes[] = array(
				'id'       => 'page_options',
				'title'    => __( 'Page Options', 'sd-framework' ),
				'pages'    => array( 'page' ),
				'context'  => 'side',
				'priority' => 'low',
				'fields' => array(
					array(
						'name'  => __( 'Hide page title?', 'sd-framework' ),
						'id'    => $prefix . 'page_title',
						'type'  => 'checkbox',
						'desc'  => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name'  => __( 'Transparent Header?', 'sd-framework' ),
						'id'    => $prefix . 'transparent_header',
						'type'  => 'checkbox',
						'desc'  => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name'  => __( 'Hide footer newsletter?', 'sd-framework' ),
						'id'    => $prefix . 'hide_newsletter',
						'type'  => 'checkbox',
						'desc'  => __( 'Yes', 'sd-framework' ),
					),
				),
		);
		
			$meta_boxes[] = array(
				'id'       => 'campaign_options',
				'title'    => __( 'Page Options', 'sd-framework' ),
				'pages'    => array( 'download', 'post', 'events' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields' => array(
					array(
						'name' => __( 'Show page title?', 'sd-framework' ),
						'id'   => $prefix . 'edd_page_title',
						'type' => 'checkbox',
						'desc' => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name' => __( 'Insert a Custom Page title or leave blank for default page title', 'sd-framework' ),
						'id'   => $prefix . 'edd_single_title',
						'type' => 'text',
						'desc' => __( 'Insert a custom post title.', 'sd-framework' ),
					),
					array(
						'name' => __( 'Page Title Background Padding Top in Pixels', 'sd-framework' ),
						'id'   => $prefix . 'edd_padding_top',
						'type' => 'text',
						'desc' => __( 'Insert custom padding top for the page background (eg. 121px).', 'sd-framework' ),
					),
					array(
						'name' => __( 'Page Title Background Padding Bottom in Pixels', 'sd-framework' ),
						'id'   => $prefix . "edd_padding_bottom",
						'type' => 'text',
						'desc' => __( 'Insert custom padding bottom for the page background (eg. 121px).', 'sd-framework' ),
					),
					array(
						'name' => __( 'Custom Header Page Background', 'sd-framework' ),
						'desc' => __( 'Upload your custom header page background (optimal size 2170x213 for full image)', 'sd-framework' ),
						'id'   => $prefix . 'header_page_bg',
						'type' => 'image_advanced',
						'max_file_uploads' => '1',
					),
					array(
						'name' => __( 'Background Repeat?', 'sd-framework' ),
						'id'   => $prefix . 'bg_repeat',
						'type' => 'checkbox',
						'std'  => '0',
						'desc' => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name' => __( 'Background Repeat Horizontally', 'sd-framework' ),
						'id'   => $prefix . 'repeat_x',
						'type' => 'checkbox',
						'std'  => '0',
						'desc' => __( 'Header background repeat horizontaly', 'sd-framework' )
					),
					array(
						'name' => __( 'Background Repeat Vertically', 'sd-framework' ),
						'id'   => $prefix . 'repeat_y',
						'type' => 'checkbox',
						'std'  => '0',
						'desc' => __( 'Header background repeat vertically', 'sd-framework' )
					),
					array(
						'name' => __( 'Background Color', 'sd-framework' ),
						'id'   => $prefix . 'bg_color',
						'type' => 'color',
						'std'  => '',
						'desc' => __( 'Header background color', 'sd-framework' )
					),
					array(
						'name' => __( 'Title Color', 'sd-framework' ),
						'id'   => $prefix . 'title_color',
						'type' => 'color',
						'std'  => '',
						'desc' => __( 'Header title color', 'sd-framework' )
					),
					array(
						'name' => __( 'Title Background Color', 'sd-framework' ),
						'id'   => $prefix . 'title_bg_color',
						'type' => 'color',
						'std'  => '',
						'desc' => __( 'Header title background color', 'sd-framework' )
					),
				),
			);
			
			$meta_boxes[] = array(
				'id'       => 'campaign_single_options',
				'title'    => __( 'Campaign Options', 'sd-framework' ),
				'pages'    => array( 'download' ),
				'context'  => 'side',
				'priority' => 'default',
				'fields' => array(
					array(
						'name' => __( 'Hide donate button?', 'sd-framework' ),
						'id'   => $prefix . 'hide_donate_button',
						'type' => 'checkbox',
						'desc' => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name' => __( 'Hide percentage bar?', 'sd-framework' ),
						'id'   => $prefix . 'hide_donate_bar',
						'type' => 'checkbox',
						'desc' => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name' => __( 'Hide donation details (goal, days, raised)?', 'sd-framework' ),
						'id'   => $prefix . 'hide_donation_details',
						'type' => 'checkbox',
						'desc' => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name' => __( 'Hide donors?', 'sd-framework' ),
						'id'   => $prefix . 'hide_donors',
						'type' => 'checkbox',
						'desc' => __( 'Yes', 'sd-framework' ),
					),
					array(
						'name' => __( 'Custom Button Url', 'sd-framework' ),
						'id'   => $prefix . 'custom_donate_button_url',
						'type' => 'text',
						'size' => '20',
						'desc' => __( 'Insert the customn button url', 'sd-framework' ),
					),
				),
			);
		
		// Add unlimited sidebar support
		if ( function_exists( 'smk_sidebar' ) ) {
			
			$the_sidebars = smk_get_all_sidebars();
			
			$sidebar_options = array();
			
			foreach ( $the_sidebars as $key => $value ) {
				$sidebar_options[] = array( $key => $value );
			}
			
			$sidebar_options = call_user_func_array( 'array_merge', $sidebar_options );
			
			$meta_boxes[] = array(
				'id'       => 'sidebar_options',
				'title'    => __( 'Sidebars', 'sd-framework' ),
				'pages'    => array( 'page', 'post', 'events', 'download' ),
				'context'  => 'side',
				'priority' => 'low',
			
				'fields' => array(
					array(
						'name'    => __( 'Sidebar', 'sd-framework' ),
						'id'      => $prefix . "smk_sidebar",
						'type'    => 'select',
						'desc'    => __( 'Assign a custom sidebar to your page', 'sd-framework' ),
						'options' => $sidebar_options,
					),
				),
			);
		}
		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'sd_register_meta_boxes' );
}