<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wolf_theme_options[] = array(
	'type' => 'open',
	'name' => __( 'Tracking code', 'wolf'  )
);


	$wolf_theme_options[] = array(
		'name' => __( 'Javascript code', 'wolf' ),
		'type' => 'section_open'
	);

		$wolf_theme_options[] = array( 'name' => __( 'Tracking code', 'wolf' ),
			'desc' => __( 'You can paste your <strong>Google Analytics</strong> or other tracking code in this box.
				<br>Note that your tracking code will not be output when you\'re logged in.', 'wolf' ),
			'id' => 'tracking_code',
			'type' => 'javascript',
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );


$wolf_theme_options[] = array( 'type' => 'close' );