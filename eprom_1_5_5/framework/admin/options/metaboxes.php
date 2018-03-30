<?php

global $r_option, $post, $wpdb;

/* Get post/page data */
if ( isset( $_GET['post'] ) ) { 
	$template_name = get_post_meta( $_GET['post'], '_wp_page_template', true );
	$post_type = get_post_type( $_GET['post'] );
} else { 
	$template_name = '';
	$post_type = '';
}

// Add default template to custom post
function r_default_content( $content, $post ) {
	global $r_option;

	$content = '';

	if ( isset( $post ) && $post->post_type == 'wp_events_manager' ) {
		if ( isset( $r_option[ 'event_template' ] ) )
			$content = $r_option[ 'event_template' ];
	}
	if ( isset( $post ) && $post->post_type == 'wp_artists' ) {
		if ( isset( $r_option['artist_template'] ) )
			$content = $r_option[ 'artist_template' ];
	}
	if ( isset( $post ) && $post->post_type == 'wp_releases' ) {
		if ( isset( $r_option['release_template'] ) )
			$content = $r_option[ 'release_template' ];
	}

	return $content;
}

add_filter( 'default_content', 'r_default_content', 10, 2 ); 

/* Sidebars Array */
if ( isset( $r_option['custom_sidebars'] ) ) 
	$s_list =  $r_option['custom_sidebars'];
else
	$s_list = null;


/* Intro Options
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Page header', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_intro_options', 
	'page' => array(
		'post', 
		'page', 
		'wp_releases', 
		'wp_events_manager', 
		'wp_artists', 
		'wp_gallery'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post', 
		'default', 
		'template-blog.php', 
		'template-events.php', 
		'template-archives.php', 
		'template-releases.php', 
		'template-gallery.php'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);	


/* Helper functions */

// Intro type
$intro_type = array(
	array( 'name' => _x( 'Default', 'Metaboxes', SHORT_NAME ), 'value' => 'default' ),
	array( 'name' => _x( 'Content', 'Metaboxes', SHORT_NAME ), 'value' => 'content' ),
	array( 'name' => _x( 'Nivo Slider', 'Metaboxes', SHORT_NAME ), 'value' => 'nivo_slider' ),
	array( 'name' => _x( 'Homepage Masonry', 'Metaboxes', SHORT_NAME ), 'value' => 'masonry' )
);
$type_count = count( $intro_type );

// Nivo Slider
$nivo_slider = array();
$sql_slider = $wpdb->get_results(
 	"
    SELECT
		{$wpdb->posts}.id,
		{$wpdb->posts}.post_title
  	FROM 
		{$wpdb->posts}
  	WHERE
		{$wpdb->posts}.post_type = 'wp_slider'
	AND 
		{$wpdb->posts}.post_status = 'publish'
	"
    );
  
if ( $sql_slider ) {
	$count = 0;
	foreach( $sql_slider as $slider_post ) {
		$nivo_slider[$count]['name'] = $slider_post->post_title;
		$nivo_slider[$count]['value'] = $slider_post->id;
		$count++;
	}
}

/* Audio Tracks  */
$tracks = array();
$sql_tracks = $wpdb->get_results(
 	"
    SELECT
		{$wpdb->posts}.id,
		{$wpdb->posts}.post_title
  	FROM 
		{$wpdb->posts}
  	WHERE
		{$wpdb->posts}.post_type = 'wp_tracks'
	AND 
		{$wpdb->posts}.post_status = 'publish'
	"
    );
  
if ( $sql_tracks ) {
	$count = 0;
	foreach( $sql_tracks as $track_post ) {
		$tracks[$count]['name'] = $track_post->post_title;
		$tracks[$count]['value'] = $track_post->id;
		$count++;
	}
}

/* Revolution slider */
$revslider = array();
if ( r_is_revslider() ) {
	/* Add slider to intro array */
	$type_count++;
	$intro_type[$type_count]['name'] = 'Revolution Slider';
	$intro_type[$type_count]['value'] = 'rev_slider';
	if ( r_get_revslider() ) {
		$revslider = r_get_revslider();
	}
}

/* Add special option for events template */
if ( $template_name == 'template-events.php' ) {
	$type_count++;
	$intro_type[$type_count]['name'] = 'Events Counter';
	$intro_type[$type_count]['value'] = 'events_counter';
}

/* Add special option for single event */
if ( $post_type == 'wp_events_manager' ) { 
	$type_count++;
	$intro_type[$type_count]['name'] = 'Event Countdown';
	$intro_type[$type_count]['value'] = 'event_countdown';
}

/* Add special option for releases template */
if ( $template_name == 'template-releases.php' ) {
	$intro_type = array(
		array(
			'name' => 'Releases Filter', 
			'value' => 'filter'
		)
	);
}

