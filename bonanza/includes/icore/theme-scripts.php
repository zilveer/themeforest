<?php

/*-----------------------------------------------------------------------------------*/
/* Load Theme JavaScript */
/*-----------------------------------------------------------------------------------*/  

if (!is_admin())
	add_action( 'wp_enqueue_scripts', 'theme_js' );
	
/* Load frontend javascripts */
function theme_js( ) {
	
    global $version;

	// Load javascript
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('shadowbox', get_template_directory_uri() . '/js/shadowbox/shadowbox.js', array('jquery'), '', true);
    wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '', true); 
	wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '', true);
	wp_enqueue_script('mobile-menu', get_template_directory_uri() . '/js/mobile.menu.js', array('jquery'), '', true);

	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array('jquery'), '', true);
		
	if ( get_post_type() == 'product' ) {
		wp_enqueue_script('product-js', get_template_directory_uri() . '/js/single_slider.js','', '', true);
	}
	
	if ( is_home() || is_front_page() ) {
		wp_enqueue_script('homepage-js', get_template_directory_uri() . '/js/homepage.js','', '', true);
	}
	
	if ( ! is_home() || ! is_front_page() )
	wp_enqueue_script('product-js', get_template_directory_uri() .  '/js/flexslider/portfolio-slider.js','', '', true);
	

	if ( class_exists('woocommerce') && WOOCOMMERCE_VERSION < '2.0') {
	    wp_enqueue_script('woocommerce-cart-js', get_template_directory_uri() . '/includes/woocommerce/woocommerce-cart-js.js','', '', true);
	}
	
	if ( class_exists('woocommerce') ) {
	    wp_enqueue_script('woocommerce-js', get_template_directory_uri() . '/includes/woocommerce/woocommerce-js.js','', '', true);
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
			
	// Load javascript related styles
	wp_enqueue_style( 'shadowbox', get_template_directory_uri() . '/js/shadowbox/shadowbox.css' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/js/flexslider/flexslider.css' );
	if ( class_exists('woocommerce') )
		wp_enqueue_style( 'woocommerce-style', get_template_directory_uri() . '/includes/woocommerce/woocommerce.css' );
	
	
}

if (!is_admin())
	add_action( 'wp_head', 'init_slider' );
	
function init_slider() {
	
	global $theme_options;
	
	if ( $theme_options["slider_type"] == "flexslider" && is_home() || $theme_options["slider_type"] == "flexslider" && is_front_page() ) include( get_template_directory() . '/js/flexslider/flexslider_init.php' );
	
	if ( $theme_options["slider_type"] == "flexthumbs" && is_home() || $theme_options["slider_type"] == "flexthumbs" && is_front_page() ) include( get_template_directory() . '/js/flexslider/flexthumbs_init.php' );	
	
	if ( $theme_options["slider_type"] == "flexlaptop" && is_home() || $theme_options["slider_type"] == "flexlaptop" && is_front_page() ) include( get_template_directory() . '/js/flexslider/flexslider_init.php' );
		
}

?>