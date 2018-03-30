<?php 
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'multipurpose_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'multipurpose_wrapper_end', 10);

function multipurpose_wrapper_start() {
  //echo '<section class="main single">';
}

function multipurpose_wrapper_end() {
  //echo '</section>';
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );

add_filter( 'woocommerce_enqueue_styles', '__return_false' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

/*
 * Hook in on activation
 *
 */
add_action( 'init', 'multipurpose_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function multipurpose_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '400',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '400',	// px
		'height'	=> '400',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '90',	// px
		'height'	=> '90',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 20;' ), 20 );
?>