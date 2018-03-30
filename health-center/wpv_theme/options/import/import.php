<?php

/**
 * Theme options / Import / Quick Import
 *
 * @package wpv
 * @subpackage health-center
 */

$disabled = $disabled_content = '';

if ( wpv_get_option( 'used-one-click-import' ) ) {
	$disabled_content = 'disabled';
}

$revslider = function_exists( 'is_plugin_active' ) && is_plugin_active( 'revslider/revslider.php' );

return array(

array(
	'name' => __( 'Quick Import', 'health-center' ),
	'type' => 'start',
	'nosave' => true,
),

array(
	'name' => __('What is included in the content import?', 'health-center'),
	'desc' => __('The sample data for the Contact Form 7 plugin is part of the "content import". If you indend to use this plugin now or at a later time, please make sure that you have installed and enabled it <strong>before</strong> importing the demo content.', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

array(
	'name' => __( 'Content Import', 'health-center' ),
	'desc' => __( 'You are advised to use this importer only on new WordPress sites, as in doing so you will end up with quite a lot of example posts, pages, slides and portfolio items.', 'health-center' ),
	'title' => __( 'Import Dummy Content', 'health-center' ),
	'link' => $disabled_content !== 'disabled' ? wp_nonce_url( admin_url( 'admin.php?import=wpv&step=2&file='.WPV_THEME_SAMPLE_CONTENT ), 'wpv-import' ) : 'javascript:void( 0 )',
	'type' => 'button',
	'button_class' => "$disabled_content",
),

array(
	'name' => __( 'Widget Import', 'health-center' ),
	'desc' => __( 'Using this importer will overwrite your current sidebar settings', 'health-center' ),
	'title' => __( 'Import Widgets', 'health-center' ),
	'link' => wp_nonce_url( admin_url( 'admin.php?import=wpv_widgets&file='.WPV_THEME_SAMPLE_WIDGETS ), 'wpv-import' ),
	'type' => 'button',
),

array(
	'name' => __( 'Slider Revolution', 'health-center' ),
	'title' => __( 'Import Slider Revolution Samples', 'health-center' ),
	'link' => $revslider ? wp_nonce_url( 'admin.php?import=wpv_revslider', 'wpv-import-revslider' ) : 'javascript:void( 0 )',
	'type' => 'button',
	'button_class' => $revslider ? '' : 'disabled',
),
	array(
		'type' => 'end',
	),

);
