<?php
//
// Artists post type related functions.
//

add_action( 'init', 'ci_create_cpt_artists' );
if( !function_exists('ci_create_cpt_artists') ):
function ci_create_cpt_artists()
{
	$labels = array(
		'name'               => _x( 'Artists', 'post type general name', 'ci_theme' ),
		'singular_name'      => _x( 'Artist', 'post type singular name', 'ci_theme' ),
		'add_new'            => __( 'New Artist', 'ci_theme' ),
		'add_new_item'       => __( 'Add New Artist', 'ci_theme' ),
		'edit_item'          => __( 'Edit Artist', 'ci_theme' ),
		'new_item'           => __( 'New Artist', 'ci_theme' ),
		'view_item'          => __( 'View Artist', 'ci_theme' ),
		'search_items'       => __( 'Search Artists', 'ci_theme' ),
		'not_found'          => __( 'No Artists found', 'ci_theme' ),
		'not_found_in_trash' => __( 'No Artists found in the trash', 'ci_theme' ),
		'parent_item_colon'  => __( 'Parent Artist:', 'ci_theme' )
	);

	$args = array(
		'labels'          => $labels,
		'singular_label'  => __( 'Artist', 'ci_theme' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => _x( 'artists', 'post type archive slug', 'ci_theme' ),
		'rewrite'         => array( 'slug' => _x( 'artists', 'post type slug', 'ci_theme' ) ),
		'menu_position'   => 5,
		'supports'        => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'       => 'dashicons-admin-users'
	);

	register_post_type( 'cpt_artists' , $args );

}
endif;

add_action( 'load-post.php', 'artists_meta_boxes_setup' );
add_action( 'load-post-new.php', 'artists_meta_boxes_setup' ); 

if( !function_exists('artists_meta_boxes_setup') ):
function artists_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'artists_add_meta_boxes' );
	add_action( 'save_post', 'artists_save_meta', 10, 2 );
}
endif;

if( !function_exists('artists_add_meta_boxes') ):
function artists_add_meta_boxes() {
	add_meta_box('artists-box', esc_html__( 'Artist Role', 'ci_theme' ), 'artists_score_meta_box', 'cpt_artists', 'normal', 'high');
}
endif;

if( !function_exists('artists_score_meta_box') ):
function artists_score_meta_box( $object, $box ) {

	ci_prepare_metabox('cpt_artists');

	?><div class="ci-cf-wrap"><?php
		ci_metabox_open_tab( '' );
			ci_metabox_input( 'ci_cpt_artists_text', __( "Artist's role. E.g. <em>Lead Singer</em>", 'ci_theme' ) );
		ci_metabox_close_tab();
	?></div><?php

}
endif;

if( !function_exists('artists_save_meta') ):
function artists_save_meta( $post_id, $post ) {

	if ( !ci_can_save_meta('cpt_artists') ) return;
		
	update_post_meta($post_id, 'ci_cpt_artists_text', sanitize_text_field($_POST['ci_cpt_artists_text']) );
}
endif;

?>