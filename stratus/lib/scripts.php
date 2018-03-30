<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/bootstrap.css
 * 2. /theme/assets/css/app.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.10.2.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.6.2.min.js
 * 3. /theme/assets/js/plugins.js (in footer)
 * 4. /theme/assets/js/main.js    (in footer)
 */ 
function roots_scripts() {

	if (is_single() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	wp_enqueue_script('jquery');

	/*
	* Prelaoder CSS
	 *  Only use of it's enabled in the theme options and if we are using the flex slider.
	* */

	if ( function_exists( 'ot_get_option' ) ) {
		$themo_preloader = ot_get_option( 'themo_preloader', "on" );
		if ($themo_preloader == 'on'){

			$id = get_the_ID();
			if(isset($id) && $id > ""){
				$show = get_post_meta($id, 'themo_slider_sortorder_show', true );
				$show_flex = get_post_meta($id, 'themo_slider_flex_show', true );
				if($show == 1 && $show_flex == 1) {
					wp_register_style('preloader', get_template_directory_uri() . '/assets/css/preloader.css', array(), '1');
					wp_enqueue_style('preloader');
				}
			}
		}
	}


	/********************************
	Bootstrap + Vendor CSS / JS
	 ********************************/


	wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.1.1');
	wp_enqueue_style('bootstrap');

	wp_register_style('t_vendor', get_template_directory_uri() . '/assets/css/vendor.css', array(), '1.0');
	wp_enqueue_style('t_vendor');


	wp_register_script('t_vendor', get_template_directory_uri() . '/assets/js/vendor/vendor.js', array(), '1.0', false);
	wp_enqueue_script('t_vendor');

	wp_register_script('t_vendor_footer', get_template_directory_uri() . '/assets/js/vendor/vendor_footer.js', array(), '1.0', true);
	wp_enqueue_script('t_vendor_footer');

	
	/********************************
		Main JS - moved to vendor.js
		In the future if we want to include specific JS plugins for Twitter bootstrap then we would do that here. For now we include
		everything in on bootstrap.js file.
	********************************/  
  	wp_register_script('roots_main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.1', true);
	wp_enqueue_script('roots_main');
	
	
	/********************************
		Headhesive
	********************************/
	if ( function_exists( 'ot_get_option' ) ) {
		$sticky_header = ot_get_option( 'themo_sticky_header', "on" );
		if ($sticky_header == 'on'){ 			
			wp_register_script('headhesive', get_template_directory_uri() . '/assets/js/vendor/headhesive.min.js', array(), '1.1.1', true);
			wp_enqueue_script('headhesive');
		}
	}

	/********************************
		NiceScroll
	********************************/
	if ( function_exists( 'ot_get_option' ) ) {
		$smooth_scroll = ot_get_option( 'themo_smooth_scroll', "on" );
		if ($smooth_scroll == 'on'){ 			
			wp_register_script('nicescroll', get_template_directory_uri() . '/assets/js/vendor/jquery.nicescroll.min.js', array(), '3.5.4', true);
  			wp_enqueue_script('nicescroll');
		}
	}
	
	/********************************
		Main Stylesheet
	********************************/  
	wp_register_style('roots_app',  get_template_directory_uri() . '/assets/css/app.css', array(), '1');
	wp_enqueue_style('roots_app');

	/********************************
		Responsive @media CSS
	********************************/
	wp_register_style('responsive_css',  get_template_directory_uri() . '/assets/css/responsive.css', array(), '1');
	wp_enqueue_style('responsive_css');


    /********************************
    WooCommerce
     ********************************/
    // If woocommerce enabled then ensure shortcodes are respected inside our html metaboxes.
    if ( class_exists( 'woocommerce' ) ) {
        global $post;
        if(isset($post->ID) && $post->ID > 0){
            $themo_meta_data = get_post_meta($post->ID); // get all post meta data
            foreach ( $themo_meta_data as $key => $value ){ // loop
                $pos_html = strpos($key, 'themo_html_'); // Get position of 'themo_html_' in each key.
                $pos_content = strpos($key, '_content'); // Get position of '_content' in each key.
                if($pos_html == 0 && $pos_content > 0 && isset($value) && is_array($value) && isset($value[0]) && strstr( $value[0], '[product_page' )){
                    global $woocommerce;
                    $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
                    wp_enqueue_script( 'prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
                    wp_enqueue_script( 'prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
                    wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );
                }
            }
        }
    }
		
	/********************************
		Child Theme
	********************************/
	if (is_child_theme()) {
		wp_register_style('roots_child', get_stylesheet_uri());
		wp_enqueue_style('roots_child');
	}

  
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);


