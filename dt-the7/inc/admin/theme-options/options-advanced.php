<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Advanced Settings", "theme-options", 'the7mk2'), "type" => "heading" );

$options[] = array(	"name" => _x('Top & bottom margins for pages, posts & templates', 'theme-options', 'the7mk2'), "type" => "block" );

$options['general-page_content_vertical_margins'] = array(
	'name' => _x( 'Margins (px)', 'theme-options', 'the7mk2' ),
	'id' => 'general-page_content_vertical_margins',
	'std' => '50',
	'type' => 'text',
	"class"	=> "mini",
	'sanitize' => 'dimensions',
);

/**
 * Responsive.
 */
$options[] = array(	"name" => _x('Responsiveness', 'theme-options', 'the7mk2'), "type" => "block" );

// radio
$options[] = array(
	"name"		=> _x('Responsive layout', 'theme-options', 'the7mk2'),
	"id"		=> 'general-responsive',
	"std"		=> '1',
	"type"		=> 'radio',
	'show_hide'	=> array( '1' => true ),
	"options"	=> $en_dis_options
);

// hidden area
$options[] = array( "type" => "js_hide_begin" );

$options[] = array( "type" => "divider" );

// input
$options["general-responsiveness-treshold"] = array(
	"name"		=> _x( "Collapse content to one column after (px)", "theme-options", 'the7mk2' ),
	"desc"		=> _x( "Affects sidebar, blog list, portfolio list & some portfolio project layouts. Does not affect VC columns.", "theme-options", 'the7mk2' ),
	"id"		=> "general-responsiveness-treshold",
	"std"		=> 800,
	"type"		=> "text",
	"class"		=> "mini",
	"sanitize"	=> "dimensions"
);

$options[] = array( "type" => "js_hide_end" );

$options[] = array( 'type' => 'divider' );

$options[] = array(
	"type" => 'title',
	"name" => _x('Side paddings', 'theme-options', 'the7mk2')
);

$options['general-side_content_paddings'] = array(
	'name' => _x( 'Side paddings (px)', 'theme-options', 'the7mk2' ),
	'id' => 'general-side_content_paddings',
	'std' => '40',
	'type' => 'text',
	'sanitize' => 'dimensions',
);

$options['general-switch_content_paddings'] = array(
	'name' => _x( 'When screen width is less then.. (px)', 'theme-options', 'the7mk2' ),
	'id' => 'general-switch_content_paddings',
	'std' => '640',
	'type' => 'text',
	'sanitize' => 'dimensions',
);

$options['general-mobile_side_content_paddings'] = array(
	'name' => _x( '..make paddings (px)', 'theme-options', 'the7mk2' ),
	'id' => 'general-mobile_side_content_paddings',
	'std' => '20',
	'type' => 'text',
	'sanitize' => 'dimensions',
);


/**
 * Images lazy loading.
 */
$options[] = array(	"name" => _x('Images lazy loading', 'theme-options', 'the7mk2'), "type" => "block" );

$options['general-images_lazy_loading'] = array(
	"id"		=> 'general-images_lazy_loading',
	"name"		=> _x('Images lazy loading', 'theme-options', 'the7mk2'),
	"desc"		=> _x('Can dramatically reduce page loading speed. Recommended.', 'theme-options', 'the7mk2'),
	"std"		=> '1',
	"type"		=> 'radio',
	"options"	=> array(
		'1' => _x('Enabled', 'theme-options', 'the7mk2'),
		'0' => _x('Disabled', 'theme-options', 'the7mk2'),
	)
);

/**
 * Smooth scroll.
 */
$options[] = array(	"name" => _x('Smooth scroll', 'theme-options', 'the7mk2'), "type" => "block" );

// radio
$options[] = array(
	"name"		=> _x('Enable "scroll-behaviour: smooth" for next gen browsers', 'theme-options', 'the7mk2'),
	"id"		=> 'general-smooth_scroll',
	"std"		=> 'on',
	"type"		=> 'radio',
	"options"	=> array(
		'on'			=> _x( 'Yes', 'theme-options', 'the7mk2' ),
		'off'			=> _x( 'No', 'theme-options', 'the7mk2' ),
		'on_parallax'	=> _x( 'On only on pages with parallax', 'theme-options', 'the7mk2' )
	)
);

/**
 * Contact form sends emails to:.
 */
$options[] = array( "name" => _x("Contact form sends emails to:", "theme-options", 'the7mk2'), "type" => "block" );

// input
$options["general-contact_form_send_mail_to"] = array(
	"name"		=> _x( 'E-mail', 'theme-options', 'the7mk2' ),
	"desc"		=> _x('Leave empty to use admin e-mail.', 'theme-options', 'the7mk2'),
	"id"		=> "general-contact_form_send_mail_to",
	"std"		=> "",
	"type"		=> "text",
	"sanitize"	=> 'email'
);


/**
 * Plugins notifications.
 */
$options[] = array( "name" => _x("Plugins notifications", "theme-options", 'the7mk2'), "type" => "block" );

// checkbox
$options[] = array(
	"name"      => _x( 'Silence plugins activation notifications', 'theme-options', 'the7mk2' ),
	"id"    	=> 'general-hide_plugins_notifications',
	"type"  	=> 'checkbox',
	'std'   	=> 1
);


/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Custom CSS", "theme-options", 'the7mk2'), "type" => "heading" );

/**
 * Custom css
 */
$options[] = array(	"name" => _x('Custom CSS', 'theme-options', 'the7mk2'), "type" => "block" );

// textarea
$options[] = array(
	"settings"	=> array( 'rows' => 16 ),
	"id"		=> "general-custom_css",
	"std"		=> false,
	"type"		=> 'textarea',
	"sanitize"	=> 'without_sanitize'
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Custom JavaScript", "theme-options", 'the7mk2'), "type" => "heading" );

/**
 * Tracking code
 */
$options[] = array(	"name" => _x('Tracking code (e.g. Google analytics) or arbitrary JavaScript', 'theme-options', 'the7mk2'), "type" => "block" );

// textarea
$options[] = array(
	"settings"	=> array( 'rows' => 16 ),
	"id"		=> "general-tracking_code",
	"std"		=> false,
	"type"		=> 'textarea',
	"sanitize"	=> 'without_sanitize'
);
