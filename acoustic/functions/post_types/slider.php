<?php
//
// slider post type related functions.
//
add_action( 'init', 'ci_create_cpt_slider' );

if( !function_exists('ci_create_cpt_slider') ):
function ci_create_cpt_slider()
{
	$labels = array(
		'name'               => _x( 'Slider', 'post type general name', 'ci_theme' ),
		'singular_name'      => _x( 'Slider Item', 'post type singular name', 'ci_theme' ),
		'add_new'            => __( 'Add New', 'ci_theme' ),
		'add_new_item'       => __( 'Add New Slider Item', 'ci_theme' ),
		'edit_item'          => __( 'Edit Slider Item', 'ci_theme' ),
		'new_item'           => __( 'New Slider Item', 'ci_theme' ),
		'view_item'          => __( 'View Slider Item', 'ci_theme' ),
		'search_items'       => __( 'Search Slider Items', 'ci_theme' ),
		'not_found'          => __( 'No Slider Items found', 'ci_theme' ),
		'not_found_in_trash' => __( 'No Slider Items found in the trash', 'ci_theme' ),
		'parent_item_colon'  => __( 'Parent Slider Item:', 'ci_theme' )
	);

	$args = array(
		'labels'          => $labels,
		'singular_label'  => __( 'Slider Item', 'ci_theme' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => false,
		'rewrite'         => array( 'slug' => _x( 'sliders', 'post type slug', 'ci_theme' ) ),
		'menu_position'   => 4,
		'supports'        => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'       => 'dashicons-image-flip-horizontal'
	);

	register_post_type( 'cpt_slider' , $args );

}
endif;

add_action( 'load-post.php', 'slider_meta_boxes_setup' );
add_action( 'load-post-new.php', 'slider_meta_boxes_setup' ); 

if( !function_exists('slider_meta_boxes_setup') ):
function slider_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'slider_add_meta_boxes' );
	add_action( 'save_post', 'slider_save_meta', 10, 2 );
}
endif;

if( !function_exists('slider_add_meta_boxes') ):
function slider_add_meta_boxes() {
	add_meta_box( 'slider-box', __( 'Slider Settings', 'ci_theme' ), 'slider_score_meta_box', 'cpt_slider', 'normal', 'high' );
}
endif;

if( !function_exists('slider_score_meta_box') ):
function slider_score_meta_box( $object, $box )
{
	ci_prepare_metabox('cpt_slider');

	?><div class="ci-cf-wrap"><?php
		ci_metabox_open_tab( '' );
			ci_metabox_guide( __( 'If someone clicks on a slider item, the Slider URL this is the link that they will be visiting. If you leave it empty, linking for this slide will be disabled.', 'ci_theme' ) );
			ci_metabox_input('ci_cpt_slider_url', __('Slide URL:', 'ci_theme'), array('esc_func' => 'esc_url'));

			ci_metabox_guide( sprintf( __( 'Videos must be hosted in one of the <a href="%s">WordPress supported providers</a>.', 'ci_theme' ), 'https://codex.wordpress.org/Embeds' ) );
			ci_metabox_input( 'ci_cpt_slider_video', __( 'Video URL:', 'ci_theme' ), array( 'esc_func' => 'esc_url' ) );
			ci_metabox_checkbox( 'ci_cpt_slider_text', 1, __( 'Disable slider text', 'ci_theme' ) );
		ci_metabox_close_tab();
	?></div><?php

}
endif;

if( !function_exists('slider_save_meta') ):
function slider_save_meta( $post_id, $post ) {

	if ( !ci_can_save_meta('cpt_slider') ) return;

	update_post_meta( $post_id, 'ci_cpt_slider_url', esc_url_raw( $_POST['ci_cpt_slider_url'] ) );
	update_post_meta( $post_id, 'ci_cpt_slider_video', esc_url_raw( $_POST['ci_cpt_slider_video'] ) );
	update_post_meta( $post_id, 'ci_cpt_slider_text', ci_sanitize_checkbox( $_POST['ci_cpt_slider_text'], 1 ) );

}
endif;

?>