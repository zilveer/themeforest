<?php

add_action( 'admin_head', 		'mc_remove_vc_teaser' );
add_action( 'wp_loaded', 		'mc_add_vc_params' );

add_action( 'vc_before_init', 	'mc_setup_visual_composer' );

add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'mc_apply_custom_css', PHP_INT_MAX, 3 );