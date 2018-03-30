<?php

if ( function_exists( 'vc_set_as_theme' ) ) {

	// settings
	vc_set_as_theme( true );
	vc_disable_frontend();
	vc_set_default_editor_post_types( array( 'page', 'berger_portfolio', 'post' ) );
	
	//remove the shortcodes we don't need
	//global $clapat_bg_theme_options;
	//if( $clapat_bg_theme_options['clapat_bg_disable_vc_components'] ){
	
		// content and structure elements
		vc_remove_element('vc_posts_grid');
		vc_remove_element('vc_accordion');
		vc_remove_element('vc_carousel');
		vc_remove_element('vc_cta_button');
		vc_remove_element('vc_cta_button2');
		vc_remove_element('vc_button2');
		vc_remove_element('vc_facebook');
		vc_remove_element('vc_gallery');
		vc_remove_element('vc_googleplus');
		vc_remove_element('vc_images_carousel');
		vc_remove_element('vc_item');
		vc_remove_element('vc_items');
		vc_remove_element('vc_pinterest');
		vc_remove_element('vc_posts_slider');
		vc_remove_element('vc_toggle');
		vc_remove_element('vc_tweetmeme');
		vc_remove_element('vc_pie');
		vc_remove_element('vc_progress_bar');
		vc_remove_element('vc_video');
		vc_remove_element('vc_custom_heading');
		vc_remove_element('vc_message');
		vc_remove_element('vc_tour');
		vc_remove_element('vc_widget_sidebar');
		vc_remove_element('vc_button');
		vc_remove_element('vc_button2');
		vc_remove_element('vc_flickr');
		// wordpress widgets
		vc_remove_element('vc_wp_search');
		vc_remove_element('vc_wp_meta');
		vc_remove_element('vc_wp_recentcomments');
		vc_remove_element('vc_wp_calendar');
		vc_remove_element('vc_wp_pages');
		vc_remove_element('vc_wp_tagcloud');
		vc_remove_element('vc_wp_custommenu');
		vc_remove_element('vc_wp_text');
		vc_remove_element('vc_wp_posts');
		vc_remove_element('vc_wp_links');
		vc_remove_element('vc_wp_categories');
		vc_remove_element('vc_wp_archives');
		vc_remove_element('vc_wp_rss');
	//}
	
	// Map Berger shortcodes
	require_once ( get_template_directory() . '/include/vc_map.php');
}
	
?>