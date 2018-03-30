<?php
/*=======================================
	WOO
=======================================*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}



// Display products per page.
if (!isset($oi_options['oi_shop_per_page'])){$oi_options['oi_shop_per_page'] ='8';}; 
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$oi_options['oi_shop_per_page'].';' ), 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
/** Remove Showing results functionality site-wide */
function woocommerce_result_count() {
        return;
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
<div class="oi_head_cart">
    <a class="" href="<?php echo WC()->cart->get_cart_url(); ?>"><span class="oi_cart_icon"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'orangeidea' ), WC()->cart->cart_contents_count ); ?></span></a>
</div>
<?php
	$fragments['div.oi_head_cart'] = ob_get_clean();
	return $fragments;
}

add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
function woo_hide_page_title() {
	return false;
}

?>