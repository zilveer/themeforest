<?php

function create_footer() {
	register_post_type('berg_footer',
		array(
			'labels' => array(
				'name' => __( 'Footer', 'BERG'),
				'singular_name' => __( 'Footer', 'BERG')
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor'),
		)
	);
}

add_action( 'init', 'create_footer' );