/* Meta options */
$meta_options = array(
	array(
		'name' => _x( 'Header Type', 'Metaboxes', SHORT_NAME ),
		'id' => '_header_type',
		'type' => 'select',
		'std' => 'default',
	  	'options' => $intro_type,
		'group' => 'header_type',
		'desc' => _x( 'Select header type.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Subtitle', 'Metaboxes', SHORT_NAME ),
		'id' => '_header_subtitle',
		'type' => 'textarea',
		'tinymce' => 'false',
		'std' => '',
		'height' => '40',
		'main_group' => 'header_type',
		'group_name' => array( 'default', 'filter', 'content', 'masonry', 'events_counter', 'event_countdown' ),
		'desc' => _x( 'Add subtitle below the main heading.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Background', 'Metaboxes', SHORT_NAME ),
		'id' => '_page_header_bg',
		'type' => 'bg_generator',
		'std' => '',
		'main_group' => 'header_type',
		'group_name' => array('default', 'filter', 'content', 'masonry', 'events_counter', 'event_countdown'),
		'desc' => _x( 'Generate header background. Please note that background image is disabled on mobile devices.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Nivo Slider', 'Metaboxes', SHORT_NAME ),
		'id' => '_nivo_slider_id',
		'type' => 'array_select',
		'options' => $nivo_slider,
		'std' => '',
		'main_group' => 'header_type',
		'group_name' => array('nivo_slider'),
		'desc' => _x( 'Select your slider; images must be 1920x600px. If there are no sliders available, then you can add a slider and images using Nivo Slider menu on the left.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Rev Slider', 'Metaboxes', SHORT_NAME ),
		'id' => '_revslider',
		'type' => 'array_select',
		'options' => $revslider,
		'std' => '',
		'main_group' => 'header_type',
		'group_name' => array('rev_slider'),
		'desc' => _x( 'Select your slider. If there are no sliders available, then you can add a slider and images using Revolution Slider menu on the left.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Header Content', 'Metaboxes', SHORT_NAME ),
		'id' => '_header_content',
		'type' => 'textarea',
		'tinymce' => 'true',
		'height' => '200',
		'std' => '',
		'height' => '100',
		'main_group' => 'header_type',
		'group_name' => array( 'content', 'masonry'),
		'desc' => _x( 'Add text to the intro section below the title.', 'Metaboxes', SHORT_NAME )
	),

	array(
		'name' => _x( 'Audio Player', 'Metaboxes', SHORT_NAME ),
		'id' => '_audio_player',
		'type' => 'switch_button',
		'std' => 'off',
		'group' => 'audio_player',
		'desc' => _x( 'If this opion is on, you should see audio player under the page header.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Tracks', 'Metaboxes', SHORT_NAME ),
		'id' => '_tracks_id',
		'type' => 'array_select',
		'options' => $tracks,
		'std' => '',
		'main_group' => 'audio_player',
		'group_name' => array('_audio_player'),
		'desc' => _x( 'Select your track or tracks. If there are no tracks available, then you can add them in Audio Tracks menu on the left.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Autostart', 'Metaboxes', SHORT_NAME ),
		'id' => '_autostart',
		'type' => 'switch_button',
		'std' => 'off',
		'main_group' => 'audio_player',
		'group_name' => array('_audio_player'),
		'desc' => _x( 'When this opion is on, the player will begin playing tracks automatically when the page loads. <br/> Please note that this option may not be supported by all mobile devices.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Display Playlist', 'Metaboxes', SHORT_NAME ),
		'id' => '_display_playlist',
		'type' => 'switch_button',
		'std' => 'off',
		'main_group' => 'audio_player',
		'group_name' => array( '_audio_player' ),
		'desc' => _x( 'If this opion is on, player playlist automatically be displayed without having to click on the playlist button.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$intro_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Page Options
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Page Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_page_options', 
	'page' => array(
		'page'
	), 
	'context' => 'side', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'default'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
	array(
		'name' => _x( 'Page Layout', 'Metaboxes', SHORT_NAME ),
		'id' => '_page_layout',
		'type' => 'select_image',
		'std' => 'wide',
		'images' => array(
			array('id' => 'sidebar_right', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/sidebar_right.png'),
			array('id' => 'wide', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/wide.png')
		),
		'group' => 'page_layout',
		'desc' => _x( 'Choose the page layout.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Custom Sidebar', 'Metaboxes', SHORT_NAME ),
		'id' => '_custom_sidebar',
		'type' => 'array_select',
		'array' => $s_list,
		'key' => 'name',
		'options' => array(
			array('value' => '_default', 'name' => _x( 'Default', 'Metaboxes', SHORT_NAME ))
		),
		'desc' => _x( 'Select custom or default sidebar.', 'Metaboxes', SHORT_NAME ),
		'main_group' => 'page_layout',
		'group_name' => array('sidebar_right'),
	)
);

/* Add class instance */
$page_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Post Options
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Post Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_post_options', 
	'page' => array(
		'post'
	), 
	'context' => 'side', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
	array(
		'name' => _x( 'Post Layout', 'Metaboxes', SHORT_NAME ),
		'id' => '_page_layout',
		'type' => 'select_image',
		'std' => 'sidebar_right',
		'images' => array(
			array('id' => 'sidebar_right', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/sidebar_right.png'),
			array('id' => 'wide', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/wide.png')
		),
		'group' => 'page_layout',
		'desc' => _x( 'Choose the page layout.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Custom Sidebar', 'Metaboxes', SHORT_NAME ),
		'id' => '_custom_sidebar',
		'type' => 'array_select',
		'array' => $s_list,
		'key' => 'name',
		'options' => array(
			array('value' => '_default', 'name' => _x( 'Default', 'Metaboxes', SHORT_NAME ))
		),
		'desc' => _x( 'Select custom or default sidebar.', 'Metaboxes', SHORT_NAME ),
		'main_group' => 'page_layout',
		'group_name' => array('sidebar_right'),
	)
);

/* Add class instance */
$post_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Post Short Description
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Short Description', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_post_short_desc', 
	'page' => array(
		'post'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
	array(
		'name' => _x( 'Short Description', 'Metaboxes', SHORT_NAME ),
		'id' => '_short_desc',
		'type' => 'textarea',
		'tinymce' => 'true',
		'height' => '200',
		'std' => '',
		'height' => '100',
		'desc' => _x( 'Optional summary or description of a post. This text is displayed on the page with posts list.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$post_short_desc_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Blog Options (Template)
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Blog Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_blog_options', 
	'page' => array(
		'page'
	), 
	'context' => 'side', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'template-home-blog.php', 
		'template-blog.php'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
					  
	array(
		'name' => _x( 'Blog Layout', 'Metaboxes', SHORT_NAME ),
		'id' => '_page_layout',
		'type' => 'select_image',
		'std' => 'sidebar_right',
		'images' => array(
			array('id' => 'sidebar_right', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/sidebar_right.png'),
			array('id' => 'wide', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/wide.png')
		),
		'group' => 'page_layout',
		'desc' => _x( 'Choose the page layout.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Custom Sidebar', 'Metaboxes', SHORT_NAME ),
		'id' => '_custom_sidebar',
		'type' => 'array_select',
		'array' => $s_list,
		'key' => 'name',
		'options' => array(
			array('value' => '_default', 'name' => _x( 'Default', 'Metaboxes', SHORT_NAME ))
		),
		'desc' => _x( 'Select custom or default sidebar.', 'Metaboxes', SHORT_NAME ),
		'main_group' => 'page_layout',
		'group_name' => array('sidebar_right')
	),
	array(
		'name' => _x( 'Blog Category', 'Metaboxes', SHORT_NAME ),
		'id' => '_blog_category',
		'type' => 'categories',
		'options' => array(
			array('value' => '_all', 'name' => _x( 'All', 'Metaboxes', SHORT_NAME ))
		),
		'desc' => _x( 'Categories without posts are not displayed.', 'Metaboxes', SHORT_NAME ),
	),
	array(
		'name' => _x( 'Posts Per Page', 'Metaboxes', SHORT_NAME ),
		'id' => '_limit',
		'type' => 'range',
		'min' => 1,
		'max' => 200,
		'unit' => 'posts',
		'std' => '6',
		'desc' => _x( 'Number of posts to display per page.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$blog_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Event Date and time Options
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Event Date', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_event_date_options', 
	'page' => array(
		'wp_events_manager'
	), 
	'context' => 'side', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
					  
	array(
		'name' => _x( 'Event Date', 'Metaboxes', SHORT_NAME ),
		'id' => array(
			array('id' => '_event_date_start', 'std' => date('Y-m-d')),
			array('id' => '_event_date_end', 'std' => date('Y-m-d'))
		),
		'type' => 'date_range',
		'desc' => _x( 'Enter the event date; eg 2010-09-11', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Event Time', 'Metaboxes', SHORT_NAME ),
		'id' => array(
			array('id' => '_event_time_start', 'std' => '21:00'),
			array('id' => '_event_time_end', 'std' => '00:00')
		),
		'type' => 'time_range',
		'desc' => _x( 'Enter the event time; eg 21:00', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Repeat', 'Metaboxes', SHORT_NAME ),
		'type' => 'select',
		'id' => '_repeat_event',
		'std' => 'default',
		'options' => array(
			array('name' => _x( 'None', 'Metaboxes', SHORT_NAME ), 'value' => 'none'),
			array('name' => _x( 'Weekly', 'Metaboxes', SHORT_NAME ), 'value' => 'weekly')
			//array('name' => _x( 'Monthly', 'Metaboxes', SHORT_NAME ), 'value' => 'monthly'),
		),
		'group' => 'repeat_event',
		'desc' => _x( 'Repeat event.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Every', 'Metaboxes', SHORT_NAME ),
		'id' => '_every',
		'type' => 'range',
		'min' => 1,
		'max' => 52,
		'unit' => _x( 'week(s)', 'Metaboxes', SHORT_NAME ),
		'std' => '1',
		'main_group' => 'repeat_event',
		'group_name' => array('weekly'),
		'desc' => _x( 'Repeat event every week(s).', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Day(s)', 'Metaboxes', SHORT_NAME ),
		'id' => '_weekly_days',
		'type' => 'multi_taxonomy',
		'std' => 'default',
		'size' => 2,
		'std' => array('monday'),
		'options' => array(
			array('name' => _x( 'Monday', 'Metaboxes', SHORT_NAME ), 'value' => 'monday'),
			array('name' => _x( 'Tuesday', 'Metaboxes', SHORT_NAME ), 'value' => 'tuesday'),
			array('name' => _x( 'Wednesday', 'Metaboxes', SHORT_NAME ), 'value' => 'wednesday'),
			array('name' => _x( 'Thursday', 'Metaboxes', SHORT_NAME ), 'value' => 'thursday'),
			array('name' => _x( 'Friday', 'Metaboxes', SHORT_NAME ), 'value' => 'friday'),
			array('name' => _x( 'Saturday', 'Metaboxes', SHORT_NAME ), 'value' => 'saturday'),
			array('name' => _x( 'Sunday', 'Metaboxes', SHORT_NAME ), 'value' => 'sunday'),
		),
		'main_group' => 'repeat_event',
		'group_name' => array('weekly'),
		'desc' => _x( 'Please use the CTRL key (PC) or COMMAND key (Mac) to select multiple items.', 'Metaboxes', SHORT_NAME )
		),
);

/* Add class instance */
$event_date_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Event Options
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Event Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_event_options', 
	'page' => array(
		'wp_events_manager'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
					  
	array(
		'name' => _x( 'Event Layout', 'Metaboxes', SHORT_NAME ),
		'type' => 'select_image',
		'std' => 'wide',
		'images' => array(
			array('id' => 'sidebar_right', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/sidebar_right.png'),
			array('id' => 'wide', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/wide.png')
		),
		'group' => 'event_layout',
		'id' => '_event_layout',
		'desc' => _x( 'Choose the event layout.', 'Metaboxes', SHORT_NAME )
	),
    array(
		'name' => _x( 'Custom Sidebar', 'Metaboxes', SHORT_NAME ),
		'id' => '_custom_sidebar',
		'type' => 'array_select',
		'array' => $s_list,
		'key' => 'name',
		'options' => array(
			array('value' => '_default', 'name' => _x( 'Default', 'Metaboxes', SHORT_NAME ))
		),
		'main_group' => 'event_layout',
		'group_name' => array('sidebar_right'),
		'desc' => _x( 'Select custom or default sidebar.', 'Metaboxes', SHORT_NAME )
	),
    array(
		'name' => _x( 'Event Location', 'Metaboxes', SHORT_NAME ),
		'id' => '_event_location',
		'type' => 'text',
		'std' => '',
		'desc' => _x( 'Enter the event location; eg.: Amsterdam, Holland', 'Metaboxes', SHORT_NAME )
	), 
    array(
		'name' => _x( 'Image', 'Metaboxes', SHORT_NAME ),
		'id' => array(
			array('id' => '_event_image', 'std' => ''),
			array('id' => '_event_image_crop', 'std' => 'c')
		),
		'type' => 'add_image',
		'by_id' => false,
		'width' => '60',
		'height' => '60',
		'crop' => 'c',
		'button_title' => _x( 'Add Image', 'Metaboxes', SHORT_NAME ),
		'msg' => _x('Currently you don\'t have image, you can add one by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Event image 60x60px. Shows on the list of events.', 'Metaboxes', SHORT_NAME )
	),
    array(
		'name' => _x( '(Optional) Masonry Image', 'Metaboxes', SHORT_NAME ),
		'id' => array(
			array('id' => '_event_masonry_image', 'std' => ''),
			array('id' => '_event_masonry_image_crop', 'std' => 'c')
		),
		'type' => 'add_image',
		'by_id' => false,
		'width' => '120',
		'height' => '120',
		'crop' => 'c',
		'button_title' => _x('Add Image', 'Metaboxes', SHORT_NAME ),
		'msg' => _x('Currently you don\'t have image, you can add one by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Masonry image is shown when [masonry_event] shortcode is being used and then the minimal size of the image is 468x468px.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$events_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Event Options (Template)
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Events Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_event_template_options', 
	'page' => array(
		'page'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'template-events.php'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
					  
	array(
		'name' => _x( 'Events Type', 'Metaboxes', SHORT_NAME ),
		'id' => '_event_type',
		'type' => 'select',
		'std' => 'future-events',
		'options' => array(
			array('name' => _x( 'Future events', 'Metaboxes', SHORT_NAME ), 'value' => 'future-events'),
			array('name' => _x( 'Events archive', 'Metaboxes', SHORT_NAME ), 'value' => 'past-events')
		),
		'group' => 'events_type',
		'desc' => _x( 'Choose the events type.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Events Limit', 'Metaboxes', SHORT_NAME ),
		'id' => '_limit',
		'type' => 'range',
		'min' => 1,
		'max' => 200,
		'unit' => _x( 'events', 'Metaboxes', SHORT_NAME ),
		'std' => '10',
		'desc' => _x( 'Number of events limit.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$events_template_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Releases Thumbnails Options
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Thumbnails Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_custom_releases_options', 
	'page' => array(
		'wp_releases'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
					  
	array(
		'name' => _x( 'Release Type', 'Metaboxes', SHORT_NAME ),
		'id' => '_release_type',
		'type' => 'select',
		'options' => array(
			array('name' => _x( 'Image', 'Metaboxes', SHORT_NAME ), 'value' => 'image'),
			array('name' => _x( 'Project link', 'Metaboxes', SHORT_NAME ), 'value' => 'project_link'),
			array('name' => _x( 'Image lightbox', 'Metaboxes', SHORT_NAME ), 'value' => 'lightbox_image'),
			array('name' => _x( 'Video lightbox', 'Metaboxes', SHORT_NAME ), 'value' => 'lightbox_video'),
			array('name' => _x( 'Soundcloud lightbox', 'Metaboxes', SHORT_NAME ), 'value' => 'lightbox_soundcloud'),
			array('name' => _x( 'Custom link', 'Metaboxes', SHORT_NAME ), 'value' => 'custom_link')
		),
		'group' => 'release_type',
		'desc' => _x( 'Select release type.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Thumbnail Effect', 'Metaboxes', SHORT_NAME ),
		'id' => '_thumb_type',
		'type' => 'select',
		'options' => array(
			array('name' => 'Thumbnail with icon', 'value' => 'thumb_icon'),
			array('name' => 'Thumbnail slide', 'value' => 'thumb_slide')
		),
		'group' => 'thumb_type',
		'main_group' => '_thumb_type',
		'group_name' => array('project_link','lightbox_image','lightbox_video','lightbox_soundcloud','custom_link'),
		'desc' => _x( 'Select image effect. It won\'t work with "Image" release type.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Thumbnail', 'Metaboxes', SHORT_NAME ),
		'type' => 'add_image',
		'id' => array(
			array('id' => '_release_image', 'std' => ''),
			array('id' => '_release_image_crop', 'std' => 'c')
		),
		'by_id' => false,
		'width' => '200',
		'height' => '200',
		'crop' => 'c',
		'button_title' => _x('Add Image', 'Metaboxes', SHORT_NAME ),
		'msg' => _x('Currently you don\'t have image, you can add one by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Release thumbnail. By default the size is 420x420px. If you want it to be splitted into two columns you have to use a 460x460px image at minimum.', 'Metaboxes', SHORT_NAME )
		),
	array(
		'name' => _x( 'Thumbnail 2', 'Metaboxes', SHORT_NAME ),
		'type' => 'add_image',
		'id' => array(
			array('id' => '_release_image_b', 'std' => ''),
			array('id' => '_release_image_b_crop', 'std' => 'c')
		),
		'by_id' => false,
		'width' => '200',
		'height' => '200',
		'crop' => 'c',
		'main_group' => '_thumb_type',
		'group_name' => array('thumb_slide'),
		'button_title' => _x('Add Image', 'Metaboxes', SHORT_NAME ),
		'msg' => _x('Currently you don\'t have image, you can add one by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Release thumbnail 2. By default the size is 420x420px. If you want it to be splitted into two columns you have to use a 460x460px image at minimum. It shows after you hover the mouse over.', 'Metaboxes', SHORT_NAME )
		),
	array(
		'name' => _x( 'Iframe Code', 'Metaboxes', SHORT_NAME ),
		'id' => '_release_iframe',
		'type' => 'iframe_generator',
		'std' => '',
		'main_group' => 'release_type',
		'group_name' => array('lightbox_video','lightbox_soundcloud'),
		'desc' => _x( 'Generate iframe code.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Lightbox Image', 'Metaboxes', SHORT_NAME ),
		'type' => 'text',
		'id' => '_lightbox_image',
		'main_group' => 'release_type',
		'group_name' => array('lightbox_image'),
		'desc' => _x( 'Paste the full URL (include http://) of your image. If this box is empty, then original image will be displayed in lightbox window.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Custom Link URL', 'Metaboxes', SHORT_NAME ),
		'id' => '_link_url',
		'type' => 'easy_link',
		'main_group' => 'release_type',
		'group_name' => array('custom_link'),
		'desc' => _x( 'Paste the full URL (include http://) of your link or click and select it from your site.', 'Metaboxes', SHORT_NAME )
	),
	array( 
		'name' => _x( 'Link Target', 'Metaboxes', SHORT_NAME ),
		'id' => '_target',
		'type' => 'switch_button',
		'std' => 'off',
		'main_group' => 'release_type',
		'group_name' => array('custom_link'),
		'desc' => _x( 'Open link in new window.', 'Metaboxes', SHORT_NAME ),
	),
	array(
		'name' => _x( 'Tooltip Title', 'Metaboxes', SHORT_NAME ),
		'id' => '_tooltip_title',
		'type' => 'text',
		'main_group' => 'release_type',
		'group_name' => array('project_link','lightbox_image','lightbox_video','lightbox_soundcloud','custom_link'),
		'desc' => _x( 'Custom tooltip title.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Tooltip Text', 'Metaboxes', SHORT_NAME ),
		'id' => '_tooltip_text',
		'type' => 'textarea',
		'height' => '100',
		'main_group' => 'release_type',
		'group_name' => array('project_link','lightbox_image','lightbox_video','lightbox_soundcloud','custom_link'),
		'desc' => _x( 'Tooltip text.', 'Metaboxes', SHORT_NAME )
	),
	array(
		  'name' => _x( 'Lightbox Group', 'Metaboxes', SHORT_NAME ),
		  'id' => '_lightbox_group',
		  'type' => 'text',
		  'main_group' => 'release_type',
		  'group_name' => array('lightbox_image','lightbox_video','lightbox_soundcloud'),
		  'desc' => _x( 'Enter the group name if you want to change the lightbox window images. Navigation arrows will be shown in a group of releases.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Badge', 'Metaboxes', SHORT_NAME ),
		'id' => '_badge',
		'type' => 'select',
		'options' => array(
			array('name' => '', 'value' => ''),
			array('name' => _x( 'New', 'Metaboxes', SHORT_NAME ), 'value' => 'new'),
			array('name' => _x( 'Free', 'Metaboxes', SHORT_NAME ), 'value' => 'free')
		),
		'group' => 'thumb_type',
		'main_group' => '_thumb_type',
		'group_name' => array('project_link','lightbox_image','lightbox_video','lightbox_soundcloud','custom_link'),
		'desc' => _x( 'Add a badge to your release.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$porfolio_custom_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Release Options
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Release Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_item_releases_options', 
	'page' => array(
		'wp_releases'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);


/* Meta options */
$meta_options = array(

	array(
		'name' => _x( 'Release Layout', 'Metaboxes', SHORT_NAME ),
		'id' => '_release_layout',
		'type' => 'select_image',
		'std' => 'wide',
		'images' => array(
			array('id' => 'sidebar_right', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/sidebar_right.png'),
			array('id' => 'wide', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/wide.png')
		),
		'group' => 'release_layout',
		'desc' => _x( 'Choose the release layout.', 'Metaboxes', SHORT_NAME )
	),
    array(
		'name' => _x( 'Custom Sidebar', 'Metaboxes', SHORT_NAME ),
		'id' => '_custom_sidebar',
		'type' => 'array_select',
		'array' => $s_list,
		'key' => 'name',
		'options' => array(
			array('value' => '_default', 'name' => _x( 'Default', 'Metaboxes', SHORT_NAME ))
		),
		'main_group' => 'release_layout',
		'group_name' => array('sidebar_right'),
		'desc' => _x( 'Select custom or default sidebar.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Catalogue Name/Number', 'Metaboxes', SHORT_NAME ),
		'id' => '_cat_num',
		'type' => 'text',
		'std' => '',
		'desc' => _x( 'Enter the catalogue name or number of your release.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$porfolio_item_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Releases Options (Template)
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Release Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_releases_options', 
	'page' => array(
		'page'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'template-releases.php'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);


/* Meta options */
$meta_options = array(

	array(
		'name' => _x( 'Layout', 'Metaboxes', SHORT_NAME ),
		'id' => '_releases_layout',
		'type' => 'select_image',
		'std' => '3',
		'images' => array(
			array('id' => '2', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/2_col.png'),
			array('id' => '3', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/3_col.png'),
			array('id' => '4', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/4_col.png')
		),
		'desc' => _x( 'Choose the releases layout.', 'Metaboxes', SHORT_NAME )
	),  
	array(
		'name' => _x( 'Genres', 'Metaboxes', SHORT_NAME ),
		'id' => '_releases_genres',
		'type' => 'multi_taxonomy',
		'taxonomy' => 'wp_release_genres',
		'term' => 'slug',
		'std' => array('_all'),
		'options' => array(
			array('value' => '_all', 'name' => _x( 'All', 'Metaboxes', SHORT_NAME ))
		),
		'desc' => _x( 'Please select multiple items. <br> Please note that if the category is empty, then it won\'t be displayed.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Artists', 'Metaboxes', SHORT_NAME ),
		'id' => '_releases_artists',
		'type' => 'multi_taxonomy',
		'taxonomy' => 'wp_release_artists',
		'term' => 'slug',
		'std' => array('_all'),
		'options' => array(
			array('value' => '_all', 'name' => _x( 'All', 'Metaboxes', SHORT_NAME ))
		),
		'desc' => _x( 'Please use the CTRL key (PC) or COMMAND key (Mac) to select multiple items.<br> Please note that if the category is empty, then it won\'t be displayed.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Releases Limit', 'Metaboxes', SHORT_NAME ),
		'id' => '_limit',
		'type' => 'range',
		'min' => 1,
		'max' => 100,
		'unit' => _x( 'releases', 'Metaboxes', SHORT_NAME ),
		'std' => '40',
		'desc' => _x( 'Number of releases limit.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Show "All" Button', 'Metaboxes', SHORT_NAME ),
		'id' => '_all_button',
		'type' => 'switch_button',
		'std' => 'on',
		'desc' => _x( 'If this option is disabled, then "All" button disappears from filter navigation.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Show Artists Filter', 'Metaboxes', SHORT_NAME ),
		'id' => '_artists_filter',
		'type' => 'switch_button',
		'std' => 'on',
		'desc' => _x( 'If this option is disabled, then Artists filter navigation disappears.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$releases_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Slider Images
------------------------------------------------------------------------*/

/* Meta info */

$meta_info = array(
	'title' => _x( 'Slider Images', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_slider_images', 
	'page' => array(
		'wp_slider'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
	array( 
		// 'name' => _x( 'Images', 'Metaboxes', SHORT_NAME ),
		'id' => '_custom_slider',
		'type' => 'media_manager',
		'media_type' => 'images', // images / audio / slider
		'msg_text' => _x(' Currently you don\'t have any images, you can add them by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'btn_text' => _x(' Add Images', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Add images to slider.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$slider_images_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Slider Options
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Slider Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_slider_options', 
	'page' => array(
		'wp_slider'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(



	array(
		'name' => _x(' Effect', 'Metaboxes', SHORT_NAME ),
		'id' => '_nivo_effect',
		'type' => 'select',
		'std' => 'random',
		'options' => array(
			array('name' => 'random', 'value' => 'random'),
			array('name' => 'sliceDown', 'value' => 'sliceDown'),
			array('name' => 'sliceDownLeft', 'value' => 'sliceDownLeft'),
			array('name' => 'sliceUp', 'value' => 'sliceUp'),
			array('name' => 'sliceUpLeft', 'value' => 'sliceUpLeft'),
			array('name' => 'sliceUpDown', 'value' => 'sliceUpDown'),
			array('name' => 'sliceUpDownLeft', 'value' => 'sliceUpDownLeft'),
			array('name' => 'fold', 'value' => 'fold'),
			array('name' => 'fade', 'value' => 'fade'),
			array('name' => 'slideInRight', 'value' => 'slideInRight'),
			array('name' => 'slideInLeft', 'value' => 'slideInLeft'),
			array('name' => 'boxRandom', 'value' => 'boxRandom'),
			array('name' => 'boxRainReverse', 'value' => 'boxRainReverse'),
			array('name' => 'boxRainGrow', 'value' => 'boxRainGrow'),
			array('name' => 'boxRainGrowReverse', 'value' => 'boxRainGrowReverse')
		),
		'desc' => _x(' Select header type.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x(' Show Navigation', 'Metaboxes', SHORT_NAME ),
		'id' => '_nivo_nav',
		'type' => 'switch_button',
		'std' => 'on',
		'desc' => _x(' If this opion is on, then you should see the slider navigation.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x(' Manual Advance', 'Metaboxes', SHORT_NAME ),
		'std' => 'on',
		'type' => 'switch_button',
		'id' => '_nivo_manual_advance',
		'desc' => _x(' Force manual transitions.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x(' Animation Speed', 'Metaboxes', SHORT_NAME ),
		'id' => '_nivo_speed',
		'type' => 'range',
		'min' => 200,
		'max' => 2000,
		'unit' => 'ms',
		'std' => '500',
		'desc' => _x(' Slider animation speed.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x(' Pause Time', 'Metaboxes', SHORT_NAME ),
		'id' => '_nivo_pause_time',
		'type' => 'range',
		'min' => 2000,
		'max' => 20000,
		'unit' => 'ms',
		'std' => '3000',
		'desc' => _x(' Determines how long each slide will be shown.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x(' Slices', 'Metaboxes', SHORT_NAME ),
		'id' => '_nivo_slices',
		'type' => 'range',
		'min' => 2,
		'max' => 30,
		'unit' => _x(' slices', 'Metaboxes', SHORT_NAME ),
		'std' => '15',
		'desc' => _x(' For slice animations.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x(' Box Cols', 'Metaboxes', SHORT_NAME ),
		'id' => '_nivo_boxcols',
		'type' => 'range',
		'min' => 4,
		'max' => 20,
		'unit' => _x(' cols', 'Metaboxes', SHORT_NAME ),
		'std' => '8',
		'desc' => _x(' Determines number of columns in box animations.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x(' Box Rows', 'Metaboxes', SHORT_NAME ),
		'id' => '_nivo_boxrows',
		'type' => 'range',
		'min' => 4,
		'max' => 20,
		'unit' => _x(' rows', 'Metaboxes', SHORT_NAME ),
		'std' => '4',
		'desc' => _x(' Determines number of rows in box animations.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$slider_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Tracks Manager
------------------------------------------------------------------------*/

/* Meta info */
$meta_info = array(
	'title' => _x( 'Audio Tracks', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_slider_images', 
	'page' => array(
		'wp_tracks'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
	array( 
		// 'name' => _x( 'Images', 'Metaboxes', SHORT_NAME ),
		'id' => '_audio_tracks',
		'type' => 'media_manager',
		'media_type' => 'audio', // images / audio / slider
		'msg_text' => _x(' Currently you don\'t have any audio tracks, you can add them by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'btn_text' => _x(' Add Tracks', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Add audio tracks.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$tracks_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Artists
------------------------------------------------------------------------*/

/* Meta info */
$meta_info = array(
	'title' => _x( 'Artist Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_artists_options', 
	'page' => array(
		'wp_artists'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(

	array(
		'name' => _x( 'Artist Layout', 'Metaboxes', SHORT_NAME ),
		'id' => '_artist_layout',
		'type' => 'select_image',
		'std' => 'wide',
		'images' => array(
			array('id' => 'sidebar_right', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/sidebar_right.png'),
			array('id' => 'wide', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/wide.png')
		),
		'group' => 'artist_layout',
		'desc' => _x( 'Choose the release layout.', 'Metaboxes', SHORT_NAME )
	),
    array(
		'name' => _x( 'Custom Sidebar', 'Metaboxes', SHORT_NAME ),
		'id' => '_custom_sidebar',
		'type' => 'array_select',
		'array' => $s_list,
		'key' => 'name',
		'options' => array(
			array('value' => '_default', 'name' => _x( 'Default', 'Metaboxes', SHORT_NAME ))
		),
		'main_group' => 'artist_layout',
		'group_name' => array('sidebar_right'),
		'desc' => _x( 'Select custom or default sidebar.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Artist Image', 'Metaboxes', SHORT_NAME ),
		'type' => 'add_image',
		'id' => array(
			array('id' => '_artist_image', 'std' => ''),
			array('id' => '_artist_image_crop', 'std' => 'c')
		),
		'width' => '200',
		'height' => '200',
		'crop' => 'c',
		'button_title' => _x('Add Image', 'Metaboxes', SHORT_NAME ),
		'msg' => _x('Currently you don\'t have image, you can add one by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'This image is shown on artists list. By default the size is 420x420px. If you want it to be splitted into two columns you have to use a 460x460px image at minimum.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$artists_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Gallery Album
------------------------------------------------------------------------*/
 
/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Album Cover', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_album_cover', 
	'page' => array(
		'wp_gallery'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);


/* Meta options */
$meta_options = array(

	array(
		'name' => _x( 'Artist Image', 'Metaboxes', SHORT_NAME ),
		'type' => 'add_image',
		'id' => array(
			array('id' => '_album_cover', 'std' => '')
		),
		'width' => '160',
		'height' => '160',
		'crop' => 'c',
		'button_title' => _x('Add Image', 'Metaboxes', SHORT_NAME ),
		'msg' => _x('Currently you don\'t have image, you can add one by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Album Cover image. By default the size is 420x420px. If you want it to be splitted into two columns you have to use a 460x460px image at minimum.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Tooltip Title', 'Metaboxes', SHORT_NAME ),
		'id' => '_tooltip_title',
		'type' => 'text',
		'desc' => _x( 'Custom tooltip title.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Tooltip Text', 'Metaboxes', SHORT_NAME ),
		'id' => '_tooltip_text',
		'type' => 'textarea',
		'height' => '100',
		'desc' => _x( 'Tooltip text.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$album_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Gallery Images
------------------------------------------------------------------------*/

/* Meta info */

$meta_info = array(
	'title' => _x( 'Album Images', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_album_images', 
	'page' => array(
		'wp_gallery'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);

/* Meta options */
$meta_options = array(
	array( 
		// 'name' => _x( 'Images', 'Metaboxes', SHORT_NAME ),
		'id' => '_gallery_images',
		'type' => 'media_manager',
		'media_type' => 'images', // images / audio / slider
		'msg_text' => _x(' Currently you don\'t have any images, you can add them by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'btn_text' => _x(' Add Images', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Add images.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$slider_images_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Gallery Album Template
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Albums Options', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_albums_options', 
	'page' => array(
		'page'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'template-gallery.php'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);


/* Meta options */
$meta_options = array(

	array(
		'name' => _x( 'Albums Layout', 'Metaboxes', SHORT_NAME ),
		'id' => '_gallery_layout',
		'type' => 'select_image',
		'std' => '3',
		'images' => array(
			array('id' => '2', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/2_col.png'),
			array('id' => '3', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/3_col.png'),
			array('id' => '4', 'image' => get_template_directory_uri() .  '/framework/admin/metabox/assets/images/icons/4_col.png')
		),
		'desc' => _x( 'Choose the releases layout.', 'Metaboxes', SHORT_NAME )
	),  
	array(
		'name' => _x( 'Albums Per Page', 'Metaboxes', SHORT_NAME ),
		'id' => '_limit',
		'type' => 'range',
		'min' => 1,
		'max' => 100,
		'unit' => _x( 'albums', 'Metaboxes', SHORT_NAME ),
		'std' => '8',
		'desc' => _x( 'Number of albums to be displayed per page.', 'Metaboxes', SHORT_NAME )
	)
);

/* Add class instance */
$album_template_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Footer Modules
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Footer Modules', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_footer_modules', 
	'page' => array(
		'post', 
		'page', 
		'wp_releases', 
		'wp_events_manager', 
		'wp_gallery'
	), 
	'context' => 'normal', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post', 
		'default', 
		'template-blog.php', 
		'template-events.php', 
		'template-archives.php', 
		'template-releases.php', 
		'template-gallery.php'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);


/* Meta options */
$meta_options = array(

	array(
		'name' => _x( 'Module Type', 'Metaboxes', SHORT_NAME ),
		'id' => '_footer_module',
		'type' => 'select',
		'std' => 'disabled',
		'options' => array(
			array('name' => _x( 'Disabled', 'Metaboxes', SHORT_NAME ), 'value' => 'disabled'),
			array('name' => _x( 'Google Map', 'Metaboxes', SHORT_NAME ), 'value' => 'gmap'),
			array('name' => _x( 'Upcoming Events', 'Metaboxes', SHORT_NAME ), 'value' => 'upcoming_events')
		),
		'group' => 'footer_module',
		'desc' => _x( 'Select footer module.', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Events Limit', 'Metaboxes', SHORT_NAME ),
		'id' => '_events_limit',
		'type' => 'range',
		'min' => 0,
		'max' => 50,
		'unit' => _x( 'events', 'Metaboxes', SHORT_NAME ),
		'std' => '0',
		'main_group' => 'footer_module',
		'group_name' => array('upcoming_events'),
		'desc' => _x( 'Number of events to show (0 = all active events). ', 'Metaboxes', SHORT_NAME )
	),
	array(
		'name' => _x( 'Address', 'Metaboxes', SHORT_NAME ),
		'id' => '_map_address',
		'type' => 'textarea',
		'tinymce' => 'false',
		'std' => '',
		'height' => '40',
		'main_group' => 'footer_module',
		'group_name' => array('gmap'),
		'desc' => _x( 'Enter the address; e.g: Level 13, 2 Elizabeth St, Melbourne Victoria 3000 Australia', 'Metaboxes', SHORT_NAME )
	)

);

/* Add class instance */
$footer_modules_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );


/* Facebook Image
------------------------------------------------------------------------*/

/* Meta info */ 
$meta_info = array(
	'title' => _x( 'Facebook Image', 'Metaboxes', SHORT_NAME ), 
	'id' =>'r_fb_options', 
	'page' => array(
		'post', 
		'page', 
		'wp_releases', 
		'wp_events_manager', 
		'wp_artists', 
		'wp_gallery'
	), 
	'context' => 'side', 
	'priority' => 'high', 
	'callback' => '', 
	'template' => array( 
		'post', 
		'default', 
		'template-blog.php', 
		'template-events.php', 
		'template-archives.php', 
		'template-releases.php', 
		'template-gallery.php'
	),
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/metabox',
	'textdomain' => SHORT_NAME

);


/* Meta options */
$meta_options = array(

	array(
		'name' => _x( 'Facebook Image', 'Metaboxes', SHORT_NAME ),
		'type' => 'add_image',
		'id' => array(
			array('id' => 'facebook_image', 'std' => '')
		),
		'width' => '160',
		'height' => '160',
		'crop' => 'c',
		'button_title' => _x('Add Image', 'Metaboxes', SHORT_NAME ),
		'msg' => _x('Currently you don\'t have facebook image, you can add one by clicking on the button below.', 'Metaboxes', SHORT_NAME ),
		'desc' => _x( 'Facebook image.', 'Metaboxes', SHORT_NAME )
	)

);

/* Add class instance */
$footer_modules_options_box = new R_Metabox( $meta_options, $meta_info );

/* Remove variables */
unset( $meta_options, $meta_info );