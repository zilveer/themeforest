<?php 

/**
 * Build theme metaboxes
 * Uses the cmb metaboxes class found in the ebor framework plugin
 * More details here: https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_custom_metaboxes') )){
	function ebor_custom_metaboxes( $meta_boxes ) {
		
		/**
		 * Setup variables
		 */
		$prefix = '_ebor_';
		$footer_options = ebor_get_footer_options();
		$header_options = ebor_get_header_options();
		$title_layouts = array_flip(ebor_get_page_title_options());
		$social_options = ebor_get_icons();
		foreach( $social_options as $social ){
			$new_social_options[$social] = ucfirst(str_replace('ti-', '', $social));	
		}
		
		$footer_overrides['none'] = 'Do Not Override Footer Option On This Page';
		foreach( $footer_options as $key => $value ){
			$footer_overrides[$key] = 'Override Footer: ' . $value; 	
		}
		
		$header_overrides['none'] = 'Do Not Override Header Option On This Page';
		foreach( $header_options as $key => $value ){
			$header_overrides[$key] = 'Override Header: ' . $value; 	
		}
		
		/**
		 * Post & Portfolio Header Images
		 */
		$meta_boxes[] = array(
			'id' => 'post_header_metabox',
			'title' => __('Page Overrides', 'foundry'),
			'object_types' => array('page'), // post type
			'context' => 'normal',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name'         => __( 'Override Header?', 'foundry' ),
					'desc'         => __( 'Header Layout is set in "appearance" -> "customise". To override this for this page only, use this control.', 'foundry' ),
					'id'           => $prefix . 'header_override',
					'type'         => 'select',
					'options'      => $header_overrides,
					'std'          => 'none'
				),
				array(
					'name'         => __( 'Override Footer?', 'foundry' ),
					'desc'         => __( 'Footer Layout is set in "appearance" -> "customise". To override this for this page only, use this control.', 'foundry' ),
					'id'           => $prefix . 'footer_override',
					'type'         => 'select',
					'options'      => $footer_overrides,
					'std'          => 'none'
				),
			)
		);
		
		$meta_boxes[] = array(
			'id' => 'clients_metabox',
			'title' => __('Client URL', 'foundry'),
			'object_types' => array('client'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('URL for this client (optional)', 'foundry'),
					'desc' => __("Enter a URL for this client, if left blank, client logo will not be clickable.", 'foundry'),
					'id'   => $prefix . 'client_url',
					'type' => 'text',
				),
			),
		);
		
		$meta_boxes[] = array(
			'id' => 'page_title_metabox',
			'title' => __('Page Title Options', 'foundry'),
			'object_types' => array('page', 'post', 'team', 'product', 'portfolio'), // post type
			'context' => 'side',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Page Title Subtitle',
					'desc' => '(Optional) Enter a subtitle for this post / page.',
					'id'   => $prefix . 'the_subtitle',
					'type' => 'text',
				),
				array(
					'name' => 'Page Title Layout',
					'desc' => 'How would you like the page title to appear for this page?',
					'id' => $prefix . 'page_title_layout',
					'type' => 'select',
					'options' => $title_layouts
				),
				array(
					'name' => 'Page Title Icon',
					'id' => $prefix . 'page_title_icon',
					'type' => 'ebor_icons_meta',
					'std' => 'none',
					'description' => 'Leave text field blank for no icon'
				),
			)
		);
		
		/**
		 * Social Icons for Team Members
		 */
		$meta_boxes[] = array(
			'id' => 'social_metabox',
			'title' => __('Team Member Details', 'foundry'),
			'object_types' => array('team'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Job Title', 'foundry'),
					'desc' => '(Optional) Enter a Job Title for this Team Member',
					'id'   => $prefix . 'the_job_title',
					'type' => 'text',
				),
				array(
				    'id'          => $prefix . 'team_social_icons',
				    'type'        => 'group',
				    'options'     => array(
				        'add_button'    => __( 'Add Another Icon', 'foundry' ),
				        'remove_button' => __( 'Remove Icon', 'foundry' ),
				        'sortable'      => true
				    ),
				    'fields' => array(
						array(
							'name' => 'Social Icon',
							'desc' => 'What icon would you like for this team members first social profile?',
							'id' => $prefix . 'social_icon',
							'type' => 'select',
							'options' => $new_social_options
						),
						array(
							'name' => __('URL for Social Icon', 'foundry'),
							'desc' => __("Enter the URL for Social Icon 1 e.g www.google.com", 'foundry'),
							'id'   => $prefix . 'social_icon_url',
							'type' => 'text'
						),
				    ),
				),
			)
		);
		
		$meta_boxes[] = array(
			'id' => 'testimonials_metabox',
			'title' => __('Testimonial Giver Details', 'foundry'),
			'object_types' => array('testimonial'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Job Title', 'foundry'),
					'desc' => '(Optional) Enter a Job Title for this Testimonial',
					'id'   => $prefix . 'the_job_title',
					'type' => 'text',
				),
			)
		);
		
		/**
		 * Video Format Metaboxes
		 */
		$meta_boxes[] = array(
			'id' => 'post_format_metabox_video',
			'title' => __('Videos & oEmbeds', 'foundry'),
			'object_types' => array('post'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'oEmbed',
					'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
					'id'   => $prefix . 'the_oembed',
					'type' => 'oembed',
				),
			)
		);
		
		$meta_boxes[] = array(
			'id' => 'post_format_metabox_audio',
			'title' => __('Audio Embed', 'foundry'),
			'object_types' => array('post'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'oEmbed',
					'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
					'id'   => $prefix . 'the_audio_oembed',
					'type' => 'oembed',
				),
			)
		);
		
		return $meta_boxes;
	}
	add_filter( 'cmb2_meta_boxes', 'ebor_custom_metaboxes' );
}