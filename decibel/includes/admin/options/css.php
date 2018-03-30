<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wolf_theme_options[] = array( 'type' => 'open', 'label' => 'CSS' );

	$wolf_theme_options[] = array( 'label' => 'CSS',
		'type' => 'section_open',
	);

	$wolf_theme_options['css'] = array(
		'label' => __( 'Custom CSS', 'wolf' ),
		'desc' => __( 'Want to add any custom CSS code? Put in here, and the rest is taken care of.', 'wolf' ),
		'id' => 'custom_css',
		'type' => 'css',
	);

	$wolf_theme_options[] = array( 'type' => 'section_close' );


$wolf_theme_options[] = array( 'type' => 'close' );

if ( ! is_child_theme() ) {

	$child_theme_message = sprintf(
		__( 'Want to add any custom CSS code? Put in here, and the rest is taken care of. If you need more CSS customization, you should create a <a href="%s" target="_blank">Child Theme</a>', 'wolf' ),
		'http://codex.wordpress.org/Child_Themes'
	);

	$wolf_theme_options['css']['desc'] = $child_theme_message;
}