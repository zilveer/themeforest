<?php
/*	
*	---------------------------------------------------------------------
*	Woocommerce functions
*	--------------------------------------------------------------------- 
*/

if ( class_exists( 'Woocommerce' ) ) {

	// Add Support
	add_theme_support( 'woocommerce' );
	
	// Disable WooCommerce styles 
	add_filter( 'woocommerce_enqueue_styles', '__return_false' ); 
	
	// Define Wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

	function my_theme_wrapper_start() {
		 echo '<div id="'. ot_get_option('woo_layout', 'content_left') .'" class="shop-template product-col-'. ot_get_option('woo_columns', '3') .'">';}
	
	function my_theme_wrapper_end() {
	  echo '</div>';
	}

	// Remove Breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

	// Products per row
	add_filter('loop_shop_columns', 'loop_columns');
	
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return ot_get_option('woo_columns', '3');
		}
	}
	
	// Redefine woocommerce_output_related_products()
	function woocommerce_output_related_products() {
		woocommerce_related_products(3,3); // Display 3 products in rows of 3
	}
	
	// Products per page
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '. ot_get_option('woo_product_count', '9') .';' ), 20 );
	
	// Add image wrap
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_product_thumbnail_wrap_open', 9, 2);
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_product_thumbnail_wrap_close', 14, 2);

	if (!function_exists('woocommerce_product_thumbnail_wrap_open')) {
		function woocommerce_product_thumbnail_wrap_open() {
			echo '<div class="img-wrap">';
		}
	}

	if (!function_exists('woocommerce_product_thumbnail_wrap_close')) {
		function woocommerce_product_thumbnail_wrap_close() {
			echo '</div>';
		}
	}
	
	// Add the inner div in product loop
	add_action( 'woocommerce_before_shop_loop_item_title', 'artificer_product_inner_open', 14, 2);
	add_action( 'woocommerce_after_shop_loop_item_title', 'artificer_product_inner_close', 12, 2);

	function artificer_product_inner_open() {
		echo '<div class="product-inner">';
	}
	function artificer_product_inner_close() {
		echo '</div>';
	}
	
	// Change rating position
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 11 );
	
	// Change linked product count in a row
	function woocommerce_upsell_display( $posts_per_page = 3, $columns = 3, $orderby = 'rand' ) {
	woocommerce_get_template( 'single-product/up-sells.php', array(
	'posts_per_page' => $posts_per_page,
	'orderby' => $orderby,
	'columns' => $columns
	) );
	}
	
	// Show sidebar in selected pages
	if ( ! function_exists( 'woocommerce_get_sidebar' ) ) {
		function woocommerce_get_sidebar() {
			if(ot_get_option('woo_layout') != 'content_full'){
				// Display the sidebar if full width option is disabled on archives
				if ( is_archive(array('product')) ) :
					get_sidebar('shop');
				endif;

				// Display the sidebar if full width option is disabled on product pages
				if ( is_singular(array('product')) ) :
					get_sidebar('shop');
				endif;
			}
			
			echo '<div class="clear"></div>';
		}
	}
	
} ?>