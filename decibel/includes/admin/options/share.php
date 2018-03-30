<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$wolf_theme_options[] = array(
	'type' => 'open', 
	'label' =>__( 'Share', 'wolf' )
);

	$wolf_theme_options[] = array(
		'label' => __( 'Display', 'wolf' ),
		'type' => 'section_open',
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Generate Facebook & Google plus meta', 'wolf' ),
		'desc' => __( 'Would you like to generate facebook, twitter and google plus metadata? Disable this function if you use a SEO plugin.', 'wolf' ),
		'id' => 'social_meta',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Default share image (used for facebook and google plus)', 'wolf' ),
		'desc' => __( 'By default, the post featured image will be shown when you share a post/page on facebook. Here you can set the default image that will be displayed if no featured image is set', 'wolf' ),
		'id' => 'share_img',
		'type' => 'image',
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Share text', 'wolf' ),
		'id' => 'share_text',
		'type' => 'text',
	);

	$wolf_theme_options[] = array(
		'label' => 'facebook',
		'id' => 'share_facebook',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => 'twitter',
		'id' => 'share_twitter',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => 'pinterest',
		'id' => 'share_pinterest',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => 'google plus',
		'id' => 'share_google',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => 'tumblr',
		'id' => 'share_tumblr',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => 'stumbleupon',
		'id' => 'share_stumbleupon',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => 'linked in',
		'id' => 'share_linkedin',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => 'email',
		'id' => 'share_mail',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array( 'type' => 'section_close' );


$wolf_theme_options[] = array( 'type' => 'close' );