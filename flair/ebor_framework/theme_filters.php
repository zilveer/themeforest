<?php

/**
 * Ebor Framework
 * Theme Filters
 * @since version 1.0
 * @author TommusRhodus
 */

function ebor_tag_cloud($tag_string){
   return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}
add_filter('wp_generate_tag_cloud', 'ebor_tag_cloud',10,3);

function custom_admin_post_thumbnail_html( $content ) {
	if( get_post_type() == 'client' ){
    	$content = str_replace( __( 'Set featured image', 'frost' ), __( 'Set featured image (Min 300px Width, Min 200px Height)', 'frost' ), $content);
	} else {
		$content = str_replace( __( 'Set featured image', 'frost' ), __( 'Set featured image (Min 480px Width, Min 360px Height)', 'frost' ), $content);
	}
	return $content;
}
add_filter( 'admin_post_thumbnail_html', 'custom_admin_post_thumbnail_html' );

if(!( function_exists('ebor_excerpt_more') )){
	function ebor_excerpt_more( $more ) {
		return '...';
	}
}
add_filter('excerpt_more', 'ebor_excerpt_more');

if(!( function_exists('ebor_excerpt_length') )){
	function ebor_excerpt_length( $length ) {
		return 45;
	}
}
add_filter( 'excerpt_length', 'ebor_excerpt_length', 999 );

add_filter('widget_text', 'do_shortcode');

/**
 * Add Search Link to Menu
 */
function ebor_one_page_nav_rewrite($items, $args) {
	global $post;
	
	if(!( is_page_template('page_home.php') )){
		return str_replace('href="#', 'href="' . home_url() . '/#', $items);
	} else {
		return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'ebor_one_page_nav_rewrite', 20,2 );