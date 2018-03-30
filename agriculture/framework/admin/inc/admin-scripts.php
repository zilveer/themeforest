<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Admin Panel Scripts & Styles
 * Created by CMSMasters
 * 
 */


function cnsmasters_widgets_js($hook) {
	wp_register_style('editor-additions-styles', get_template_directory_uri() . '/framework/admin/inc/css/editor-additions.css', array(), '1.0.0', 'screen');
	
	wp_register_script('editor-additions-scripts', get_template_directory_uri() . '/framework/admin/inc/js/editor-additions.js', array('jquery'), '1.0.0', true);
	
	
	if ( 
		($hook == 'post.php') || 
		($hook == 'post-new.php') 
	) {
		wp_enqueue_style('editor-additions-styles');
		wp_enqueue_style('wp-color-picker');
		
		
		wp_enqueue_script('editor-additions-scripts');
		wp_enqueue_script('wp-color-picker');
	}
	
	
	
	wp_register_style('widgets-styles', get_template_directory_uri() . '/framework/admin/inc/css/widgets-styles.css', array(), '1.0.0', 'screen');
	
	wp_register_script('widgets-scripts', get_template_directory_uri() . '/framework/admin/inc/js/widgets-scripts.js', array('jquery'), '1.0.0', true);
	
	
	if ($hook == 'widgets.php') {
		wp_enqueue_style('widgets-styles');
		wp_enqueue_style('wp-color-picker');
		
		wp_enqueue_script('widgets-scripts');
		wp_enqueue_script('wp-color-picker');
	}
}

add_action('admin_enqueue_scripts', 'cnsmasters_widgets_js');

