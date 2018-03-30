<?php

// Main Styles
function thb_main_styles() {
	// Register 
	wp_register_style("thb-fa", 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', null, null);
	wp_register_style("thb-app", THB_THEME_ROOT .  "/assets/css/app.css", null, null);
	
	// Enqueue
	wp_enqueue_style('thb-fa');
	wp_enqueue_style('thb-app');
	wp_enqueue_style('style', get_stylesheet_uri(), null, null);	
	
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont(), array(), null );
	wp_add_inline_style( 'thb-app', thb_selection() );
}

add_action('wp_enqueue_scripts', 'thb_main_styles');

// Main Scripts
function thb_register_js() {
	
	if (!is_admin()) {
		$thb_api_key = ot_get_option('map_api_key');
		// Register 
		wp_register_script('gmapdep', 'https://maps.google.com/maps/api/js?key='.$thb_api_key.'', false, null, false);
		wp_register_script('thb-vendor', THB_THEME_ROOT . '/assets/js/vendor.min.js', array('jquery'), null, TRUE);
		wp_register_script('thb-app', THB_THEME_ROOT . '/assets/js/app.min.js', array('jquery', 'thb-vendor'), null, TRUE);
		
		// Enqueue
		if ( is_page_template( 'template-contact.php' ) ) {
			wp_enqueue_script('gmapdep');
		}
		wp_enqueue_script('thb-vendor');
		wp_enqueue_script('thb-app');
		wp_localize_script( 'thb-app', 'themeajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
		
		// YITH Ajax Product Search
		if ( class_exists( 'YITH_WCAS' ) ) {
			wp_enqueue_script('yith_wcas_frontend' );
		}
		
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'thb_register_js');

// Admin Scripts
function thb_admin_scripts() {
	wp_register_script('thb-admin-meta', THB_THEME_ROOT .'/assets/js/admin-meta.min.js', array('jquery'));
	wp_enqueue_script('thb-admin-meta');
	
	wp_register_style("thb-admin-css", THB_THEME_ROOT . "/assets/css/admin.css");
	wp_enqueue_style('thb-admin-css'); 
	if (class_exists('WPBakeryVisualComposerAbstract')) {
		wp_enqueue_style( 'vc_extra_css', THB_THEME_ROOT . '/assets/css/vc_extra.css' );
	}
}
add_action('admin_enqueue_scripts', 'thb_admin_scripts');

/* WooCommerce */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );