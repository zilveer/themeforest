<?php

// add_filter( 'manage_edit-person_columns', 'edit_person_columns' );
function edit_person_columns( $columns ) {
	$columns = array(
		'cb' 		=> '<input type="checkbox" />',
		'title' 	=> __( 'Title', 'theme_admin' ),
		'meta' 	=> __( 'Meta', 'theme_admin' ),
		'category' => __( 'Category', 'theme_admin' ),
		'date' => __('Date', 'theme_admin'),
	);

	return $columns;
}

// add_action( 'manage_posts_custom_column', 'manage_person_columns' );
function manage_person_columns( $column ) {
	global $post;

	if ( $post->post_type == "person" ) {
		switch( $column ) {
			case 'meta':
				echo get_post_meta( $post->ID, '_info_meta', true );
				break;
		}
	}
}

?>