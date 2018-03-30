<?php

if(function_exists('vc_set_as_theme')) {

	/* Set Theme */
	vc_set_as_theme( true );

	/* Disable Front-End */
	vc_disable_frontend();

	/* Set Default Value */
	vc_set_default_editor_post_types( array( 'post', 'page', 'portfolio', 'team' ) );

	/* Set templates directory */
	vc_set_template_dir( get_template_directory() . '/vc_extend/vc_templates/');

	/* Include map.php */
	include( 'dependencies.php' );
	include( 'map.php' );

	/* Removing shortcodes */
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
	vc_remove_element('vc_widget_sidebar');

	vc_remove_element('vc_button');
	vc_remove_element('vc_button2');
	vc_remove_element('vc_carousel');
	vc_remove_element('vc_column_text');
	vc_remove_element('vc_cta_button');
	vc_remove_element('vc_cta_button2');
	vc_remove_element('vc_custom_heading');
	vc_remove_element('vc_empty_space');
	vc_remove_element('vc_facebook');
	vc_remove_element('vc_flickr');
	vc_remove_element('vc_gallery');
	vc_remove_element('vc_gmaps');
	vc_remove_element('vc_googleplus');
	vc_remove_element('vc_images_carousel');
	vc_remove_element('vc_item');
	vc_remove_element('vc_items');
	vc_remove_element('vc_message');
	vc_remove_element('vc_pie');
	vc_remove_element('vc_pinterest');
	vc_remove_element('vc_posts_grid');
	vc_remove_element('vc_posts_slider');
	vc_remove_element('vc_progress_bar');
	vc_remove_element('vc_separator');
	vc_remove_element('vc_single_image');
	vc_remove_element('vc_accordion');
	vc_remove_element('vc_tab');
	vc_remove_element('vc_tabs');
	vc_remove_element('vc_tour');
	vc_remove_element('vc_teaser_grid');
	vc_remove_element('vc_text_separator');
	vc_remove_element('vc_toggle');
	vc_remove_element('vc_tweetmeme');
	vc_remove_element('vc_twitter');
	vc_remove_element('vc_video');

	vc_remove_element('vc_basic_grid');
	vc_remove_element('vc_media_grid');
	vc_remove_element('vc_masonry_grid');
	vc_remove_element('vc_masonry_media_grid');
	vc_remove_element('vc_icon');

	vc_remove_element('vc_cta');
	vc_remove_element('vc_btn');
	vc_remove_element('vc_tta_tour');
	vc_remove_element('vc_tta_tabs');
	vc_remove_element('vc_tta_accordion');
	vc_remove_element('vc_tta_section');
	vc_remove_element('vc_tta_pageable');

	vc_remove_element('vc_round_chart');
	vc_remove_element('vc_line_chart');

	/* Clean Output Classes */
	function setClass($classes){
		if($classes){
			$return = '';
			foreach($classes as $class) {
			if(trim($class))
				$return .= trim($class).' ';
			}
			if(trim($return) != '')
			return ' class="'.trim($return).'"';
		}
	}

	// Portfolio Pagination
	function round_num($num, $to_nearest) {
	   return floor($num/$to_nearest)*$to_nearest;
	}

	// Hex to Rgb
	function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}

	//Fixing filtering for shortcodes
	function shortcode_empty_paragraph_fix($content){   
	    $array = array (
	        '<p>[' => '[', 
	        ']</p>' => ']', 
	        ']<br />' => ']'
	    );

	    $content = strtr($content, $array);
	    return $content;
	}
	add_filter('the_content', 'shortcode_empty_paragraph_fix');

	// Replace the classes for the vc_row and vc_column shortcodes
	function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
		    $class_string = preg_replace('/vc_col\-(xs|sm|md|lg)\-(\d{1,2})/', 'col-md-$2', $class_string); // This will replace "vc_col-sm-%" with "col-md-%"
		}
		return $class_string; // Important: you should always return modified or original $class_string
	}
	add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);

	// Remove VC Metabox
	function remove_vc_meta_box() {
		remove_meta_box('vc_teaser', 'portfolio', 'side');
		remove_meta_box('vc_teaser', 'page', 'side'); 
		remove_meta_box('vc_teaser', 'team', 'side'); 
		remove_meta_box('vc_teaser', 'post', 'side');
		remove_meta_box('vc_teaser', 'product', 'side'); 
	}
	add_action( 'admin_head', 'remove_vc_meta_box' );

	// Remove Grid Element Builder
	function unregister_grid_post_type() {
	    global $wp_post_types;
	    if ( isset( $wp_post_types[ 'vc_grid_item' ] ) ) {
	        unset( $wp_post_types[ 'vc_grid_item' ] );
	        return true;
	    }
	    return false;
	}
	add_action('init', 'unregister_grid_post_type', 100);

	// Remove Templates
	function az_custom_template_modify_array( $data ) {    
		return array(); 
	}
	add_filter( 'vc_load_default_templates', 'az_custom_template_modify_array' );

	// The function below deregisters the scripts embedded through the Visual Composer plugin. This is needed because i have rewritten most of the shortcode from the plugin and the theme will load the proper scripts & styles anyway.
	function az_handle_jscomp_scripts() {
		wp_dequeue_style( array( 'js_composer_front', 'js_composer_custom_css', 'flexslider', 'nivo-slider-css', 'nivo-slider-theme', 'prettyphoto', 'isotope-css' ) );
	    wp_deregister_style( array( 'js_composer_front', 'js_composer_custom_css', 'flexslider', 'nivo-slider-css', 'nivo-slider-theme', 'prettyphoto', 'isotope-css' ) );
		wp_dequeue_script( array( 'wpb_composer_front_js', 'flexslider', 'isotope', 'tweet', 'jcarousellite', 'nivo-slider', 'waypoints', 'prettyphoto', 'jquery_ui_tabs', 'jquery_ui_tabs_rotate' ) );
	    wp_deregister_script( array( 'wpb_composer_front_js', 'flexslider', 'isotope', 'tweet', 'jcarousellite', 'nivo-slider', 'waypoints', 'prettyphoto', 'jquery_ui_tabs', 'jquery_ui_tabs_rotate' ) );
	}
	add_action( 'wp_enqueue_scripts', 'az_handle_jscomp_scripts', 99 );

	function az_handle_backend_css_scripts() {
		wp_dequeue_style( array( 'vc_openiconic', 'vc_typicons', 'vc_entypo', 'vc_linecons', 'font-awesome' ) );
	    wp_deregister_style( array( 'vc_openiconic', 'vc_typicons', 'vc_entypo', 'vc_linecons', 'font-awesome' ) );
	}
	add_action( 'admin_init', 'az_handle_backend_css_scripts', 99 );

	// Remove Generator
	function backeryGenerator() {
	    remove_action('wp_head', array(visual_composer(), 'addMetaData'));
	}
	add_action('init', 'backeryGenerator', 100);

	// Remove WooCommerce Shortcodes
	function az_woocommerce_shortcode_remove() {
    	vc_remove_element('woocommerce_cart');
    	vc_remove_element('woocommerce_checkout');
    	vc_remove_element('woocommerce_order_tracking');
    	vc_remove_element('woocommerce_my_account');
    	vc_remove_element('recent_products');
    	vc_remove_element('featured_products');
    	vc_remove_element('product');
    	vc_remove_element('products');
    	vc_remove_element('add_to_cart');
    	vc_remove_element('add_to_cart_url');
    	vc_remove_element('product_page');
    	vc_remove_element('product_category');
    	vc_remove_element('product_categories');
    	vc_remove_element('sale_products');
    	vc_remove_element('best_selling_products');
    	vc_remove_element('top_rated_products');
    	vc_remove_element('product_attribute');
    	vc_remove_element('related_products');
	}
	add_action( 'vc_after_init', 'az_woocommerce_shortcode_remove' );

}
?>