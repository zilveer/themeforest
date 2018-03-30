<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.1.0
 * 
 * Likes Post Type
 * Changed by CMSMasters
 * 
 */


class Cmsms_Likes {
	function Cmsms_Likes() { 
		$like_labels = array( 
			'name' => __('Likes', 'cmsms_content_composer'), 
			'singular_name' => __('Like', 'cmsms_content_composer') 
		);
		
		
		$like_args = array( 
			'labels' => $like_labels, 
			'public' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false, 
			'exclude_from_search' => true, 
			'publicly_queryable' => false, 
			'show_ui' => false, 
			'show_in_nav_menus' => false 
		);
		
		
		register_post_type('cmsms_like', $like_args);
	}
}


function cmsms_likes_init() {
	global $lk;
	
	
	$lk = new Cmsms_Likes();
}


add_action('init', 'cmsms_likes_init');

