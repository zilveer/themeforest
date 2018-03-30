<?php
  
function ebor_custom_metaboxes( $meta_boxes ) {
	$prefix = '_ebor_'; // Prefix for all fields
	
	$social_options = ebor_icons_list();
	
	$portfolio_layouts = array(
		array('name' => 'Meta Details on Left', 'value' => 'left'),
		array('name' => 'Meta Details on Right', 'value' => 'right'),
		array('name' => 'No Meta Details', 'value' => 'none'),
	);
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR PORTFOLIO POST TYPE /////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'portfolio_metabox',
		'title' => __('Additional Portfolio Item Details', 'flair'),
		'pages' => array('portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Portfolio Subtitle', 'flair'),
				'desc' => '(Optional) Enter a subtitle for this portfolio?',
				'id'   => $prefix . 'the_subtitle',
				'type' => 'text',
			),
			array(
				'name' => 'Portfolio Item Layout',
				'desc' => 'What layout would you like for this portfolio item?',
				'id' => $prefix . 'layout_checkbox',
				'type' => 'select',
				'options' => $portfolio_layouts
			),
			array(
				'name' => __('Client Name', 'flair'),
				'desc' => __("(Optional) Add a Client Name for this Project?", 'flair'),
				'id'   => $prefix . 'the_client',
				'type' => 'text',
			),
			array(
				'name' => __('Project Date', 'flair'),
				'desc' => __("(Optional) Add the Date this Project Took Place?", 'flair'),
				'id'   => $prefix . 'the_client_date',
				'type' => 'text_date',
			),
			array(
				'name' => __('Client URL', 'flair'),
				'desc' => __("(Optional) Add a URL for this Project?", 'flair'),
				'id'   => $prefix . 'the_client_url',
				'type' => 'text_url',
			),
			array(
			    'id'          => $prefix . 'meta_repeat_group',
			    'type'        => 'group',
			    'description' => __( 'Additional Meta Titles & Descriptions', 'flair' ),
			    'options'     => array(
			        'add_button'    => __( 'Add Another Entry', 'flair' ),
			        'remove_button' => __( 'Remove Entry', 'flair' ),
			        'sortable'      => true, // beta
			    ),
			    'fields'      => array(
					array(
						'name' => __('Additional Item Title', 'flair'),
						'desc' => __("Title of your Additional Meta", 'flair'),
						'id'   => $prefix . 'the_additional_title',
						'type' => 'text'
					),
					array(
						'name' => __('Additional Item Detail', 'flair'),
						'desc' => __("Detail of your Additional Meta", 'flair'),
						'id'   => $prefix . 'the_additional_detail',
						'type' => 'text'
					),
			    ),
			),
		)
	);
	
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR TEAM MEMBERS      ///////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'team_metabox',
		'title' => __('The Job Title', 'flair'),
		'pages' => array('team'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Job Title', 'flair'),
				'desc' => '(Optional) Enter a Job Title for this Team Member',
				'id'   => $prefix . 'the_job_title',
				'type' => 'text',
			),
			array(
				'name' => __('Team Quote', 'flair'),
				'desc' => '(Optional) Enter a quote for this Team Member',
				'id'   => $prefix . 'the_team_quote',
				'type' => 'text',
			),
			array(
				'name' => 'Social Icon 1',
				'desc' => 'What icon would you like for this team members first social profile?',
				'id' => $prefix . 'team_social_icon_1',
				'type' => 'select',
				'options' => $social_options
			),
			array(
				'name' => __('URL for Social Icon 1', 'flair'),
				'desc' => __("Enter the URL for Social Icon 1 e.g www.google.com", 'flair'),
				'id'   => $prefix . 'team_social_icon_1_url',
				'type' => 'text',
			),
			array(
				'name' => 'Social Icon 2',
				'desc' => 'What icon would you like for this team members second social profile?',
				'id' => $prefix . 'team_social_icon_2',
				'type' => 'select',
				'options' => $social_options
			),
			array(
				'name' => __('URL for Social Icon 2', 'flair'),
				'desc' => __("Enter the URL for Social Icon 1 e.g www.google.com", 'flair'),
				'id'   => $prefix . 'team_social_icon_2_url',
				'type' => 'text',
			),
			array(
				'name' => 'Social Icon 3',
				'desc' => 'What icon would you like for this team members third social profile?',
				'id' => $prefix . 'team_social_icon_3',
				'type' => 'select',
				'options' => $social_options
			),
			array(
				'name' => __('URL for Social Icon 3', 'flair'),
				'desc' => __("Enter the URL for Social Icon 3 e.g www.google.com", 'flair'),
				'id'   => $prefix . 'team_social_icon_3_url',
				'type' => 'text',
			),
			array(
				'name' => 'Social Icon 4',
				'desc' => 'What icon would you like for this team members fourth social profile?',
				'id' => $prefix . 'team_social_icon_4',
				'type' => 'select',
				'options' => $social_options
			),
			array(
				'name' => __('URL for Social Icon 4', 'flair'),
				'desc' => __("Enter the URL for Social Icon 4 e.g www.google.com", 'flair'),
				'id'   => $prefix . 'team_social_icon_4_url',
				'type' => 'text',
			),
			array(
				'name' => 'Social Icon 5',
				'desc' => 'What icon would you like for this team members fifth social profile?',
				'id' => $prefix . 'team_social_icon_5',
				'type' => 'select',
				'options' => $social_options
			),
			array(
				'name' => __('URL for Social Icon 5', 'flair'),
				'desc' => __("Enter the URL for Social Icon 5 e.g www.google.com", 'flair'),
				'id'   => $prefix . 'team_social_icon_5_url',
				'type' => 'text',
			),
			array(
				'name' => 'Social Icon 6',
				'desc' => 'What icon would you like for this team members sixth social profile?',
				'id' => $prefix . 'team_social_icon_6',
				'type' => 'select',
				'options' => $social_options
			),
			array(
				'name' => __('URL for Social Icon 6', 'flair'),
				'desc' => __("Enter the URL for Social Icon 6 e.g www.google.com", 'flair'),
				'id'   => $prefix . 'team_social_icon_6_url',
				'type' => 'text',
			),
		)
	);
	
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR CLIENTS /////////////////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'clients_metabox',
		'title' => __('Client URL', 'flair'),
		'pages' => array('client'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('URL for this client (optional)', 'flair'),
				'desc' => __("Enter a URL for this client, if left blank, client logo will open into a lightbox.", 'flair'),
				'id'   => $prefix . 'client_url',
				'type' => 'text',
			),
		),
	);
	
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR GALLERY POST FORMAT /////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'gallery_metabox',
		'title' => __('The Gallery', 'flair'),
		'pages' => array('post', 'portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Attach files for the gallery',
				'desc' => 'Add your images here, they will be used to create a sliding gallery for the post.',
				'id' => $prefix . 'gallery_list',
				'type' => 'file_list',
			),
		)
	);
	
	//////////////////////////////////////////////////////////////////////////
	////// CREATE METABOXES FOR VIDEO POST FORMAT ///////////////////////////
	////////////////////////////////////////////////////////////////////////
	
	$meta_boxes[] = array(
		'id' => 'video_metabox',
		'title' => __('The Video Link', 'flair'),
		'pages' => array('post', 'portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_1',
				'type' => 'oembed',
			),
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_2',
				'type' => 'oembed',
			),
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_3',
				'type' => 'oembed',
			),
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_4',
				'type' => 'oembed',
			),
			array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'the_video_5',
				'type' => 'oembed',
			),
		)
	);


	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'ebor_custom_metaboxes' );

// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metabox/init.php' );
	}
}
?>