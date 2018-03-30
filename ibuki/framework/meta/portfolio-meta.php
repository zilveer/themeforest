<?php

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Meta
/*-----------------------------------------------------------------------------------*/


add_action('add_meta_boxes', 'az_metabox_portfolio');
function az_metabox_portfolio(){
    
	
/*-----------------------------------------------------------------------------------*/
/*	Thumbnails Setting
/*-----------------------------------------------------------------------------------*/

// Revolution Slider
if (is_plugin_active('revslider/revslider.php')) {
	global $wpdb;
	$rs = $wpdb->get_results( 
	"
	SELECT id, title, alias
	FROM ".$wpdb->prefix."revslider_sliders
	ORDER BY id ASC LIMIT 100
	"
	);
	$revsliders = array();
	if ($rs) {
	foreach ( $rs as $slider ) {
	  $revsliders[$slider->alias] = $slider->alias;
	}
	} else {
	$revsliders["No sliders found"] = 0;
	}
} else {
	$revsliders["No Plugin Installed"] = null;
}

$meta_box = array(
	'id' => 'az-metabox-portfolio-settings',
	'title' =>  __('Portfolio Item Settings', AZ_THEME_NAME),
	'description' => __('Here you can configure how your portfolio item appear.', AZ_THEME_NAME),
	'post_type' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			'name' => __('Portfolio Masonry Block Thumbnail Size', AZ_THEME_NAME),
			'desc' => __('You can select the Thumbnail Size for Masonry Block Layout Only.<br><br>
						  <strong>Normal Size:</strong> 500 x 500 pixel<br>
						  <strong>Wide Size:</strong> 1000 x 500 pixel<br>
						  <strong>Tall Size:</strong> 500 x 1000 pixel<br>
						  <strong>Big Size:</strong> 1000 x 1000 pixel', AZ_THEME_NAME),
			'id' => '_az_masonry_block_thumb_size',
			'type' => 'select',
			'std' => 'normal-size',
			'options' => array(
				"normal-size" => "Normal Size ( 25% Width )",
				"wide-size" => "Wide Size ( 50% Width )",
				"tall-size" => "Tall Size ( 25% Width )",
				"big-size" => "Big Size ( 50% Width )"
			)
		),
		array( 
			'name' => __('Portfolio Project Type', AZ_THEME_NAME),
			'desc' => __('You can select your project type.', AZ_THEME_NAME),
			'id' => '_az_project_type',
			'type' => 'select',
			'std' => 'normal-mode',
			'options' => array(
				"normal-mode" => "Normal Mode",
				"fancybox-mode" => "FancyBox Mode",
				"output-mode" => "External Project Url"
			)
		),
		array( 
			'name' => __('Portfolio Scrollable Width Thumb (Optional)', AZ_THEME_NAME),
			'desc' => __('You can select the width of the thumb instead of default value, work only if Portfolio Scrollable is active.<br>Enter a number. Default is 450', AZ_THEME_NAME),
			'id' => '_az_project_scrollable_width',
			'type' => 'text',
			'std' => ''
		),
		array( 
			'name' => __('Portfolio Colorize Effect', AZ_THEME_NAME),
			'desc' => __('You can select the color of hover effect only if Portfolio Colorize Effect is active.', AZ_THEME_NAME),
			'id' => '_az_project_colorize',
			'type' => 'color_single_portfolio',
			'std' => ''
		),
		array( 
			'name' => __('Portfolio Colorize Effect Opacity', AZ_THEME_NAME),
			'desc' => __('Optional. Enter a number 0 - 1 for your background color opacity. Default 0.70', AZ_THEME_NAME),
			'id' => '_az_project_colorize_opacity',
			'type' => 'opacity_color_single_portfolio',
			'std' => '1'
		),
		array( 
			'name' => __('External Project URL', AZ_THEME_NAME),
			'desc' => __('If you would like your project to link to a custom location, enter it here (remember to include "http://"). <strong><em>Work Only if Project Type is "External Project URL".</em></strong>', AZ_THEME_NAME),
			'id' => '_az_external_project_url',
			'type' => 'text',
			'std' => ''
		),
		array( 
			'name' => __('FancyBox PopUp Video (Optional)', AZ_THEME_NAME),
			'desc' => __('Enter Video URL instead of Featured Image.<br><strong><em>Work Only if Project Type is "FancyBox Mode".</em></strong>', AZ_THEME_NAME),
			'id' => '_az_fancy_video',
			'type' => 'text',
			'std' => ''
		),
		array( 
			'name' => __('FancyBox Image PopUp (Optional)', AZ_THEME_NAME),
			'desc' => __('Upload Image if you want a different image instead of Featured Image PopUp.<br><strong><em>Work Only if Project Type is "FancyBox Mode".</em></strong>', AZ_THEME_NAME),
			'id' => '_az_fancy_image_full',
			'type' => 'file',
			'std' => ''
		),
		array( 
			'name' => __('FancyBox Gallery Images (Optional)', AZ_THEME_NAME),
			'desc' => __('Upload Images if you want a gallery images for this post.<br><strong><em>Work Only if Project Type is "FancyBox Mode".</em></strong>', AZ_THEME_NAME),
			'id' => '_az_fancy_image_gallery',
			'type' => 'images',
			'std' => ''
		),
		array( 
			'name' => __('FancyBox Gallery Name (Optional)', AZ_THEME_NAME),
			'desc' => __('Enter gallery name if you want use FancyBox Gallery Images or you want a gallery images/video between portfolio posts.', AZ_THEME_NAME),
			'id' => '_az_fancy_gallery',
			'type' => 'text',
			'std' => ''
		),
	)
);

