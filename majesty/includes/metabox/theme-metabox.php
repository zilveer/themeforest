<?php
/**
 * This File need CMB2 Plugin for MetaBox
 * @category Majesty
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */


add_action( 'cmb2_init', 'sama_register_post_layout' );
/**
 * Used To Add Page Layout [ Fullwidth, leftsidebar, rightsidebar ]
 */
function sama_register_post_layout() {
	
	$prefix = '_sama_';;
	
	$post_settings = new_cmb2_box( array(
		'id'           => $prefix . 'post_settings',
		'title'        => esc_html__( 'Layout', 'theme-majesty' ),
		'object_types' => array('post'),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	));
	$post_settings->add_field( array(
		'name'    => esc_html__( 'LightBox', 'theme-majesty' ),
		'desc'    => esc_html__( 'Open LightBox to post thumbnail when click image', 'theme-majesty' ),
		'id'      => $prefix . 'lightbox',
		'type'    => 'multicheck',
		'options' => array(
			'open' 			=> esc_html__( 'Open', 'theme-majesty' ),
			'display_title'	=> esc_html__( 'Display Thumbnail Title in Light Box', 'theme-majesty' ),
		),
		'inline'  => true, // Toggles display to inline
	) );
	
	// Used in Youtube, Viemo, Soundcolud
	$post_settings->add_field( array(
		'name'		=> esc_html__( 'OEmbed', 'theme-majesty' ),
		'desc'		=> esc_html__( 'Displays Youtube, viemo, soundcloud embedded media using WordPress built-in oEmbed support.', 'theme-majesty' ),
		'id'		=> $prefix . 'oembed',
		'type'		=> 'oembed',
		'row_classes' => 'post-oembed'
	));
	
	$post_settings->add_field( array(
		'name'		=> esc_html__( 'HTML5 Video MP4', 'theme-majesty' ),
		'desc'		=> esc_html__( 'URL.', 'theme-majesty' ),
		'id'		=> $prefix . 'video_mp4',
		'type'		=> 'file',
		'row_classes' => 'post-video-mp4'
	));
	
	$post_settings->add_field( array(
		'name'		=> esc_html__( 'HTML5 Video WebM', 'theme-majesty' ),
		'desc'		=> esc_html__( 'URL.', 'theme-majesty' ),
		'id'		=> $prefix . 'video_webm',
		'type'		=> 'file',
		'row_classes' => 'post-video-webm'
	));
	$post_settings->add_field( array(
		'name'		=> esc_html__( 'HTML5 Video OGV', 'theme-majesty' ),
		'desc'		=> esc_html__( 'URL.', 'theme-majesty' ),
		'id'		=> $prefix . 'video_ogg',
		'type'		=> 'file',
		'row_classes' => 'post-video-ogg'
	));
	$post_settings->add_field( array(
		'name'    => esc_html__( 'VIDEO Attributes', 'theme-majesty' ),
		'desc'    => esc_html__( 'Used For HTML5 Video Attributes (optional)', 'theme-majesty' ),
		'id'      => $prefix . 'video_attr',
		'type'    => 'multicheck',
		'row_classes' => 'post-video-attr',
		'options' => array(
			'controls'  => esc_html__( 'Controls', 'theme-majesty' ),
			'loop'  	=> esc_html__( 'Loop', 'theme-majesty' ),
			'muted'  	=> esc_html__( 'muted', 'theme-majesty' ),
			'preload'  	=> esc_html__( 'Preload', 'theme-majesty' ),
		),
		'inline'  => true, // Toggles display to inline
	) );
	$post_settings->add_field( array(
		'name'		=> esc_html__( 'Poster Image', 'theme-majesty' ),
		'desc'		=> esc_html__( 'Upload an image or enter a URL For browser not support video.', 'theme-majesty' ),
		'id'		=> $prefix . 'video_poster',
		'type'		=> 'file',
		'row_classes' => 'post-video-poster'
	));
}


add_action( 'cmb2_init', 'sama_register_page_custom_header' );
/**
 * Custom Header Background
 */
