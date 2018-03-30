<?php

// add_filter( 'manage_edit-team_columns', 'edit_team_columns' );
function edit_slider_columns( $columns ) {
	$columns = array(
		'cb' 		=> '<input type="checkbox" />',
		'title' 	=> __( 'Author', 'theme_admin' ),
		'testimonial' 	=> __( 'Testimonial', 'theme_admin' ),
		'date' => __('Date', 'theme_admin'),
	);

	return $columns;
}

// add_action( 'manage_posts_custom_column', 'manage_team_columns' );
function manage_slider_columns( $column ) {
	global $post;

	if ( $post->post_type == "team" ) {
		switch( $column ) {
			case 'testimonial':
				echo get_post_meta( $post->ID, '_info_testimonial', true );
				break;
		}
	}
}

?>