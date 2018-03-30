<?php
//
// Galleries post type related functions.
//
add_action( 'init', 'ci_create_cpt_galleries' );

if( !function_exists('ci_create_cpt_galleries') ):
function ci_create_cpt_galleries()
{
	$labels = array(
		'name'               => _x( 'Galleries', 'post type general name', 'ci_theme' ),
		'singular_name'      => _x( 'Gallery Item', 'post type singular name', 'ci_theme' ),
		'add_new'            => __( 'Add New', 'ci_theme' ),
		'add_new_item'       => __( 'Add New Gallery Item', 'ci_theme' ),
		'edit_item'          => __( 'Edit Gallery Item', 'ci_theme' ),
		'new_item'           => __( 'New Gallery Item', 'ci_theme' ),
		'view_item'          => __( 'View Gallery Item', 'ci_theme' ),
		'search_items'       => __( 'Search Gallery Items', 'ci_theme' ),
		'not_found'          => __( 'No Gallery Items found', 'ci_theme' ),
		'not_found_in_trash' => __( 'No Gallery Items found in the trash', 'ci_theme' ),
		'parent_item_colon'  => __( 'Parent Gallery Item:', 'ci_theme' )
	);

	$args = array(
		'labels'          => $labels,
		'singular_label'  => __( 'Gallery Item', 'ci_theme' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => _x( 'galleries', 'post type archive slug', 'ci_theme' ),
		'rewrite'         => array( 'slug' => _x( 'galleries', 'post type slug', 'ci_theme' ) ),
		'menu_position'   => 5,
		'supports'        => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'       => 'dashicons-format-gallery'
	);

	register_post_type( 'cpt_galleries' , $args );

}
endif;

add_action( 'load-post.php', 'galleries_meta_boxes_setup' );
add_action( 'load-post-new.php', 'galleries_meta_boxes_setup' ); 

if( !function_exists('galleries_meta_boxes_setup') ):
function galleries_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'galleries_add_meta_boxes' );
	add_action( 'save_post', 'galleries_save_meta', 10, 2 );
}
endif;

if( !function_exists('galleries_add_meta_boxes') ):
function galleries_add_meta_boxes() {
	add_meta_box( 'galleries-box', __( 'Gallery Settings', 'ci_theme' ), 'galleries_score_meta_box', 'cpt_galleries', 'normal', 'high' );
}
endif;

if( !function_exists('galleries_score_meta_box') ):
function galleries_score_meta_box( $object, $box )
{
	ci_prepare_metabox('cpt_galleries');


	?><div class="ci-cf-wrap"><?php
		ci_metabox_open_tab( __( 'Information', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_galleries_venue', __( 'Photo gallery Venue. For example: Ushuaia', 'ci_theme' ) );
			ci_metabox_input( 'ci_cpt_galleries_location', __( 'Photo gallery Location. For example: Ibiza, Spain', 'ci_theme' ) );
			ci_metabox_checkbox( 'ci_cpt_galleries_caption', 1, __( 'Enable image captions', 'ci_theme' ) );
		ci_metabox_close_tab();

		ci_metabox_open_tab( __( 'Images', 'ci_theme' ) );
			ci_metabox_guide( __("You can create a featured gallery by pressing the <em>Add Images</em> button below. You should also set a featured image that will be used as this Gallery's cover.", 'ci_theme') );
			ci_metabox_gallery();
		ci_metabox_close_tab();
	?></div><?php

}
endif;

if( !function_exists('galleries_save_meta') ):
function galleries_save_meta( $post_id, $post ) {
	
	if ( !ci_can_save_meta('cpt_galleries') ) return;

	update_post_meta( $post_id, 'ci_cpt_galleries_venue', sanitize_text_field( $_POST['ci_cpt_galleries_venue'] ) );
	update_post_meta( $post_id, 'ci_cpt_galleries_location', sanitize_text_field( $_POST['ci_cpt_galleries_location'] ) );
	update_post_meta( $post_id, 'ci_cpt_galleries_caption', ci_sanitize_checkbox( $_POST['ci_cpt_galleries_caption'], 1 ) );

	ci_metabox_gallery_save( $_POST );
}
endif;
?>