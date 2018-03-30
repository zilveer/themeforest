<?php

/*----------------------------------------------------*/
/*	Declare WooCommerce support
/*----------------------------------------------------*/
add_theme_support( 'woocommerce' );

/*----------------------------------------------------*/
/*	WooCommerce AJAX cart update
/*----------------------------------------------------*/
add_filter('woocommerce_add_to_cart_fragments', 'heartfelt_woocommerce_header_add_to_cart_fragment');

function heartfelt_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'heartfelt'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'heartfelt'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
	
}

/*----------------------------------------------------*/
/*	Wrapping div to product details on shop page
/*----------------------------------------------------*/
add_filter('woocommerce_before_shop_loop_item_title', 'heartfelt_archive_product_wrap_before');

if (!function_exists('heartfelt_archive_product_wrap_before')) {
	function heartfelt_archive_product_wrap_before( $variable ) {
		echo "<div class=\"caption\"><div class=\"archive_product_wrap\">";
	return $variable;
	}
}

add_filter('woocommerce_after_shop_loop_item_title', 'heartfelt_archive_product_wrap_after');

if (!function_exists('heartfelt_archive_product_wrap_after')) {
	function heartfelt_archive_product_wrap_after( $variable ) {
		echo "</div></div>";
	return $variable;
	}
}

/*----------------------------------------------------*/
/*	Change number or products per row to 3
/*----------------------------------------------------*/
add_filter('loop_shop_columns', 'heartfelt_loop_columns');

if (!function_exists('heartfelt_loop_columns')) {
	function heartfelt_loop_columns() {
		return 3; // 3 products per row
	}
}

/*----------------------------------------------------*/
/*	Display 12 products per page
/*----------------------------------------------------*/
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

?>