<?php
add_action('wp_enqueue_scripts', 'add_scripts');
function add_scripts() {
	
	// jQuery
    wp_enqueue_script( 'jquery' );
	
	// Theme scripts
	wp_enqueue_script('main-scripts', MNKY_JS . '/main.js', array('jquery'), '', true);
	
	// Responsive layout scripts
	if (ot_get_option('responsive_layout') == 'responsive_mobile' || ot_get_option('responsive_layout') == 'responsive_all') {
		if (ot_get_option('mobile-menu-simple')){
			wp_enqueue_script('mobile-menu-simple', MNKY_JS . '/mobile-menu-simple.js', array('jquery'), '', true);
		} else {
			wp_enqueue_script('mobile-menu', MNKY_JS . '/mobile-menu.js', array('jquery'), '', true);
		}
		
		wp_enqueue_script('fluid-video', MNKY_JS . '/jquery.fitvids.js', array('jquery'), '', true);
	}
	
	// Portfolio
	if (is_page_template('page-portfolio.php')) {
		wp_enqueue_script('jquery-quicksand', MNKY_JS . '/jquery.quicksand.js', array('jquery'), '', false);
		wp_enqueue_script('jquery-easing', MNKY_JS . '/jquery.easing.1.3.js', array('jquery'), '', false);
		wp_enqueue_script('quicksand-custom', MNKY_JS . '/quicksand.custom.js', array('jquery'), '', true);
	}
	wp_enqueue_style('portfolio-style', MNKY_CSS . '/portfolio.css', false, '', 'all');
	
	// Woocommerce style
	if (class_exists( 'Woocommerce' )){
		wp_enqueue_style( 'my-woocommerce', MNKY_PLUGIN_URL . '/woocommerce/woocommerce.css', null, 1.0, 'all' );
	}
		
	// Dynamic style
	wp_enqueue_style('dynamic-style', MNKY_PATH . '/dynamic-style.php', false, '', 'all');
	
	// Responsive layout CSS
	if (ot_get_option('responsive_layout') == 'responsive_mobile') {
		wp_enqueue_style('responsive-css', MNKY_CSS . '/responsive.css', array('dynamic-style'), '', 'all');
	} elseif (ot_get_option('responsive_layout') == 'responsive_all') {
		wp_enqueue_style('responsive-css', MNKY_CSS . '/responsive-all.css', array('dynamic-style'), '', 'all');
	}
	
	// Comment Script
	if(is_singular() && comments_open()){
		wp_enqueue_script( 'comment-reply' ); 
	}

}
?>