function sama_register_page_custom_header() {
	
	$prefix = '_sama_';;
	
	$page_header = new_cmb2_box( array(
		'id'           => $prefix . 'page_header',
		'title'        => esc_html__( 'Page Header', 'theme-majesty' ),
		'object_types' => array('page'),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
		'show_on'   =>  array( 'key' => 'hide-from-page-builder-slider', 'value' => array('page-templates/page-builder', 'page-templates/page-blank' ) ),
	));
	
	$page_header->add_field( array(
		'name' => esc_html__( 'Custom Header Background', 'theme-majesty' ),
		'id'   => $prefix . 'page_with_bg',
		'type' => 'select',
		'options'          => array(
			'yes'   		=> esc_html__( 'Yes', 'theme-majesty' ),
			'' 				=> esc_html__( 'No', 'theme-majesty' ),
		),
	));
	
	$page_header->add_field( array(
		'name' => esc_html__( 'Display Top Icon', 'theme-majesty' ),
		'id'   => $prefix . 'page_display_icon',
		'type' => 'select',
		'options'          	=> array(
			'yes'   		=> esc_html__( 'Yes', 'theme-majesty' ),
			'no' 			=> esc_html__( 'No', 'theme-majesty' ),
			
		),
	));
	
	$page_header->add_field( array(
		'name'       => esc_html__( 'Icon Name', 'theme-majesty' ),
		'desc'    	 => esc_html__('Full CSS icon and you can use font awesome icons', 'theme-majesty'),
		'id'   		 => $prefix . 'page_icon_css',
		'type'       => 'text',
		'default' 	 => 'icon-home-ico',
	));
	
	$page_header->add_field( array(
		'name'       => esc_html__( 'Sub Title', 'theme-majesty' ),
		'id'   		 => $prefix . 'page_subtitle',
		'type'       => 'text',
	));
	
	$page_header->add_field( array(
		'name'		=> esc_html__( 'Upload image background', 'theme-majesty' ),
		'id'		=> $prefix . 'page_bg',
		'type'		=> 'file',
	));
	
	$page_header->add_field( array(
		'name' 		=> esc_html__( 'Parallax', 'theme-majesty' ),
		'id'   		=> $prefix . 'page_bg_parallax',
		'type' 		=> 'select',
		'options'  	=> array(
			'yes'   	=> esc_html__( 'Yes', 'theme-majesty' ),
			'no' 		=> esc_html__( 'No', 'theme-majesty' ),
		),
	));
	
}


/* Used For team member post && product */
function sama_register_page_layout_for_team_member() {
	$prefix = '_sama_';;
	
	$team_member_layout = new_cmb2_box( array(
		'id'           => $prefix . 'post_layoutss',
		'title'        => esc_html__( 'Layout', 'theme-majesty' ),
		'object_types' => array('team-member', 'post'),
		'context'      => 'side',
		'priority'     => 'high',
		'show_names'   => false,
	));

	$team_member_layout->add_field( array(
		'name' => esc_html__( 'Layout', 'theme-majesty' ),
		'id'   => $prefix . 'post_layout',
		'type' => 'radio',
		'options'          => array(
			//'default'		=> esc_html__( 'default', 'theme-majesty' ),
			'rightsidebar' 	=> esc_html__( 'Right Sidebar', 'theme-majesty' ),
			'fullwidth' 	=> esc_html__( 'Full Width', 'theme-majesty' ),
			'leftsidebar'	=> esc_html__( 'Left Sidebar', 'theme-majesty' ),
		)
	));
}
add_action( 'cmb2_init', 'sama_register_page_layout_for_team_member');


function sama_register_page_layout_for_product() {
	$prefix = '_sama_';;
	
	$product_layout = new_cmb2_box( array(
		'id'           => $prefix . 'product_layout',
		'title'        => esc_html__( 'Layout', 'theme-majesty' ),
		'object_types' => array('product'),
		'context'      => 'side',
		'priority'     => 'high',
		'show_names'   => false,
	));
	$product_layout->add_field( array(
		'name' => esc_html__( 'Layout', 'theme-majesty' ),
		'id'   => $prefix . 'product_layout',
		'type' => 'radio',
		'options'          => array(
			//'default'		=> esc_html__( 'default', 'theme-majesty' ),
			'fullwidth' 		=> esc_html__( 'Full Width', 'theme-majesty' ),
			'leftsidebar'		=> esc_html__( 'Left Sidebar', 'theme-majesty' ),
			'leftsidebar2col'	=> esc_html__( 'Left Sidebar 2 Column', 'theme-majesty' ),
			'rightsidebar' 		=> esc_html__( 'Right Sidebar', 'theme-majesty' ),
			'rightsidebar2col'	=> esc_html__( 'Right Sidebar 2 Column', 'theme-majesty' ),
		)
	));
}
add_action( 'cmb2_init', 'sama_register_page_layout_for_product');
/*
 *	Used For Page Builder
 */
