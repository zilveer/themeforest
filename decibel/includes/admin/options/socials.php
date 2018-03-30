<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wolf_theme_options[] = array( 'type' => 'open',  'label' => __( 'Social links', 'wolf'  ) );

		$wolf_theme_options[] = array( 'label' => __( 'Socials', 'wolf' ),
			'type' => 'section_open',
			'desc' => __( 'Set your social network profiles URL here. To display your social icons you can use the following shortcode : [wolf_theme_socials type="normal|circle" size="2x|3x|4x"]', 'wolf' )
		);

$social_fields = array();

$socials_has_weird_url = array(
	'skype',
);

foreach ( $theme_socials as $s ) {
	$label =  ucfirst( $s );

	$type = 'url';

	if ( in_array( $s, $socials_has_weird_url ) )
		$type = 'text';

	$wolf_theme_options[] = array(
		'label' => $label . ' URL',
		'id' => $s,
		'type' => 'url',
	);
}

	$wolf_theme_options[] = array( 'type' => 'section_close' );

$wolf_theme_options[] = array( 'type' => 'close' );