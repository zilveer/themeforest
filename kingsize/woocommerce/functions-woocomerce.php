<?php

// Number of WC Products to display per column
// Requires updating width 32% in custom.css when changing this
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// Number of Products Per Page
// Default number is 12
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

// Number of WC Related Products to display
add_filter( 'woocommerce_output_related_products_args', 'kingsize_related_products_args' );
  function kingsize_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}

// Theme Default WooCommerce Image Sizes
function kingsize_wc_image_sizes() {
	global $pagenow;
 
	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

  	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '250',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '180',	// px
		'height'	=> '180',	// px
		'crop'		=> 0 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_action( 'after_switch_theme', 'kingsize_wc_image_sizes', 1 );

// Show WooCommerce Descriptions on Shop
add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt', 5);

// Remove Prices from WooCommerce Shop
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );


// Custom WooCommerce Pagination for KingSize WordPRess
remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
function woocommerce_pagination() {
		kingsize_pagination(); 		
	}
add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10);