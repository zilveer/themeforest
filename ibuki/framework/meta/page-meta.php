<?php 


add_action('add_meta_boxes', 'az_metabox_page');

function az_metabox_page(){
    
/*-----------------------------------------------------------------------------------*/
/*	Page Header Setting Meta
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

$post_types = array( 'page', 'product');

$meta_box = array(
	'id' => 'az-metabox-page-header',
	'title' => __('Page Header Settings', AZ_THEME_NAME),
	'description' => __('Here you can configure how your page header will appear.', AZ_THEME_NAME),
	'post_type' => $post_types,
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			'name' => __('Page Header Settings', AZ_THEME_NAME),
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
			'name' => __('Page Header Section Layout', AZ_THEME_NAME),
			'desc' => __('Select your favorite page header layout for your page.', AZ_THEME_NAME),
			'id' => '_az_header_layout',
			'type' => 'select',
			'std' => 'normal-container',
			'options' => array(
				"normal-container" => "Normal",
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
			'name' => __('Page Header Height', AZ_THEME_NAME),
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
			'name' => __('Page Header Image', AZ_THEME_NAME),
			'desc' => __('Optional. Upload your image.', AZ_THEME_NAME),
			'id' => '_az_header_bg',
			'type' => 'file',
			'std' => ''
		),
		array( 
			'name' => __('Page Header Pattern Overlay', AZ_THEME_NAME),
			'desc' => __('Optional. Upload your pattern image.', AZ_THEME_NAME),
			'id' => '_az_header_pattern_bg',
			'type' => 'file',
			'std' => ''
		),
		array( 
			'name' => __('Page Header Background Overlay', AZ_THEME_NAME),
			'desc' => __('Enable or Disable Overlay Background.', AZ_THEME_NAME),
			'id' => '_az_header_overlay',
			'type' => 'checkbox_fade',
			'std' => 'on'
		),
		array( 
			'name' => __('Page Header Backgroun Opacity Overlay', AZ_THEME_NAME),
			'desc' => __('Optional. Enter a number 0 - 1 for your background color opacity. Default 0.60', AZ_THEME_NAME),
			'id' => '_az_header_overlay_bg_opacity',
			'type' => 'opacity',
			'std' => ''
		),
		array( 
			'name' => __('Page Header Background Color Overlay', AZ_THEME_NAME),
			'desc' => __('Optional. Choose a background color overlay for your page header.', AZ_THEME_NAME),
			'id' => '_az_header_overlay_bg_color',
			'type' => 'color',
			'std' => ''
		),
		array( 
			'name' => __('Page Header Image Background Position', AZ_THEME_NAME),
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
			'name' => __('Page Header Image Background Repeat', AZ_THEME_NAME),
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
			'name' => __('Page Header Image Background Attachment', AZ_THEME_NAME),
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
			'name' => __('Page Header Text', AZ_THEME_NAME),
			'desc' => __('Enable or Disable the Header Page Text.', AZ_THEME_NAME),
			'id' => '_az_header_text',
			'type' => 'select',
			'std' => 'enabled',
			'options' => array(
				"enabled" => "Enabled",
				"disabled" => "Disabled"
			)
		),
		array( 
			'name' => __('Page Title', AZ_THEME_NAME),
			'desc' => __('You can insert a custom page title instead of default page title.<br><strong>HTML is allowed.</strong>', AZ_THEME_NAME),
			'id' => '_az_page_title',
			'type' => 'textarea',
			'std' => ''
		),
		array( 
			'name' => __('Page Caption', AZ_THEME_NAME),
			'desc' => __('You can insert a caption text.<br><strong>HTML is allowed.</strong>', AZ_THEME_NAME),
			'id' => '_az_page_caption',
			'type' => 'textarea',
			'std' => ''
		),
		array( 
			'name' => __('Page Title and Caption Align', AZ_THEME_NAME),
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
			'name' => __('Page Title and Caption Color', AZ_THEME_NAME),
			'desc' => __('Optional. Choose a text color for your title and caption.', AZ_THEME_NAME),
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
$callback = create_function( '$post,$meta_box', 'az_create_meta_box( $post, $meta_box["args"] );' );
foreach( $post_types as $post_type) {
    add_meta_box(
        $meta_box['id'],
		$meta_box['title'],
		$callback,
		$post_type,
        $meta_box['context'],
		$meta_box['priority'],
		$meta_box
    );
}

}
?>