<?php
add_action('init', 'thb_TheShortcodesForVC');
function thb_TheShortcodesForVC() {
	
	if (!class_exists('WPBakeryVisualComposerAbstract')) { // or using plugins path function
		return;
	}
	
	if(function_exists('vc_set_default_editor_post_types')) vc_set_default_editor_post_types( array('post','page','product') );
	
	if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);
	
	add_filter( 'vc_load_default_templates', 'thb_custom_template_modify_array' );
	function thb_custom_template_modify_array( $data ) {
	    return array();
	}
	
	// Removing Default shortcodes
	vc_remove_element("vc_widget_sidebar");
	vc_remove_element("vc_wp_search");
	vc_remove_element("vc_wp_meta");
	vc_remove_element("vc_wp_recentcomments");
	vc_remove_element("vc_wp_calendar");
	vc_remove_element("vc_wp_pages");
	vc_remove_element("vc_wp_tagcloud");
	vc_remove_element("vc_wp_custommenu");
	vc_remove_element("vc_wp_text");
	vc_remove_element("vc_wp_posts");
	vc_remove_element("vc_wp_links");
	vc_remove_element("vc_wp_categories");
	vc_remove_element("vc_wp_archives");
	vc_remove_element("vc_wp_rss");
	vc_remove_element("vc_teaser_grid");
	vc_remove_element("vc_button");
	vc_remove_element("vc_cta_button");
	vc_remove_element("vc_message");
	vc_remove_element("vc_progress_bar");
	vc_remove_element("vc_pie");
	vc_remove_element("vc_posts_slider");
	vc_remove_element("vc_posts_grid");
	vc_remove_element("vc_images_carousel");
	vc_remove_element("vc_carousel");
	vc_remove_element("vc_gallery");
	vc_remove_element("vc_single_image");
	vc_remove_element("vc_facebook");
	vc_remove_element("vc_tweetmeme");
	vc_remove_element("vc_googleplus");
	vc_remove_element("vc_pinterest");
	vc_remove_element("vc_single_image");
	vc_remove_element("vc_cta_button2");
	vc_remove_element("vc_gmaps");
	vc_remove_element("vc_raw_js");
	vc_remove_element("vc_flickr");
	vc_remove_element("vc_text_separator");
	vc_remove_element("vc_empty_space");
	vc_remove_element("vc_custom_heading");
	
	if (is_admin()) :
		function remove_vc_teaser() {
			remove_meta_box('vc_teaser', 'post' , 'side');
			remove_meta_box('vc_teaser', 'page' , 'side');
			remove_meta_box('vc_teaser', 'product' , 'side');
		}
		add_action( 'admin_head', 'remove_vc_teaser' );
	endif;
	
	// Shortcodes 
	require get_template_directory().'/inc/visualcomposer-extend.php';
	
	/* Offsets */
	function thb_column_offset_class_merge($class_string, $tag) {
		if($tag === 'vc_column') {
			$class_string = preg_replace('/offset-/', 'push-', $class_string);
			$class_string = preg_replace('/vc_col-/', '', $class_string);
			$class_string = preg_replace('/lg/', 'large', $class_string);
			$class_string = preg_replace('/md/', 'medium', $class_string);
			$class_string = preg_replace('/sm/', 'small', $class_string);
			$class_string = preg_replace('/xs/', 'small', $class_string);
			$class_string = preg_replace('/vc_column_container/', 'columns', $class_string);
			
			/* Change visibility */
			$class_string = preg_replace('/vc_hidden-large/', 'hide-for-large-up', $class_string);
			$class_string = preg_replace('/vc_hidden-medium/', 'hide-for-medium-only', $class_string);
			$class_string = preg_replace('/vc_hidden-small/', 'hide-for-small-only', $class_string);
			$class_string = preg_replace('/vc_hidden-smallall/', 'hide-for-small-only', $class_string);
		} else if ($tag === 'vc_row') {
			$class_string = preg_replace('/vc_row/', 'row', $class_string);
		}
		return $class_string;
	}
	add_filter('vc_shortcodes_css_class', 'thb_column_offset_class_merge', 10, 2);
	// Remove visual composer plugin update notifications
	function thb_filter_vc_updates( $value ) {
		if ( isset($value) && is_object($value) ) {
	    unset( $value->response['js_composer/js_composer.php'] );
	    return $value;
		}
	}
	add_filter( 'site_transient_update_plugins', 'thb_filter_vc_updates' );
	add_action( 'vc_before_init' , function(){
	    if(defined('WPB_VC_VERSION')){
	        $_COOKIE['vchideactivationmsg_vc11'] = WPB_VC_VERSION;
	    }
	});
}