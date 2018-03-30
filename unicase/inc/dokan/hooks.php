<?php

add_action( 'wp_enqueue_scripts',				'unicase_dokan_scripts', 11 );

add_action( 'unicase_dokan_sidebar',			'unicase_dokan_get_sidebar' );

add_filter( 'unicase_shop_page_layout_args',	'unicase_dokan_layout_args' );