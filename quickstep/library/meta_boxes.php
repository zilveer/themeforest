<?php

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit: 
 * @link http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 */

/********************* META BOX DEFINITIONS ***********************/

$prefix = 'qs_';

global $meta_boxes, $pagenow;

$meta_boxes = array();

/* ---------------------------------------------------------------------- */
/*	Page Options
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'page-settings',
	'title'    => __('General Page Settings', 'qs_framework'),
	'pages'    => array('page'),
	'context'  => 'side',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Page Title', 'qs_framework'),
			'id'   => $prefix . 'page_title',
			'type' => 'text',
			'std'  => '',
			'desc' => __('This will display instead of the default page title.', 'qs_framework')
		),
		array(
			'name' => __('Page Subtitle', 'qs_framework'),
			'id'   => $prefix . 'page_subtitle',
			'type' => 'text',
			'std'  => '',
			'desc' => __('This is the text under the page title', 'qs_framework')
		),
		array(
			'name' => __('Remove Page Title', 'qs_framework'),
			'id'   => $prefix . 'remove_page_title',
			'type' => 'checkbox',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Remove from Navigation', 'qs_framework'),
			'id'   => $prefix . 'page_remove',
			'type' => 'checkbox',
			'std'  => '0',
			'desc' => __('This removes the page from the top navigation menu.  ', 'qs_framework')
		),
		array(
			'name' => __('Remove from One Page', 'qs_framework'),
			'id'   => $prefix . 'onepage_remove',
			'type' => 'checkbox',
			'std'  => '0',
			'desc' => __('This removes the page from the one page theme if checked. ', 'qs_framework')
		)            
	)
);

$meta_boxes[] = array(
	'id'       => 'page-style-settings',
	'title'    => __('Page Style', 'qs_framework'),
	'pages'    => array('page'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Page Background Color', 'qs_framework'),
			'id'   => $prefix . 'page_bg_color',
			'type' => 'color',
			'std'  => '',
			'desc' => __('This will override the general settings background color.', 'qs_framework')
		),
		array(
			'name' => __('Page Text Color', 'qs_framework'),
			'id'   => $prefix . 'page_text_color',
			'type' => 'color',
			'std'  => '',
			'desc' => __('This will override the general settings text color.', 'qs_framework')
		),
		array(
			'name' => __('Page Heading Color', 'qs_framework'),
			'id'   => $prefix . 'page_heading_color',
			'type' => 'color',
			'std'  => '',
			'desc' => __('This will override the general settings text heading color.', 'qs_framework')
		),
		array(
			'name' => __('Page Background Image', 'qs_framework'),
			'id'   => $prefix . 'page_bg_image',
			'type' => 'plupload_image',
			'std'  => '',
			'desc' => __('This will use a unique background image for this individual page.  Be careful not to use too many or it will slow down your website!', 'qs_framework')
		),
		array(
			'name'    => __('Page Background Repeat', 'qs_framework'),
			'id'      => $prefix . 'page_bg_repeat',
			'type'    => 'select',
			'std'     => 'no-repeat',
			'desc'    => 'This determines whether the background repeats or not, and if it repeats horizontally, vertically, both, or if it\'s stretched to fit the size of the screen.',
			'options' => array(
				'no-repeat'  => 'No Repeat',
				'repeat-x'   => 'Repeat Horizontally',
				'repeat-y'   => 'Repeat Vertically',
				'repeat'     => 'Repeat',
				'cover'		 => 'Cover'
			)
		),	
		array(
			'name'    => __('Page Background Attachment', 'qs_framework'),
			'id'      => $prefix . 'page_bg_attachment',
			'type'    => 'select',
			'std'     => 'scroll',
			'desc'    => 'This determines whether the background is fixed or scrolls with the web page.',
			'options' => array(
				'scroll'  => 'scroll',
				'fixed'   => 'fixed'
			)
		),	
		array(
			'name' => __('Page Background Position', 'qs_framework'),
			'id'   => $prefix . 'page_bg_position',
			'type' => 'text',
			'std'  => '',
			'desc' => __('This determines how the background is placed.  You can enter in percentage (x% y%) or pixels (i.e., 50px 100px)', 'qs_framework')
		),
		array(
			'name' => __('Page Height', 'qs_framework'),
			'id'   => $prefix . 'page_height',
			'type' => 'text',
			'std'  => '',
			'desc' => __('This fixes the page at a specific height.  ', 'qs_framework')
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Portfolio
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'project-info',
	'title'    => __('Project Information', 'qs_framework'),
	'pages'    => array('portfolio'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Client Name', 'qs_framework'),
			'id'   => $prefix . 'client_name',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Website', 'qs_framework'),
			'id'   => $prefix . 'project_website',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Short Description', 'qs_framework'),
			'id'   => $prefix . 'project_description',
			'type' => 'text',
			'std'  => '',
			'desc' => 'This will appear under the title on the portfolio image hover.'
		)
	)
);


/* ---------------------------------------------------------------------- */
/*	Features
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'feature-icon',
	'title'    => __('Select Feature Icon', 'qs_framework'),
	'pages'    => array('features'),
	'context'  => 'side',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Icon Letter', 'qs_framework'),
			'id'   => $prefix . 'icon_char',
			'type' => 'text',
			'std'  => '',
			'desc' => 'Enter the letter of the icon you would like to use.  If used, this will override the icon image.  (See documentation for a full list of possibilites!)'
		),
		array(
			'name' => __('Icon Color', 'qs_framework'),
			'id'   => $prefix . 'icon_color',
			'type' => 'color',
			'std'  => '',
			'desc' => 'Select the color of the icon)'
		),
		array(
			'name' => __('Icon Size', 'qs_framework'),
			'id'   => $prefix . 'icon_size',
			'type' => 'text',
			'std'  => '',
			'desc' => 'Enter the size of the icon)'
		),
	)
);


/* ---------------------------------------------------------------------- */
/*	Team
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'team-member-social-links',
	'title'    => __('Social Links', 'qs_framework'),
	'pages'    => array('team'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Email', 'qs_framework'),
			'id'   => $prefix . 'social_email',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('RSS', 'qs_framework'),
			'id'   => $prefix . 'social_rss',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Facebook Profile URL', 'qs_framework'),
			'id'   => $prefix . 'social_facebook',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Twitter Username', 'qs_framework'),
			'id'   => $prefix . 'social_twitter',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Pinterest', 'qs_framework'),
			'id'   => $prefix . 'social_pinterest',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Github', 'qs_framework'),
			'id'   => $prefix . 'social_github',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Path', 'qs_framework'),
			'id'   => $prefix . 'social_path',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('LinkedIn', 'qs_framework'),
			'id'   => $prefix . 'social_linkedin',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Dribbble', 'qs_framework'),
			'id'   => $prefix . 'social_dribbble',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Stumble Upon', 'qs_framework'),
			'id'   => $prefix . 'social_stumble-upon',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Behance', 'qs_framework'),
			'id'   => $prefix . 'social_behance',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Reddit', 'qs_framework'),
			'id'   => $prefix . 'social_reddit',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Google +', 'qs_framework'),
			'id'   => $prefix . 'social_google-plus',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Youtube', 'qs_framework'),
			'id'   => $prefix . 'social_youtube',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Vimeo', 'qs_framework'),
			'id'   => $prefix . 'social_vimeo',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Flickr', 'qs_framework'),
			'id'   => $prefix . 'social_flickr',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Slideshare', 'qs_framework'),
			'id'   => $prefix . 'social_slideshare',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Picasa', 'qs_framework'),
			'id'   => $prefix . 'social_picassa',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Skype', 'qs_framework'),
			'id'   => $prefix . 'social_skype',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Instagram', 'qs_framework'),
			'id'   => $prefix . 'social_instagram',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Pinterest', 'qs_framework'),
			'id'   => $prefix . 'social_foursquare',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Delicious', 'qs_framework'),
			'id'   => $prefix . 'social_delicious',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Chat', 'qs_framework'),
			'id'   => $prefix . 'social_chat',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Torso', 'qs_framework'),
			'id'   => $prefix . 'social_torso',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Tumblr', 'qs_framework'),
			'id'   => $prefix . 'social_tumblr',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Video Chat', 'qs_framework'),
			'id'   => $prefix . 'social_video-chat',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Digg', 'qs_framework'),
			'id'   => $prefix . 'social_digg',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('WordPress', 'qs_framework'),
			'id'   => $prefix . 'social_wordpress',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		)
	)
);

$meta_boxes[] = array(
	'id'       => 'team-member-settings',
	'title'    => __('Member Settings', 'qs_framework'),
	'pages'    => array('team'),
	'context'  => 'side',
	'priority' => 'default',
	'fields'   => array(
		array(
			'name' => __('Team Member Title', 'qs_framework'),
			'id'   => $prefix . 'job_title',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		)
	)
);
/* ---------------------------------------------------------------------- */
/*	Slider 
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'slider-slides-settings',
	'title'    => __('Slides', 'qs_framework'),
	'pages'    => array('slider'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('The Slides', 'qs_framework'),
			'id'   => $prefix . 'slider_slides',
			'type' => 'slider_slides',
			'std'  => '',
			'desc' => ''
		)
	)
);

$meta_boxes[] = array(
	'id'       => 'slider-settings',
	'title'    => __('Slider Settings', 'qs_framework'),
	'pages'    => array('slider'),
	'context'  => 'side',
	'priority' => 'default',
	'fields'   => array(
		array(
			'name'    => __('Animation between slides', 'qs_framework'),
			'id'      => $prefix . 'slider_animation',
			'type'    => 'select',
			'std'     => 'fade',
			'desc'    => '',
			'options' => array(
				'slide'               => 'slide',
				'fade'                => 'fade'
			)
		),	
		array(
			'name'    => __('Slide Direction', 'qs_framework'),
			'id'      => $prefix . 'slider_direction',
			'type'    => 'select',
			'std'     => 'horizontal',
			'desc'    => '',
			'options' => array(
				'horizontal'              => 'horizontal',
				'vertical'                => 'vertical'
			)
		),	
		array(
			'name' => __('Slideshow speed', 'qs_framework'),
			'id'   => $prefix . 'slider_speed',
			'type' => 'text',
			'std'  => '7000',
			'desc' => 'Time before switching to the next slide.'
		),
		array(
			'name' => __('Animation speed', 'qs_framework'),
			'id'   => $prefix . 'slider_animation_speed',
			'type' => 'text',
			'std'  => '600',
			'desc' => __('Duration of the animation between slides.', 'qs_framework')
		),
		array(
			'name' => __('Slideshow Height', 'qs_framework'),
			'id'   => $prefix . 'slider_height',
			'type' => 'text',
			'std'  => '',
			'desc' => __('Fixes the slider to a specific height (also prevents the slider from moving content up and down).', 'qs_framework')
		),
		array(
			'name' => __('Control Navigation', 'qs_framework'),
			'id'   => $prefix . 'slider_control_nav',
			'type' => 'checkbox',
			'std'  => '1',
			'desc' => 'Adds bullet navigation below the slider.'
		),
		array(
			'name' => __('Directional Navigation', 'qs_framework'),
			'id'   => $prefix . 'slider_directional_nav',
			'type' => 'checkbox',
			'std'  => '1',
			'desc' => 'Adds previous and next arrows to slider when hovered.'
		),
		array(
			'name' => __('Pause on action', 'qs_framework'),
			'id'   => $prefix . 'slider_pause_on_action',
			'type' => 'checkbox',
			'std'  => '0',
			'desc' => 'Pause the slideshow if navigation is clicked.'
		),
		array(
			'name' => __('Pause on hover', 'qs_framework'),
			'id'   => $prefix . 'slider_pause_on_hover',
			'type' => 'checkbox',
			'std'  => '0',
			'desc' => 'Pause the slideshow if the mouse hovers over it.'
		),
	)
);


/* ---------------------------------------------------------------------- */
/*	Post Format: Video
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-video-settings',
	'title'    => __('Video Settings', 'qs_framework'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Video Code', 'qs_framework'),
			'id'   => $prefix . 'video_code',
			'type' => 'textarea',
			'std'  => '',
			'desc' => __('You can paste video iframe or embed codes directly into this box.', 'qs_framework'),
			'cols' => '40',
			'rows' => '8'
		)
	)
);


/* ---------------------------------------------------------------------- */
/*	Post Format: Gallery
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-gallery-settings',
	'title'    => __('Gallery Settings', 'qs_framework'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Gallery Code', 'qs_framework'),
			'id'   => $prefix . 'gallery_code',
			'type' => 'textarea',
			'std'  => '',
			'desc' => __('Paste your slider shortcode here or anything else you\'d like to use.  You can use HTML.', 'qs_framework'),
			'cols' => '40',
			'rows' => '8'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Link
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-link-settings',
	'title'    => __('Link Settings', 'qs_framework'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Link', 'qs_framework'),
			'id'   => $prefix . 'link_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __('Add the URL here.', 'qs_framework'),
			'cols' => '40',
			'rows' => '8'
		),
		array(
			'name' => __('New Tab', 'qs_framework'),
			'id'   => $prefix . 'link_tab',
			'type' => 'checkbox',
			'std'  => '1',
			'desc' => __('Open the link in a new browser tab.', 'qs_framework')
		),
		array(
			'name' => __('AJAX Load', 'qs_framework'),
			'id'   => $prefix . 'link_ajax',
			'type' => 'checkbox',
			'std'  => '0',
			'desc' => __('This will load the link dynamically in your page if it\'s a page on your site.', 'qs_framework')
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Portfolio - Post Format
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'project-gallery-slider',
	'title'    => __('Project Slider', 'ss_framework'),
	'pages'    => array('portfolio'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Custom Project Code', 'qs_framework'),
			'id'   => $prefix . 'project_code',
			'type' => 'textarea',
			'std'  => '',
			'desc' => __('Paste a slider short code here if you want to show a slider instead of a single image.  You can also paste a video iframe or embed code directly into this box.', 'qs_framework'),
			'cols' => '40',
			'rows' => '8'
		)
	)
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function qs_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'qs_register_meta_boxes' );


?>