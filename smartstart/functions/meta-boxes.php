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

$prefix = 'ss_';

global $meta_boxes, $pagenow;

$meta_boxes = array();

/* ---------------------------------------------------------------------- */
/*	General
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'general-settings',
	'title'    => __('General Settings', 'ss_framework'),
	'pages'    => array('page', 'post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name'     => __('Page Layout', 'ss_framework'),
			'id'       => $prefix . 'page_layout',
			'type'     => 'radio_image',
			'options'  => array(
				''     => '<img src="' . SS_BASE_URL . 'functions/assets/img/xcol.png" alt="' . __('Use theme default setting', 'ss_framework') . '" title="' . __('Use theme default setting', 'ss_framework') . '" />',
				'1col' => '<img src="' . SS_BASE_URL . 'functions/assets/img/1col.png" alt="' . __('Fullwidth - No sidebar', 'ss_framework') . '" title="' . __('Fullwidth - No sidebar"', 'ss_framework') . ' />',
				'2cl'  => '<img src="' . SS_BASE_URL . 'functions/assets/img/2cl.png" alt="' . __('Sidebar on the left', 'ss_framework') . '" title="' . __('Sidebar on the left', 'ss_framework') . '" />',
				'2cr'  => '<img src="' . SS_BASE_URL . 'functions/assets/img/2cr.png" alt="' . __('Sidebar on the right', 'ss_framework') . '" title="' . __('Sidebar on the right', 'ss_framework') . '" />'
			),
			'std'  => ( isset( $_GET['post_type'] ) && ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) && $_GET['post_type'] == 'page' ?  '1col' : '' ),
			'desc' => __('Here you can overwrite the Site Structure setting from the Theme Options, just for this page.', 'ss_framework')
		) 
	)
);

/* ---------------------------------------------------------------------- */
/*	Pages
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'page-settings',
	'title'    => __('Page Settings', 'ss_framework'),
	'pages'    => array('page'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Page Title', 'ss_framework'),
			'id'   => $prefix . 'page_title',
			'type' => 'text',
			'std'  => '',
			'desc' => __('This field will overwrite the default page title.', 'ss_framework')
		),
		array(
			'name' => __('Page Description', 'ss_framework'),
			'id'   => $prefix . 'page_description',
			'type' => 'text',
			'std'  => '',
			'desc' => __('This will be shown under the page title', 'ss_framework')
		),
		array(
			'name' => __('Page Subdescription', 'ss_framework'),
			'id'   => $prefix . 'page_subdescription',
			'type' => 'text',
			'std'  => '',
			'desc' => __('This will be shown under the page title or under the page description', 'ss_framework')
		),
		array(
			'name' => __('Disable Page Header', 'ss_framework'),
			'id'   => $prefix . 'disable_page_header',
			'type' => 'checkbox',
			'std'  => '',
			'desc' => ''
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Link
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-link-settings',
	'title'    => __('Link Settings', 'ss_framework'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('The URL', 'ss_framework'),
			'id'   => $prefix . 'link_src',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Quote
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-quote-settings',
	'title'    => __('Quote Settings', 'ss_framework'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('The Quote', 'ss_framework'),
			'id'   => $prefix . 'quote',
			'type' => 'textarea',
			'std'  => '',
			'desc' => '',
			'cols' => '40',
			'rows' => '8'
		),
		array(
			'name' => __('The Author', 'ss_framework'),
			'id'   => $prefix . 'quote_author',
			'type' => 'text',
			'std'  => '',
			'desc' => __('(optional)', 'ss_framework')
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Video
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-video-settings',
	'title'    => __('Video Settings', 'ss_framework'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('MP4 File URL', 'ss_framework'),
			'id'   => $prefix . 'video_mp4',
			'type' => 'text',
			'std'  => '',
			'desc' => __('For Safari, IE9, iPhone, iPad, Android, and Windows Phone 7.', 'ss_framework')
		),
		array(
			'name' => __('WebM File URL', 'ss_framework'),
			'id'   => $prefix . 'video_webm',
			'type' => 'text',
			'std'  => '',
			'desc' => __('For Firefox, Opera, and Chrome.', 'ss_framework')
		),
		array(
			'name' => __('OGG File URL', 'ss_framework'),
			'id'   => $prefix . 'video_ogg',
			'type' => 'text',
			'std'  => '',
			'desc' => __('For older Firefox and Opera versions.', 'ss_framework')
		),
		array(
			'name' => __('Preview Image URL', 'ss_framework'),
			'id'   => $prefix . 'video_preview',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Aspect Ratio', 'ss_framework'),
			'id'   => $prefix . 'video_aspect_ratio',
			'type' => 'text',
			'std'  => '1.7',
			'desc' => __('Video width / video height. (default: 1.7)', 'ss_framework')
		),
		array(
			'name' => __('External Video', 'ss_framework'),
			'id'   => $prefix . 'video_external',
			'type' => 'textarea',
			'std'  => '',
			'desc' => __('For example embed code.', 'ss_framework'),
			'cols' => '40',
			'rows' => '8'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Audio
/* ---------------------------------------------------------------------- */
$meta_boxes[] = array(
	'id'       => 'post-audio-settings',
	'title'    => __('Audio Settings', 'ss_framework'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('MP3 File URL', 'ss_framework'),
			'id'   => $prefix . 'audio_mp3',
			'type' => 'text',
			'std'  => '',
			'desc' => __('For Safari, Internet Explorer, Chrome.', 'ss_framework')
		),
		array(
			'name' => __('OGG File URL', 'ss_framework'),
			'id'   => $prefix . 'audio_ogg',
			'type' => 'text',
			'std'  => '',
			'desc' => __('For Firefox, Opera, Chrome.', 'ss_framework')
		),		
		array(
			'name' => __('External Audio', 'ss_framework'),
			'id'   => $prefix . 'audio_external',
			'type' => 'textarea',
			'std'  => '',
			'desc' => __('For example embed code.', 'ss_framework'),
			'cols' => '40',
			'rows' => '8'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Custom Post Type: Team
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'team-member-social-links',
	'title'    => __('Social Links', 'ss_framework'),
	'pages'    => array('team'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Behance Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_behance',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Delicious Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_delicious',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('deviantART Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_deviantart',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Digg Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_digg',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Dribbble Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_dribbble',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Dropbox Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_dropbox',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Email Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_email',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Facebook Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_facebook',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Flickr Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_flickr',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Forrst Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_forrst',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('GitHub Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_github',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Google Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_google',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Google+ Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_googleplus',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('iChat Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_ichat',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Last.fm Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_lastfm',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('LinkedIn Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_linkedin',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Mobypicture Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_mobypicture',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('MySpace Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_myspace',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Picasa Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_picasa',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Pinterest Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_pinterest',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Plixi Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_plixi',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Skype Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_skype',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('StumbleUpon Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_stumbleupon',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Tumblr Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_tumblr',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Twitter Username', 'ss_framework'),
			'id'   => $prefix . 'social_link_twitter',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('Vimeo Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_vimeo',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		),
		array(
			'name' => __('YouTube Profile URL', 'ss_framework'),
			'id'   => $prefix . 'social_link_youtube',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		)
	)
);

$meta_boxes[] = array(
	'id'       => 'team-member-settings',
	'title'    => __('Member Settings', 'ss_framework'),
	'pages'    => array('team'),
	'context'  => 'side',
	'priority' => 'default',
	'fields'   => array(
		array(
			'name' => __('The Job Title', 'ss_framework'),
			'id'   => $prefix . 'job_title',
			'type' => 'text',
			'std'  => '',
			'desc' => ''
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Custom Post Type: Slider
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'slider-slides-settings',
	'title'    => __('Slides', 'ss_framework'),
	'pages'    => array('slider'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('The Slides', 'ss_framework'),
			'id'   => $prefix . 'slider_slides',
			'type' => 'slider_slides',
			'std'  => '',
			'desc' => ''
		)
	)
);

$meta_boxes[] = array(
	'id'       => 'basic-slider-settings',
	'title'    => __('Basic Slider Settings', 'ss_framework'),
	'pages'    => array('slider'),
	'context'  => 'side',
	'priority' => 'default',
	'fields'   => array(
		array(
			'name'    => __('Transition type for the animation', 'ss_framework'),
			'id'      => $prefix . 'slider_transition',
			'type'    => 'select',
			'std'     => 'random',
			'desc'    => '',
			'options' => array(
				'def'                 => 'def',
				'fade'                => 'fade',
				'seqFade'             => 'seqFade',
				'horizontalSlide'     => 'horizontalSlide',
				'seqHorizontalSlide'  => 'seqHorizontalSlide',
				'verticalSlide'       => 'verticalSlide',
				'seqVerticalSlide'    => 'seqVerticalSlide',
				'verticalSlideAlt'    => 'verticalSlideAlt',
				'seqVerticalSlideAlt' => 'seqVerticalSlideAlt',
				'random'              => 'random'
			)
		),	
		array(
			'name' => __('Speed of the animation transition', 'ss_framework'),
			'id'   => $prefix . 'slider_speed',
			'type' => 'text',
			'std'  => '400',
			'desc' => ''
		),
		array(
			'name' => __('Time between slide transitions', 'ss_framework'),
			'id'   => $prefix . 'slider_autoplay',
			'type' => 'text',
			'std'  => '3000',
			'desc' => __('0 to disable autoplay.', 'ss_framework')
		),
		array(
			'name' => __('Interval between each slide\'s animation', 'ss_framework'),
			'id'   => $prefix . 'slider_seq_factor',
			'type' => 'text',
			'std'  => '100',
			'desc' => __('Used for seqFade, seqHorizontalSlide, seqVerticalSlide &amp; seqVerticalSlideAlt.', 'ss_framework')
		),
		array(
			'name' => __('First slide to be displayed', 'ss_framework'),
			'id'   => $prefix . 'slider_first_slide',
			'type' => 'text',
			'std'  => '0',
			'desc' => __('Zero-based index.', 'ss_framework')
		)
	)
);

$meta_boxes[] = array(
	'id'       => 'advanced-slider-settings',
	'title'    => __('Advanced Slider Settings', 'ss_framework'),
	'pages'    => array('slider'),
	'context'  => 'side',
	'priority' => 'default',
	'fields'   => array(
		array(
			'name'    => __('Easing type for the animation.', 'ss_framework'),
			'id'      => $prefix . 'slider_easing',
			'type'    => 'select',
			'std'     => 'easeInOutExpo',
			'desc'    => '',
			'options' => array(
				'linear'           => 'linear',
				'swing'            => 'swing',
				'jswing'           => 'jswing',
				'easeInQuad'       => 'easeInQuad',
				'easeOutQuad'      => 'easeOutQuad',
				'easeInOutQuad'    => 'easeInOutQuad',
				'easeInCubic'      => 'easeInCubic',
				'easeOutCubic'     => 'easeOutCubic',
				'easeInOutCubic'   => 'easeInOutCubic',
				'easeInQuart'      => 'easeInQuart',
				'easeOutQuart'     => 'easeOutQuart',
				'easeInOutQuart'   => 'easeInOutQuart',
				'easeInQuint'      => 'easeInQuint',
				'easeOutQuint'     => 'easeOutQuint',
				'easeInOutQuint'   => 'easeInOutQuint',
				'easeInSine'       => 'easeInSine',
				'easeOutSine'      => 'easeOutSine',
				'easeInOutSine'    => 'easeInOutSine',
				'easeInExpo'       => 'easeInExpo',
				'easeOutExpo'      => 'easeOutExpo',
				'easeInOutExpo'    => 'easeInOutExpo',
				'easeInCirc'       => 'easeInCirc',
				'easeOutCirc'      => 'easeOutCirc',
				'easeInOutCirc'    => 'easeInOutCirc',
				'easeInElastic'    => 'easeInElastic',
				'easeOutElastic'   => 'easeOutElastic',
				'easeInOutElastic' => 'easeInOutElastic',
				'easeInBack'       => 'easeInBack',
				'easeOutBack'      => 'easeOutBack',
				'easeInOutBack'    => 'easeInOutBack',
				'easeInBounce'     => 'easeInBounce',
				'easeOutBounce'    => 'easeOutBounce',
				'easeInOutBounce'  => 'easeInOutBounce'
			)
		),
		array(
			'name' => __('Pause autoplay on mouseover', 'ss_framework'),
			'id'   => $prefix . 'slider_pause_on_hover',
			'type' => 'checkbox',
			'std'  => '1',
			'desc' => ''
		),
		array(
			'name' => __('Stop autoplay on click', 'ss_framework'),
			'id'   => $prefix . 'slider_stop_on_click',
			'type' => 'checkbox',
			'std'  => '0',
			'desc' => ''
		),
		array(
			'name'    => __('Content box position', 'ss_framework'),
			'id'      => $prefix . 'slider_content_position',
			'type'    => 'select',
			'std'     => 'def',
			'desc'    => '',
			'options' => array(
				''     => 'default',
				'center' => 'center',
				'bottom' => 'bottom'
			)
		),
		array(
			'name' => __('Speed of the content box transition', 'ss_framework'),
			'id'   => $prefix . 'slider_content_speed',
			'type' => 'text',
			'std'  => '450',
			'desc' => ''
		),
		array(
			'name' => __('Show content box only on mouseover', 'ss_framework'),
			'id'   => $prefix . 'slider_show_content_onhover',
			'type' => 'checkbox',
			'std'  => '1',
			'desc' => ''
		),
		array(
			'name' => __('Hide content box', 'ss_framework'),
			'id'   => $prefix . 'slider_hide_content',
			'type' => 'checkbox',
			'std'  => '0',
			'desc' => ''
		),
		array(
			'name' => __('Hide bottom navigation buttons', 'ss_framework'),
			'id'   => $prefix . 'slider_hide_bottom_buttons',
			'type' => 'checkbox',
			'std'  => '0',
			'desc' => ''
		),
		array(
			'name' => __('Slider container height', 'ss_framework'),
			'id'   => $prefix . 'slider_height',
			'type' => 'text',
			'std'  => '380',
			'desc' => ''
		),
		array(
			'name' => __('Slider container width', 'ss_framework'),
			'id'   => $prefix . 'slider_width',
			'type' => 'text',
			'std'  => '940',
			'desc' => ''
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Custom Post Type: Portfolio
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'project-settings',
	'title'    => __('Project Settings', 'ss_framework'),
	'pages'    => array('portfolio'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name'     => __('Project Page Layout', 'ss_framework'),
			'id'       => $prefix . 'project_page_layout',
			'type'     => 'radio_image',
			'options'  => array(
				'1col' => '<img src="' . SS_BASE_URL . 'functions/assets/img/1col-2.png" alt="' . __('Fullwidth', 'ss_framework') . '" title="' . __('Fullwidth"', 'ss_framework') . ' />',
				'2cl'  => '<img src="' . SS_BASE_URL . 'functions/assets/img/2cl.png" alt="' . __('Content on the left', 'ss_framework') . '" title="' . __('Content on the left', 'ss_framework') . '" />',
				'2cr'  => '<img src="' . SS_BASE_URL . 'functions/assets/img/2cr.png" alt="' . __('Content on the right', 'ss_framework') . '" title="' . __('Content on the right', 'ss_framework') . '" />'
			),
			'std'  => '2cr',
			'desc' => ''
		) 
	)
);

$meta_boxes[] = array(
	'id'       => 'project-gallery-slider',
	'title'    => __('Project Slider', 'ss_framework'),
	'pages'    => array('portfolio'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Disable slider', 'ss_framework'),
			'id'   => $prefix . 'disable_project_slider',
			'type' => 'checkbox',
			'std'  => '',
			'desc' => __('By checking this option, you can disable the slider functionality (JavaScript part). But slides will be still generated, so you can use slides as you normally would.', 'ss_framework')
		),
		array(
			'name' => __('The Slides', 'ss_framework'),
			'id'   => $prefix . 'project_slider',
			'type' => 'project_slider',
			'std'  => '',
			'desc' => __('If slider has only one slide and it\'s totally empty, slider won\'t be created. <br /> Also, if slider has <u>only one</u> slide, which has any content, slider pagination arrows will be hidden.', 'ss_framework')
		)
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function ss_framework_register_meta_boxes()
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
add_action( 'admin_init', 'ss_framework_register_meta_boxes' );