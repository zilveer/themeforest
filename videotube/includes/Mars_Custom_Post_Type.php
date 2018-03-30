<?php
/**
 * VideoTube Custom Post Type
 * Add Video Post Type
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !class_exists('Mars_Custom_Post_Type') ){
	class Mars_Custom_Post_Type {
		function __construct() {
			add_action('init', array($this,'register_my_cpt_video'));
		}
		function register_my_cpt_video() {
			global $videotube;
			$rewrite_slug = trim( $videotube['rewrite_slug'] ) ? trim( $videotube['rewrite_slug'] ) : 'video';
			$args = array(
				'label' => __('Videos','mars'),
				'description' => '',
				'public' => true,
				'has_archive'	=>true,
				'show_ui' => true,
				'show_in_menu' => true,
				'capability_type' => 'post',
				'map_meta_cap' => true,
				'hierarchical' => false,
				'menu_icon'	=>	'dashicons-video-alt',
				'rewrite' => array('slug' => $rewrite_slug, 'with_front' => true),
				'query_var' => true,
				'supports' => array('title','editor','publicize','comments','thumbnail','author','post-formats'),
				'labels' => array (
					  'name' => 'Videos',
					  'singular_name' => __('Videos','mars'),
					  'menu_name' => __('Videos','mars'),
					  'add_new' => __('Add Videos','mars'),
					  'add_new_item' => __('Add New Videos','mars'),
					  'edit' => __('Edit','mars'),
					  'edit_item' => __('Edit Videos','mars'),
					  'new_item' => __('New Videos','mars'),
					  'view' => __('View Videos','mars'),
					  'view_item' => __('View Videos','mars'),
					  'search_items' => __('Search Videos','mars'),
					  'not_found' => __('No Videos Found','mars'),
					  'not_found_in_trash' => __('No Videos Found in Trash','mars'),
					  'parent' => __('Parent Videos','mars'),
					)
			);
			$args	=	apply_filters( 'mars_video_post_type_args' , $args);
			register_post_type('video', $args); 
		}
	}
	new Mars_Custom_Post_Type();
}