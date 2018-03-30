<?php

// add_filter( 'manage_edit-testimonial_columns', 'edit_testimonial_columns' );
function edit_testimonial_columns( $columns ) {
	$columns = array(
		'cb' 		=> '<input type="checkbox" />',
		'title' 	=> __( 'Author', 'theme_admin' ),
		'testimonial' 	=> __( 'Testimonial', 'theme_admin' ),
		'date' => __('Date', 'theme_admin'),
	);

	return $columns;
}

// add_action( 'manage_posts_custom_column', 'manage_testimonial_columns' );
function manage_testimonial_columns( $column ) {
	global $post;

	if ( $post->post_type == "testimonial" ) {
		switch( $column ) {
			case 'testimonial':
				echo get_post_meta( $post->ID, '_info_testimonial', true );
				break;
		}
	}
}

?>