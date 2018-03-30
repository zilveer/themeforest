<?php 
function gallery_init() {
	// create a new taxonomy
	register_taxonomy(
		'gallery-category',
		'gallery',
		array(
			'label' => __('Categories' , 'tt_theme_framework'),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'hierarchical' => true, //added version 2.2 to allow parent category
			'rewrite' => array( 'slug' => 'gallery-category' )
		)
	);
}
add_action( 'init', 'gallery_init' );
?>