function sama_register_page_slider_settings() {
	
	$prefix = '_sama_';
	
	$transparent = array(
		'no' 		=> esc_html__( 'No', 'theme-majesty' ),
		'transparent-bg-1'		=> esc_html__('Transparent 0.1', 'theme-majesty'),
		'transparent-bg-2'		=> esc_html__('Transparent 0.2', 'theme-majesty'),
		'transparent-bg-3'		=> esc_html__('Transparent 0.3', 'theme-majesty'),
		'transparent-bg-4'		=> esc_html__('Transparent 0.4', 'theme-majesty'),
		'transparent-bg-5'		=> esc_html__('Transparent 0.5', 'theme-majesty'),
		'transparent-bg-6'		=> esc_html__('Transparent 0.6', 'theme-majesty'),
		'transparent-bg-7' 		=> esc_html__('Transparent 0.7', 'theme-majesty'),
		'transparent-bg-8' 		=> esc_html__('Transparent 0.8', 'theme-majesty'),
		'transparent-bg-9'		=> esc_html__('Transparent 0.9', 'theme-majesty'),
	);
	
	/* This field used in group with same name */
	// Field Overlay 
	$overlay_field = array(
		'name'       => esc_html__( 'Overaly', 'theme-majesty' ),
		'id'         => 'overlay',
		'type'       => 'select',
		'show_option_none' 	=> false,
		'options'          	=> $transparent,
	);
	
	// Field Image
	$image_field =  array(
		'name'       => esc_html__( 'Background Image', 'theme-majesty' ),
		'id'         => 'image',
		'type'       => 'file',
	);
	
	// Field Content
	$content_field = array(
		'name'       => esc_html__( 'Content', 'theme-majesty' ),
		'id'         => 'content',
		'type'       => 'textarea_code',
	);
	
	$array_boolean = array(
		'true' 		=> esc_html__( 'True', 'theme-majesty' ),
		'false'   	=> esc_html__( 'False', 'theme-majesty' ),
	);
	
	$slider_settings = new_cmb2_box( array(
		'id'           => $prefix . 'slider_settings',
		'title'        => esc_html__( 'Header & Slider Settings', 'theme-majesty' ),
		'object_types' => array('page'),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => array('page-templates/page-builder.php', 'page-templates/page-blank.php') ),
	));
	
	$slider_settings->add_field( array(
		'name' 			   	=> esc_html__( 'Select Header & Menu', 'theme-majesty' ),
		'description' 		=> esc_html__( 'Please Use Menu Solid Only if you not using slider.', 'theme-majesty' ),
		'id'               	=> $prefix . 'menu_type',
		'type'             	=> 'select',
		//'show_option_none' => true,
		'options'          => array(
			'Light-default-transparent' 		=> esc_html__( 'Default Menu', 'theme-majesty' ),	// Logo Left
			'light-center-transparent'   		=> esc_html__( 'Light With Center Logo', 'theme-majesty' ), // logo center
			'light-bottom-center'				=> esc_html__( 'Light Bottom Center Menu', 'theme-majesty' ), // hide log
			'dark-default-transparent' 			=> esc_html__( 'Dark Menu', 'theme-majesty' ),	// Logo Left
			'dark-center-transparent'   		=> esc_html__( 'Dark With Center Logo', 'theme-majesty' ), // logo center
			'dark-bottom-center'				=> esc_html__( 'Dark Bottom Center Menu', 'theme-majesty' ), // hide log
			'vertical-menu'						=> esc_html__( 'Vertical Menu', 'theme-majesty' ),
			'light-default-solid'				=> esc_html__( 'Light Solid', 'theme-majesty' ),
			'light-center-solid'				=> esc_html__( 'Light Solid With Center Logo', 'theme-majesty' ),
			'dark-default-solid'				=> esc_html__( 'Dark Solid', 'theme-majesty' ),
			'dark-center-solid'					=> esc_html__( 'Dark Solid With Center Logo', 'theme-majesty' ),
		),
		//'row_classes' => 'page-slider-type'
	));
	
	$slider_settings->add_field( array(
		'name' 			   => esc_html__( 'Select Slider', 'theme-majesty' ),
		'id'               => $prefix . 'slider_type',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'skipper' 		=> esc_html__( 'Skipper', 'theme-majesty' ),
			'bgndgallery'   => esc_html__( 'Background Slider', 'theme-majesty' ),
			'youtubebg'		=> esc_html__( 'Youtube Video Background', 'theme-majesty' ),
			'vimeobg'		=> esc_html__( 'Vimeo Video Background', 'theme-majesty' ),
			'h5video'		=> esc_html__( 'HTML5 Video', 'theme-majesty' ),
			'fullscreenbg'  => esc_html__( 'Full Screen Background', 'theme-majesty' ),
			'parallaxbg'  	=> esc_html__( 'Parallax  Background', 'theme-majesty' ),
			'interactivebg' => esc_html__( 'Interactive Background', 'theme-majesty' ),
			'movementbg' 	=> esc_html__( 'Movement Background', 'theme-majesty' ),
			'swiper'     	=> esc_html__( 'Swiper jQuery Slider', 'theme-majesty' ),
		),
		'row_classes' => 'page-slider-type'
	));
	
	
	$group_skipper_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'skipper_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'Skipper jQuery Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Skipper Settings', 'theme-majesty' ),
			'sortable'      => false, // beta
		),
		'row_classes' => 'skipper-slider-settings'
	));
	$slider_settings->add_group_field( $group_skipper_setting, array(
		'name'       => esc_html__( 'Skipper Type', 'theme-majesty' ),
		'id'         => 'type',
		'type'       => 'select',
		'show_option_none' => false,
		'options'          => array(
			'fullheight' 	=> esc_html__( 'Full Height', 'theme-majesty' ),
			'fullwidth'   	=> esc_html__( 'Full Width', 'theme-majesty' ),
		),
	));
	$slider_settings->add_group_field( $group_skipper_setting, array(
		'name'       => esc_html__( 'transition', 'theme-majesty' ),
		'id'         => 'transition',
		'type'       => 'select',
		'show_option_none' => false,
		'options'          => array(
			'fade' 		=> esc_html__( 'Fade', 'theme-majesty' ),
			'slide'   => esc_html__( 'Slide', 'theme-majesty' ),
		),
	));
	$slider_settings->add_group_field( $group_skipper_setting, array(
		'name'       => esc_html__( 'Speed', 'theme-majesty' ),
		'desc'    	 => esc_html__('enter length of time in milliseconds you want the transition between slides to take. Default is 500', 'theme-majesty'),
		'id'         => 'speed',
		'type'       => 'text',
		'default' 	 => 500,
	));
	$slider_settings->add_group_field( $group_skipper_setting, array(
		'name'       => esc_html__( 'Display navigation', 'theme-majesty' ),
		'desc'    	 => esc_html__('determining whether or not to display navigation arrows.', 'theme-majesty'),
		'id'         => 'arrows',
		'type'       => 'select',
		'show_option_none' 	=> false,
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_skipper_setting, array(
		'name'       => esc_html__( 'navigation Type', 'theme-majesty' ),
		'desc'    	 => esc_html__('At Bottom of slider display line or bubble to navigation between sliders.', 'theme-majesty'),
		'id'         => 'navtype',
		'type'       => 'select',
		'options'    => array(
			'block' 	=> esc_html__( 'block', 'theme-majesty' ),
			'bubble'   	=> esc_html__( 'Bubble', 'theme-majesty' ),
		),
	));
	$slider_settings->add_group_field( $group_skipper_setting, array(
		'name'       => esc_html__( 'Auto Play', 'theme-majesty' ),
		'id'         => 'autoplay',
		'type'       => 'select',
		'show_option_none' 	=> false,
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_skipper_setting, array(
		'name'       => esc_html__( 'autoPlayDuration', 'theme-majesty' ),
		'desc'    	 => esc_html__('sets the amount of time in milliseconds to display each slide when autoPlay is running. Default is 5000 milliseconds', 'theme-majesty'),
		'id'         => 'duration',
		'type'       => 'text',
		'default' 	 => 5000,
	));
	$slider_settings->add_group_field( $group_skipper_setting, array(
		'name'       => esc_html__( 'hidePrevious', 'theme-majesty' ),
		'desc'    	 => esc_html__('boolean value determining whether or not to hide previous arrow when first slide is showing. Default is "false"', 'theme-majesty'),
		'id'         => 'hideprev',
		'type'       => 'select',
		'show_option_none' 	=> false,
		'options'          	=> $array_boolean,
	));
	
	$group_skipper_slides = $slider_settings->add_field( array(
		'id'          => $prefix . 'skipper_slides',
		'type'        => 'group',
		'repeatable'	=> 1,
		'description' => esc_html__( 'Skipper jQuery Slides', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'theme-majesty' ),
			'add_button'    => esc_html__( 'Add Another Slide', 'theme-majesty' ),
			'remove_button' => esc_html__( 'Remove Slide', 'theme-majesty' ),
			'sortable'      => true, // 
		),
		'row_classes' => 'skipper-slider-slides'
	));
	$slider_settings->add_group_field( $group_skipper_slides, $image_field);
	$slider_settings->add_group_field( $group_skipper_slides, $overlay_field);
	$slider_settings->add_group_field( $group_skipper_slides, $content_field);
	
	
	// jQuery Background Slider using jquery mb.bgndGallery
	$group_bgslider_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'bgslider_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'Background Slider Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Background Slider Settings', 'theme-majesty' ),
			'sortable'      => false, // beta
		),
		
		
	));
	$slider_settings->add_group_field( $group_bgslider_setting, array(
		'name'       => esc_html__( 'transition', 'theme-majesty' ),
		'id'         => 'transition',
		'type'       => 'select',
		'show_option_none' => false,
		'options'          => array(
			'fade' 		=> esc_html__( 'Fade', 'theme-majesty' ),
			'slideUp'   => esc_html__( 'Slide UP', 'theme-majesty' ),
			'slideDown'   => esc_html__( 'Slide Down', 'theme-majesty' ),
			'slideRight'   => esc_html__( 'Slide Right', 'theme-majesty' ),
			'slideLeft'   => esc_html__( 'Slide Left', 'theme-majesty' ),
			'zoom'   => esc_html__( 'Zoom', 'theme-majesty' ),
		),
	));
	$slider_settings->add_group_field( $group_bgslider_setting, array(
		'name'       => esc_html__( 'Timer', 'theme-majesty' ),
		'desc'    	 => esc_html__('the value in millisecond for the display duration', 'theme-majesty'),
		'id'         => 'timer',
		'type'       => 'text',
		'default' 	 => 1000,
	));
	$slider_settings->add_group_field( $group_bgslider_setting, array(
		'name'       => esc_html__( 'effTimer', 'theme-majesty' ),
		'desc'    	 => esc_html__('the value in millisecond for the transaction duration', 'theme-majesty'),
		'id'         => 'efftimer',
		'type'       => 'text',
		'default' 	 => 15000,
	));
	$slider_settings->add_group_field( $group_bgslider_setting, $overlay_field);
	$slider_settings->add_group_field( $group_bgslider_setting, $content_field);
	$slider_settings->add_group_field( $group_bgslider_setting, array(
		'name'       => esc_html__( 'Slider Images', 'theme-majesty' ),
		'id'         => 'images',
		'type'       => 'file_list',
	));
	
	// Youtube Background
	$group_youtube_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'youtube_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'Youtube Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Youtube Settings', 'theme-majesty' ), // since version 1.1.4, {#} gets replaced by row number
			'sortable'      => false, // beta
		),
		'row_classes' => 'youtube-slider-settings'
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Youtube URL', 'theme-majesty' ),
		'id'         => 'url',
		'type'       => 'oembed',
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Poster Image', 'theme-majesty' ),
		'id'         => 'poster',
		'type'       => 'file',
	));
	$slider_settings->add_group_field( $group_youtube_setting, $overlay_field);
	$slider_settings->add_group_field( $group_youtube_setting, $content_field);
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Auto Play', 'theme-majesty' ),
		'id'         => 'autoplay',
		'desc'    	 => esc_html__('loops the movie once ended.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'loop', 'theme-majesty' ),
		'id'         => 'loop',
		'desc'    	 => esc_html__('loops the movie once ended.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Mute', 'theme-majesty' ),
		'id'         => 'mute',
		'desc'    	 => esc_html__('true mute the audio.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Show Controls', 'theme-majesty' ),
		'id'         => 'showcontrols',
		'desc'    	 => esc_html__('true show or hide the player controls.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Ratio', 'theme-majesty' ),
		'id'         => 'ratio',
		'desc'    	 => esc_html__('true show or hide the player controls.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'          	=> array(
			'auto' 		=> esc_html__( 'auto', 'theme-majesty' ),
			'4/3'   	=> esc_html__( '4/3', 'theme-majesty' ),
			'16/9'   	=> esc_html__( '16/9', 'theme-majesty' ),
		),
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Quality', 'theme-majesty' ),
		'id'         => 'quality',
		'desc'    	 => esc_html__('true show or hide the player controls.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'       => array(
			'default' 	=> esc_html__( 'default', 'theme-majesty' ),
			'small'   	=> esc_html__( 'small', 'theme-majesty' ),
			'medium'   	=> esc_html__( 'medium', 'theme-majesty' ),
			'large'   	=> esc_html__( 'large', 'theme-majesty' ),
			'hd720'   	=> esc_html__( 'hd720', 'theme-majesty' ),
			'hd1080'   	=> esc_html__( 'hd1080', 'theme-majesty' ),
			'highres'   => esc_html__( 'highres', 'theme-majesty' ),
		),
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Start At', 'theme-majesty' ),
		'id'         => 'startat',
		'desc'    	 => esc_html__('(number) Set the seconds the video should start at.', 'theme-majesty'),
		'type'       => 'text',
	));
	$slider_settings->add_group_field( $group_youtube_setting, array(
		'name'       => esc_html__( 'Stop At', 'theme-majesty' ),
		'id'         => 'stopat',
		'desc'    	 => esc_html__('(number) Set the seconds the video should stop at. If 0 is ignored.', 'theme-majesty'),
		'type'       => 'text',
	));
	
	// Vimeo Background
	$group_viemo_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'vimeo_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'Viemo Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Viemo Settings', 'theme-majesty' ),
			'sortable'      => false, // beta
		),
		'row_classes' => 'vimeo-slider-settings'
	));
	$slider_settings->add_group_field( $group_viemo_setting, array(
		'name'       => esc_html__( 'Vimeo URL', 'theme-majesty' ),
		'id'         => 'url',
		'type'       => 'oembed',
	));
	$slider_settings->add_group_field( $group_viemo_setting, array(
		'name'       => esc_html__( 'Poster Image', 'theme-majesty' ),
		'id'         => 'poster',
		'type'       => 'file',
	));
	$slider_settings->add_group_field( $group_viemo_setting, $overlay_field);
	$slider_settings->add_group_field( $group_viemo_setting, $content_field);
	$slider_settings->add_group_field( $group_viemo_setting, array(
		'name'       => esc_html__( 'Auto Play', 'theme-majesty' ),
		'id'         => 'autoplay',
		'desc'    	 => esc_html__('loops the movie once ended.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_viemo_setting, array(
		'name'       => esc_html__( 'loop', 'theme-majesty' ),
		'id'         => 'loop',
		'desc'    	 => esc_html__('loops the movie once ended.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'          	=> $array_boolean,
	));
	
	$slider_settings->add_group_field( $group_viemo_setting, array(
		'name'       => esc_html__( 'Volume', 'theme-majesty' ),
		'id'         => 'volume',
		'desc'    	 => esc_html__('control the volume from 0 to 100 mute is 0.', 'theme-majesty'),
		'type'       => 'text',
	));
	
	// HTML5 Video
	$group_htmlvideo_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'h5video_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'HTML5 Video Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'HTML5 Video Settings', 'theme-majesty' ),
			'sortable'      => false, // beta
		),
		'row_classes' => 'h5video-slider-settings'
	));
	$slider_settings->add_group_field( $group_htmlvideo_setting, array(
		'name'       => esc_html__( 'MP4 File URL', 'theme-majesty' ),
		'id'         => 'mp4',
		'type'       => 'text_url',
	));
	$slider_settings->add_group_field( $group_htmlvideo_setting, array(
		'name'       => esc_html__( 'WebM File URL', 'theme-majesty' ),
		'id'         => 'webm',
		'type'       => 'text_url',
	));
	$slider_settings->add_group_field( $group_htmlvideo_setting, array(
		'name'       => esc_html__( 'Poster Image', 'theme-majesty' ),
		'id'         => 'poster',
		'type'       => 'file',
	));
	$slider_settings->add_group_field( $group_htmlvideo_setting, $overlay_field);
	$slider_settings->add_group_field( $group_htmlvideo_setting, $content_field);
	$slider_settings->add_group_field( $group_htmlvideo_setting, array(
		'name'       => esc_html__( 'Auto Play', 'theme-majesty' ),
		'id'         => 'autoplay',
		'desc'    	 => esc_html__('Specifies that the video will start playing as soon as it is ready.', 'theme-majesty'),
		'show_option_none' => true,
		'type'       => 'select',
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_htmlvideo_setting, array(
		'name'       => esc_html__( 'Loop', 'theme-majesty' ),
		'id'         => 'loop',
		'desc'    	 => esc_html__('Specifies that the video will start over again, every time it is finished.', 'theme-majesty'),
		'type'       => 'select',
		'show_option_none' => true,
		'options'          	=> $array_boolean,
	));
	
	$slider_settings->add_group_field( $group_htmlvideo_setting, array(
		'name'       => esc_html__( 'Muted', 'theme-majesty' ),
		'id'         => 'muted',
		'desc'    	 => esc_html__('Specifies that the audio output of the video should be muted.', 'theme-majesty'),
		'type'       => 'select',
		'show_option_none' => true,
		'options'          	=> $array_boolean,
	));
	
	// Full Screen Background
	$group_fullscreenbg_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'fullscreenbg_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'Full Screen Background Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Full Screen Background Settings', 'theme-majesty' ),
			'sortable'      => false, // beta
		),
		'row_classes' => 'fullscreenbg-slider-settings'
	));
	$slider_settings->add_group_field( $group_fullscreenbg_setting, $image_field );
	$slider_settings->add_group_field( $group_fullscreenbg_setting, $overlay_field);
	$slider_settings->add_group_field( $group_fullscreenbg_setting, $content_field);
	
	// Parallax Background
	$group_parallaxbg_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'parallaxbg_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'Parallax Background Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Parallax Background Settings', 'theme-majesty' ),
			'sortable'      => false, // beta
		),
		'row_classes' => 'parallaxbg-slider-settings'
	));
	$slider_settings->add_group_field( $group_parallaxbg_setting, $image_field );
	$slider_settings->add_group_field( $group_parallaxbg_setting, $overlay_field);
	$slider_settings->add_group_field( $group_parallaxbg_setting, $content_field);
	
	// interactivebg Background
	$group_interactivebg_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'interactivebg_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'Interactive Background Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Interactive Background Settings', 'theme-majesty' ), // since version 1.1.4, {#} gets replaced by row number
			'sortable'      => false, // beta
		),
		'row_classes' => 'interactivebg-slider-settings'
	));
	$slider_settings->add_group_field( $group_interactivebg_setting, $image_field );
	$slider_settings->add_group_field( $group_interactivebg_setting, $overlay_field);
	$slider_settings->add_group_field( $group_interactivebg_setting, $content_field);
	$slider_settings->add_group_field( $group_interactivebg_setting, array(
		'name'       => esc_html__( 'Strength', 'theme-majesty' ),
		'id'         => 'strength',
		'desc'    	 => esc_html__('Movement Strength when the cursor is moved. The higher, the faster it will reacts to your cursor. The default value is 25.', 'theme-majesty'),
		'type'       => 'text',
	));
	$slider_settings->add_group_field( $group_interactivebg_setting, array(
		'name'       => esc_html__( 'Scale', 'theme-majesty' ),
		'id'         => 'scale',
		'desc'    	 => esc_html__('The scale in which the background will be zoomed when hovering. Change this to 1 to stop scaling. The default value is 1.05.', 'theme-majesty'),
		'type'       => 'text',
	));
	$slider_settings->add_group_field( $group_interactivebg_setting, array(
		'name'       => esc_html__( 'Animation Speed', 'theme-majesty' ),
		'id'         => 'animationspeed',
		'desc'    	 => esc_html__('The time it takes for the scale to animate. This accepts CSS3 time function such as "100ms", "2.5s", etc. The default value is "100ms".', 'theme-majesty'),
		'default'	 => '100ms',
		'type'       => 'text',
	));
	
	// Movement Background
	$group_movementbg_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'movementbg_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'Movement Background Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Movement Background Settings', 'theme-majesty' ),
			'sortable'      => false, // beta
		),
		'row_classes' => 'movementbg-slider-settings'
	));
	$slider_settings->add_group_field( $group_movementbg_setting, $image_field);
	$slider_settings->add_group_field( $group_movementbg_setting, $overlay_field);
	$slider_settings->add_group_field( $group_movementbg_setting, $content_field);
	
	// Swiper Slider
	$group_swiper_setting = $slider_settings->add_field( array(
		'id'          => $prefix . 'swiper_settings',
		'type'        => 'group',
		'repeatable'	=> 0,
		'description' => esc_html__( 'swiper jQuery Settings', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'swiper Settings', 'theme-majesty' ), 
			'sortable'      => false, // beta
		),
		'row_classes' => 'swiper-slider-settings'
	) );
	$slider_settings->add_group_field( $group_swiper_setting, array(
		'name'       => esc_html__( 'Direction', 'theme-majesty' ),
		'id'         => 'direction',
		'type'       => 'select',
		'show_option_none' => false,
		'options'          => array(
			'horizontal' 	=> esc_html__( 'Horizontal', 'theme-majesty' ),
			'vertical'   	=> esc_html__( 'Vertical', 'theme-majesty' ),
		),
	));
	$slider_settings->add_group_field( $group_swiper_setting, array(
		'name'       => esc_html__( 'Effect', 'theme-majesty' ),
		'id'         => 'effect',
		'type'       => 'select',
		'show_option_none' => false,
		'options'          => array(
			'fade' 		=> esc_html__( 'Fade', 'theme-majesty' ),
			'slide'   	=> esc_html__( 'Slide', 'theme-majesty' ),
			//'cube'   	=> esc_html__( 'Cube', 'theme-majesty' ),
			//'coverflow' => esc_html__( 'Coverflow', 'theme-majesty' ),
		),
	));
	$slider_settings->add_group_field( $group_swiper_setting, array(
		'name'       => esc_html__( 'Loop', 'theme-majesty' ),
		'desc'    	 => esc_html__('Set to true to enable continuous loop mode.', 'theme-majesty'),
		'id'         => 'loop',
		'type'       => 'select',
		'show_option_none' 	=> false,
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_swiper_setting, array(
		'name'       => esc_html__( 'Speed', 'theme-majesty' ),
		'desc'    	 => esc_html__('Duration of transition between slides (in ms)', 'theme-majesty'),
		'id'         => 'speed',
		'type'       => 'text',
		'default' 	 => 300,
	));
	
	$slider_settings->add_group_field( $group_swiper_setting, array(
		'name'       => esc_html__( 'navigation Arrow', 'theme-majesty' ),
		'desc'    	 => esc_html__('determining whether or not to display navigation arrows.', 'theme-majesty'),
		'id'         => 'arrows',
		'type'       => 'select',
		'show_option_none' 	=> false,
		'options'          	=> $array_boolean,
	));
	$slider_settings->add_group_field( $group_swiper_setting, array(
		'name'       => esc_html__( 'navigation Bullet', 'theme-majesty' ),
		'desc'    	 => esc_html__('determining whether or not to display navigation bullet.', 'theme-majesty'),
		'id'         => 'bullet',
		'type'       => 'select',
		'options'          	=> $array_boolean,
	));
	
	
	$group_swiper_slides = $slider_settings->add_field( array(
		'id'          => $prefix . 'swiper_slides',
		'type'        => 'group',
		'repeatable'	=> 1,
		'description' => esc_html__( 'Swiper jQuery Slides', 'theme-majesty' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'theme-majesty' ),
			'add_button'    => esc_html__( 'Add Another Slide', 'theme-majesty' ),
			'remove_button' => esc_html__( 'Remove Slide', 'theme-majesty' ),
			'sortable'      => true, // 
		),
	));
	$slider_settings->add_group_field( $group_swiper_slides, array(
		'name'       => esc_html__( 'Type', 'theme-majesty' ),
		'id'         => 'type',
		'type'       => 'select',
		'desc'    	 => esc_html__('If you select slide type as image only upload image on field image.', 'theme-majesty'),
		'options'          	=> array(
			'image' 		=> esc_html__( 'Background Image', 'theme-majesty' ),
			'video'   	=> esc_html__( 'Background HTML5 Video', 'theme-majesty' ),
		),
	));
	
	$slider_settings->add_group_field( $group_swiper_slides, array(
		'name'       => esc_html__( 'Background Image', 'theme-majesty' ),
		'desc'    	 => esc_html__('This field is used as Background image if you select slide type as image Or poster image for slide type video.', 'theme-majesty'),
		'id'         => 'image',
		'type'       => 'file',
	));
	$slider_settings->add_group_field( $group_swiper_slides, array(
		'name'       => esc_html__( 'MP4 File URL', 'theme-majesty' ),
		'id'         => 'mp4',
		'type'       => 'text_url',
	));
	$slider_settings->add_group_field( $group_swiper_slides, array(
		'name'       => esc_html__( 'WebM File URL', 'theme-majesty' ),
		'id'         => 'webm',
		'type'       => 'text_url',
	));
	
	$slider_settings->add_group_field( $group_swiper_slides, $overlay_field);
	$slider_settings->add_group_field( $group_swiper_slides, $content_field);
}
add_action( 'cmb2_init', 'sama_register_page_slider_settings');


/**
 * Metabox for Page Template
 * @author Kenneth White
 * @link https://github.com/WebDevStudios/CMB2/wiki/Adding-your-own-show_on-filters
 *
 * @param bool $display
 * @param array $meta_box
 * @return bool display metabox
 */
function sama_metabox_show_on_template( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'], $meta_box['show_on']['value'] ) ) {
        return $display;
    }

    if ( 'hide-from-page-builder-slider' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return true;
    }

    $template_name = get_page_template_slug( $post_id );
    $template_name = ! empty( $template_name ) ? substr( $template_name, 0, -4 ) : '';

    // See if there's a match
    return ! in_array( $template_name, (array) $meta_box['show_on']['value'] );
}
add_filter( 'cmb2_show_on', 'sama_metabox_show_on_template', 10, 2 );