$callback = create_function( '$post,$meta_box', 'az_create_meta_box( $post, $meta_box["args"] );' );
add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	

/*-----------------------------------------------------------------------------------*/
/*	Page Portfolio Header Setting Meta
/*-----------------------------------------------------------------------------------*/

$meta_box = array(
	'id' => 'az-metabox-page-header',
	'title' => __('Portfolio Page Header Settings', AZ_THEME_NAME),
	'description' => __('Here you can configure how your page header will appear.', AZ_THEME_NAME),
	'post_type' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			'name' => __('Portfolio Page Header Settings', AZ_THEME_NAME),
			'desc' => __('Enable or Disable the Header Page Settings.', AZ_THEME_NAME),
			'id' => '_az_header_settings',
			'type' => 'select',
			'std' => 'disabled',
			'options' => array(
				"enabled" => "Enabled",
				"disabled" => "Disabled"
			)
		),
		array( 
			'name' => __('Portfolio Header Section Layout', AZ_THEME_NAME),
			'desc' => __('Select your favorite page header layout for your page.', AZ_THEME_NAME),
			'id' => '_az_header_layout',
			'type' => 'select',
			'std' => 'normal-container',
			'options' => array(
				"normal-container" => "Default",
				"full-container" => "Full Screen"
			)
		),
		array( 
			'name' => __('Scroll Button to Next Section', AZ_THEME_NAME),
			'desc' => __('Enable or Disable Scroll Button only for <strong>Full Screen Layout</strong>.', AZ_THEME_NAME),
			'id' => '_az_header_scroll_btn',
			'type' => 'checkbox',
			'std' => 'off'
		),
		array( 
			'name' => __('Portfolio Page Header Height', AZ_THEME_NAME),
			'desc' => __('Optional. Enter a number for your height of page header. Default 600.<br/>
						  <strong>Not work if you use a Full Screen Section Mode</strong>.', AZ_THEME_NAME),
			'id' => '_az_header_height',
			'type' => 'text',
			'std' => '600'
		),
		array( 
			'name' => __('Full Screen below 767 pixel Width', AZ_THEME_NAME),
			'desc' => __('Enable or Disable the full screen below 767 pixel width.<br/>
						  <strong>Not work if you use a Full Screen Section Mode</strong>', AZ_THEME_NAME),
			'id' => '_az_header_responsive_full',
			'type' => 'checkbox',
			'std' => 'on'
		),
		array( 
			'name' => __('Portfolio Page Header Image', AZ_THEME_NAME),
			'desc' => __('Optional. Upload your image.', AZ_THEME_NAME),
			'id' => '_az_header_bg',
			'type' => 'file',
			'std' => ''
		),
		array( 
			'name' => __('Portfolio Page Header Pattern Overlay', AZ_THEME_NAME),
			'desc' => __('Optional. Upload your pattern image.', AZ_THEME_NAME),
			'id' => '_az_header_pattern_bg',
			'type' => 'file',
			'std' => ''
		),
		array( 
			'name' => __('Portfolio Page Header Image Overlay', AZ_THEME_NAME),
			'desc' => __('Enable or Disable Overlay Background.', AZ_THEME_NAME),
			'id' => '_az_header_overlay',
			'type' => 'checkbox_fade',
			'std' => 'on'
		),
		array( 
			'name' => __('Portfolio Page Header Backgroun Opacity Overlay', AZ_THEME_NAME),
			'desc' => __('Optional. Enter a number 0 - 1 for your background color opacity. Default 0.70', AZ_THEME_NAME),
			'id' => '_az_header_overlay_bg_opacity',
			'type' => 'opacity',
			'std' => ''
		),
		array( 
			'name' => __('Portfolio Page Header Background Color Overlay', AZ_THEME_NAME),
			'desc' => __('Optional. Choose a background color overlay for your title block.', AZ_THEME_NAME),
			'id' => '_az_header_overlay_bg_color',
			'type' => 'color',
			'std' => ''
		),
		array( 
			'name' => __('Portfolio Page Header Image Background Position', AZ_THEME_NAME),
			'desc' => __('Background Image Position.', AZ_THEME_NAME),
			'id' => '_az_header_bg_position',
			'type' => 'select',
			'std' => 'center center',
			'options' => array(
				"top left" => "Top Left",
				"top center" => "Top Center",
				"top right" => "Top Right",
				"bottom left" => "Bottom Left",
				"bottom center" => "Bottom Center",
				"bottom right" => "Bottom Right",
				"center left" => "Center Left",
				"center center" => "Center Center",
				"center right" => "Center Right"
			)
		),
		array( 
			'name' => __('Portfolio Page Header Image Background Repeat', AZ_THEME_NAME),
			'desc' => __('Background Image Repeat.', AZ_THEME_NAME),
			'id' => '_az_header_bg_repeat',
			'type' => 'select',
			'std' => 'stretch',
			'options' => array(
				"no-repeat" => "No Repeat",
				"repeat" => "Repeat",
				"repeat-x" => "Repeat Horizontally",
				"repeat-y" => "Repeat Vertically",
				"stretch" => "Stretch to fit"
			)
		),
		array( 
			'name' => __('Portfolio Page Header Image Background Attachment', AZ_THEME_NAME),
			'desc' => __('Background Image Attachment.', AZ_THEME_NAME),
			'id' => '_az_header_bg_attachment',
			'type' => 'select',
			'std' => 'scroll',
			'options' => array(
				"scroll" => "Scroll",
				"fixed" => "Fixed"
			)
		),
		array( 
			'name' => __('Portfolio Header Text', AZ_THEME_NAME),
			'desc' => __('Enable or Disable the Header Portfolio Text.', AZ_THEME_NAME),
			'id' => '_az_header_text',
			'type' => 'select',
			'std' => 'enabled',
			'options' => array(
				"enabled" => "Enabled",
				"disabled" => "Disabled"
			)
		),
		array( 
			'name' => __('Portfolio Page Title', AZ_THEME_NAME),
			'desc' => __('You can insert a custom page title instead of default page title.<br><strong>HTML is allowed.</strong>', AZ_THEME_NAME),
			'id' => '_az_page_title',
			'type' => 'textarea',
			'std' => ''
		),
		array( 
			'name' => __('Portfolio Page Caption', AZ_THEME_NAME),
			'desc' => __('You can insert a custom text caption instead of project attributes.<br><strong>HTML is allowed.</strong>', AZ_THEME_NAME),
			'id' => '_az_page_caption',
			'type' => 'textarea',
			'std' => ''
		),
		array( 
			'name' => __('Portfolio Page Title and Caption Align', AZ_THEME_NAME),
			'desc' => __('You can align the text in three different ways.', AZ_THEME_NAME),
			'id' => '_az_page_text_align',
			'type' => 'select',
			'std' => 'centerize',
			'options' => array(
				"leftize" => "Left Align",
				"centerize" => "Center Align",
				"rightize" => "Right Align"
			)
		),
		array( 
			'name' => __('Portfolio Page Title and Caption Color', AZ_THEME_NAME),
			'desc' => __('Optional. Choose a text color for your title block.', AZ_THEME_NAME),
			'id' => '_az_page_text_color',
			'type' => 'color_text',
			'std' => ''
		),
		array( 
			'name' => __('Revolution Slider Alias', AZ_THEME_NAME),
			'desc' => __('Select your Revolution Slider Alias for the slider that you want to show.', AZ_THEME_NAME),
			'id' => '_az_intro_slider_header',
			'type' => 'select_slider',
			'options' => $revsliders,
			'std' => ''
		),
	)
);

