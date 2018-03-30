<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*-----------------------------------------------------------------------------------*/
/* Add layout to body_class output */
/*-----------------------------------------------------------------------------------*/

add_filter( 'body_class','woo_layout_body_class', 10 );		// Add layout to body_class output

if ( ! function_exists( 'woo_layout_body_class' ) ) {
	function woo_layout_body_class( $classes ) {
		
		global $post, $woo_options;

		$layout = 'two-col-left';
		
		if ( isset( $woo_options['woo_layout'] ) && ( $woo_options['woo_layout'] != '' ) ) {
			$layout = $woo_options['woo_layout'];
		}

			// Set main layout on post or page
		if ( is_singular() ) {
			$single = get_post_meta($post->ID, '_layout', true);
			if ( $single != "" )
				$layout = $single;
		}
		
		if ( class_exists( 'woocommerce' ) ) {
		//Add support for WooCommerce "Shop" landing page body CSS class
		if ( function_exists( 'is_shop' ) && is_shop() ) {
			$page_id = get_option( 'woocommerce_shop_page_id' );
			$shop_layout = get_post_meta( $page_id, '_layout', true );
			if ( $layout != '' ) {
				$layout = $shop_layout;
			}
		}

			// Add woocommerce-fullwidth class if full width option is enabled
			if ( isset( $woo_options[ 'woocommerce_archives_fullwidth' ] ) && $woo_options[ 'woocommerce_archives_fullwidth' ] == "false" && (is_shop() || is_product_category() || is_product_tag() )) {
				$layout = 'one-col';
			}
		
			if ( isset($woo_options[ 'woocommerce_products_fullwidth' ]) && $woo_options[ 'woocommerce_products_fullwidth' ] == "false" && ( is_product() ) ) {
				$layout = 'one-col';
			}

		}
		

		if (is_home() || is_front_page() ) {
			if ( isset($woo_options['woo_homepage_sidebar']) && 'true' != $woo_options['woo_homepage_sidebar'] ) { $layout = 'one-col'; }
		}

		if(is_archive()) {
				if ($woo_options['woo_arch_post'] == 'elegant-post') {
					$classes[]	= 'archive-elegant-post';	
			}	
		}

		// Add layout to $woo_options array for use in theme
		$woo_options['woo_layout'] = $layout;
		
		// Add classes to body_class() output 
		$classes[] = $layout;
		return $classes;		
					
	} // End woo_layout_body_class()
}
/*-----------------------------------------------------------------------------------*/
/* Add custom CSS class to the <body> tag if the lightbox option is enabled. */
/*-----------------------------------------------------------------------------------*/

// add_filter( 'body_class', 'woo_add_lightbox_body_class', 10 );

// function woo_add_lightbox_body_class ( $classes ) {
// 	global $woo_options;
	
// 	if ( isset( $woo_options['woo_enable_lightbox'] ) && $woo_options['woo_enable_lightbox'] == 'true' ) {
// 		$classes[] = 'has-lightbox';
// 	}
	
// 	return $classes;
// } // End woo_add_lightbox_body_class()

/*-----------------------------------------------------------------------------------*/
/* Add custom CSS class to the <html> tag if the boxed layout option is enabled. */
/*-----------------------------------------------------------------------------------*/

add_action( 'freschi_theme_boxed', 'woo_add_boxedlayout_body_class' );

function woo_add_boxedlayout_body_class () {
	
	global $woo_options;
	
	if ( isset( $woo_options['woo_boxed_layout'] ) && $woo_options['woo_boxed_layout'] == 'true' ) {
		echo 'boxed';
	}
	

} // End woo_add_boxedlayout_body_class()

 
