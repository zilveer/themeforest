<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 * 
 * Admin Panel Scripts & Styles
 * Created by CMSMasters
 * 
 */


function cmsmasters_admin_register($hook) {
	$screen = get_current_screen();
	
	
	wp_register_style('admin-icons-font', get_template_directory_uri() . '/framework/admin/inc/css/admin-icons-font.css', array(), '1.0.0', 'screen');
	
	
	wp_register_style('cmsms-lightbox', get_template_directory_uri() . '/framework/admin/inc/css/jquery.cmsmsLightbox.css', array(), '1.0.0', 'screen');
	
	wp_register_style('cmsms-lightbox-rtl', get_template_directory_uri() . '/framework/admin/inc/css/jquery.cmsmsLightbox-rtl.css', array(), '1.0.0', 'screen');
	
	
	wp_register_style('theme-icons', get_template_directory_uri() . '/css/fontello.css', array(), '1.0.0', 'screen');
	
	
	wp_register_script('cmsms-uploader-js', get_template_directory_uri() . '/framework/admin/inc/js/jquery.cmsmsUploader.js', array('jquery'), '1.0.0', true);
	
	wp_localize_script('cmsms-uploader-js', 'cmsms_admin_uploader', array( 
		'choose' => 				esc_attr__('Choose image', 'cmsmasters'), 
		'insert' => 				esc_attr__('Insert image', 'cmsmasters'), 
		'remove' => 				esc_attr__('Remove', 'cmsmasters'), 
		'edit_gallery' => 			esc_attr__('Edit gallery', 'cmsmasters') 
	));
	
	
	wp_register_script('cmsms-lightbox-js', get_template_directory_uri() . '/framework/admin/inc/js/jquery.cmsmsLightbox.js', array('jquery'), '1.0.0', true);
	
	wp_localize_script('cmsms-lightbox-js', 'cmsms_admin_lightbox', array( 
		'cancel' => 				esc_attr__('Cancel', 'cmsmasters'), 
		'insert' => 				esc_attr__('Insert', 'cmsmasters'), 
		'deselect' => 				esc_attr__('Deselect', 'cmsmasters'), 
		'choose_icon' => 			esc_attr__('Choose Icon', 'cmsmasters'), 
		'find_icons' => 			esc_attr__('Find icons', 'cmsmasters'), 
		'error_on_page' => 			esc_attr__("Error on page!\nReload page and try again.", 'cmsmasters') 
	));
	
	
	wp_register_style('admin-theme-styles', get_template_directory_uri() . '/framework/admin/inc/css/admin-theme-styles.css', array(), '1.0.0', 'screen');
	
	wp_register_style('admin-theme-styles-rtl', get_template_directory_uri() . '/framework/admin/inc/css/admin-theme-styles-rtl.css', array(), '1.0.0', 'screen');
	
	
	wp_register_script('admin-theme-scripts', get_template_directory_uri() . '/framework/admin/inc/js/admin-theme-scripts.js', array('jquery'), '1.0.0', true);
	
	
	wp_register_style('widgets-styles', get_template_directory_uri() . '/framework/admin/inc/css/widgets-styles.css', array(), '1.0.0', 'screen');
	
	wp_register_script('widgets-scripts', get_template_directory_uri() . '/framework/admin/inc/js/widgets-scripts.js', array('jquery'), '1.0.0', true);
	
	
	wp_enqueue_style('wp-color-picker');
	
	wp_enqueue_script('wp-color-picker');
	
	
	wp_enqueue_style('admin-icons-font');
	
	wp_enqueue_style('cmsms-lightbox');
	
	if (is_rtl()) {
		wp_enqueue_style('cmsms-lightbox-rtl');
	}
	
	
	wp_enqueue_script('cmsms-uploader-js');
	
	wp_enqueue_script('cmsms-lightbox-js');
	
	
	if ( 
		$hook == 'post.php' || 
		$hook == 'post-new.php' || 
		$hook == 'widgets.php' || 
		$hook == 'nav-menus.php' || 
		$screen->id == 'theme-settings_page_cmsms-settings-style' 
	) {
		cmsms_composer_icons();
		
		
		wp_enqueue_style('theme-icons');
	}
	
	
	if ( 
		$hook == 'widgets.php' || 
		$hook == 'nav-menus.php' 
	) {
		wp_enqueue_media();
	}
	
	
	wp_enqueue_style('admin-theme-styles');
	
	if (is_rtl()) {
		wp_enqueue_style('admin-theme-styles-rtl');
	}
	
	
	wp_enqueue_script('admin-theme-scripts');
	
	
	if ($hook == 'widgets.php') {
		wp_enqueue_style('widgets-styles');
		
		wp_enqueue_script('widgets-scripts');
	}
}

add_action('admin_enqueue_scripts', 'cmsmasters_admin_register');