add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Comment Layout
/*-----------------------------------------------------------------------------------*/
	
$options_ibuki = get_option('ibuki');
if( !empty($options_ibuki['enable-comment-portfolio-area']) && $options_ibuki['enable-comment-portfolio-area'] == 1) { 

    $meta_box = array(
		'id' => 'az-metabox-comment-layout',
		'title' => __('Portfolio Comment Layout', AZ_THEME_NAME),
		'description' => __('Here you can configure how your comment layout will appear.', AZ_THEME_NAME),
		'post_type' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
				'name' => __('Comment Section Layout', AZ_THEME_NAME),
				'desc' => __('Select your favorite comment layout for your portfolio post.', AZ_THEME_NAME),
				'id' => '_az_comment_section_layout',
				'type' => 'select',
				'std' => 'container',
				'options' => array(
					"container" => "Default",
					"container-fluid" => "Full Width"
				)
			),

			array( 
				'name' => __('Comment Row Layout', AZ_THEME_NAME),
				'desc' => __('Select your favorite comment row layout for your portfolio post.', AZ_THEME_NAME),
				'id' => '_az_comment_row_layout',
				'type' => 'select',
				'std' => 'col-md-12',
				'options' => array(
					"col-md-12" => "1/1",
					"col-md-10 col-md-offset-1" => "1/1 + offset 1/6",
					"col-md-8 col-md-offset-2" => "2/3 + offset 1/4",
					"col-md-6 col-md-offset-3" => "1/2 + offset 1/3"
				)
			),
		)
	);

	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
}
}