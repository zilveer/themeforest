<?php

add_action( 'wp_loaded', 'add_unicase_vc_params' );
add_action( 'admin_head', 'remove_vc_teaser' );

add_action( 'vc_before_init', 	'unicase_setup_visual_composer' );

add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'unicase_apply_custom_css', PHP_INT_MAX, 3 );