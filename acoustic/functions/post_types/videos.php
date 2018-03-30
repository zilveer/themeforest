<?php
//
// videos post type related functions.
//
add_action( 'init', 'ci_create_cpt_videos' );

if( !function_exists('ci_create_cpt_videos') ):
function ci_create_cpt_videos()
{
	$labels = array(
		'name'               => _x( 'Videos', 'post type general name', 'ci_theme' ),
		'singular_name'      => _x( 'Video', 'post type singular name', 'ci_theme' ),
		'add_new'            => __( 'Add New', 'ci_theme' ),
		'add_new_item'       => __( 'Add New Video', 'ci_theme' ),
		'edit_item'          => __( 'Edit Video', 'ci_theme' ),
		'new_item'           => __( 'New Video', 'ci_theme' ),
		'view_item'          => __( 'View Video', 'ci_theme' ),
		'search_items'       => __( 'Search Videos', 'ci_theme' ),
		'not_found'          => __( 'No Videos found', 'ci_theme' ),
		'not_found_in_trash' => __( 'No Videos found in the trash', 'ci_theme' ),
		'parent_item_colon'  => __( 'Parent Video:', 'ci_theme' )
	);

	$args = array(
		'labels'          => $labels,
		'singular_label'  => __( 'Video Item', 'ci_theme' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => _x( 'videos', 'post type archive slug', 'ci_theme' ),
		'rewrite'         => array( 'slug' => _x( 'videos', 'post type slug', 'ci_theme' ) ),
		'menu_position'   => 5,
		'supports'        => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'       => 'dashicons-format-video'
	);

	register_post_type( 'cpt_videos' , $args );
}
endif;

add_action( 'load-post.php', 'videos_meta_boxes_setup' );
add_action( 'load-post-new.php', 'videos_meta_boxes_setup' ); 

if( !function_exists('videos_meta_boxes_setup') ):
function videos_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'videos_add_meta_boxes' );
	add_action( 'save_post', 'videos_save_meta', 10, 2 );
}
endif;

if( !function_exists('videos_add_meta_boxes') ):
function videos_add_meta_boxes() {
	add_meta_box( 'videos-box', __( 'Video Settings', 'ci_theme' ), 'videos_score_meta_box', 'cpt_videos', 'normal', 'high' );
}
endif;

if( !function_exists('videos_score_meta_box') ):
function videos_score_meta_box( $object, $box )
{
	ci_prepare_metabox('cpt_videos');

	?><div class="ci-cf-wrap"><?php
		ci_metabox_open_tab( '' );
			ci_metabox_input( 'ci_cpt_videos_url', __( 'Video URL:', 'ci_theme' ), array( 'esc_func' => 'esc_url' ) );
			ci_metabox_checkbox( 'ci_cpt_videos_self', 1, __( 'Is it self-hosted?', 'ci_theme' ) );
		ci_metabox_close_tab();
	?></div><?php
}
endif;


if( !function_exists('videos_save_meta') ):
function videos_save_meta( $post_id, $post ) {
	
	if ( !ci_can_save_meta('cpt_videos') ) return;

	update_post_meta( $post_id, 'ci_cpt_videos_url', esc_url_raw( $_POST['ci_cpt_videos_url'] ) );
	update_post_meta( $post_id, 'ci_cpt_videos_self', ci_sanitize_checkbox( $_POST['ci_cpt_videos_self'], 1 ) );

}
endif;
?>