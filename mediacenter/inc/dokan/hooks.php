<?php

add_action( 'wp_enqueue_scripts',					'mc_dokan_scripts',						11 );

add_action( 'mc_dokan_sidebar', 					'mc_output_secondary_wrapper', 			10 );
add_action( 'mc_dokan_sidebar', 					'mc_dokan_get_sidebar', 				20 );
add_action( 'mc_dokan_sidebar', 					'mc_output_secondary_wrapper_end', 		PHP_INT_MAX );
add_action( 'mc_dokan_sidebar', 					'mc_output_content_wrapper_end', 		PHP_INT_MAX );