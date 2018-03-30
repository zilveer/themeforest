<?php
	
global $woocommerce;
	
// WooCommerce
add_theme_support( 'woocommerce' );

// Remove All WooCommerce Styling
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

add_filter( 'loop_shop_columns', 'boxy_loop_shop_columns', 1, 10 );
function boxy_loop_shop_columns( $number_columns ) {
	return 3;
}

add_filter('woocommerce_after_shop_loop_item_title','eden_after_shop_loop_item_title');
function eden_after_shop_loop_item_title(){
	$cat_names = array();
	$product_cats = get_the_terms(false,'product_cat');
	if (!empty($product_cats)):
		foreach($product_cats as $cat):
			$cat_names[] = $cat->name;
		endforeach;
	endif;
	echo '<span class="product-cat-list">'.implode(', ',$cat_names).'</span>';
}

add_filter( 'woocommerce_cart_item_remove_link', 'boxy_cart_item_remove_link', 1, 1 );
function boxy_cart_item_remove_link($cart_item_key){
	return str_replace('&times;','<i class="fa fa-times-circle"></i>',$cart_item_key);
}
		
// WooCommerce Titles
if (isset($woocommerce)):
	add_filter('woocommerce_page_title','es_woo_title', 15);
	function es_woo_title( $page_title ){
		return '<span>'.$page_title.'</span>';
	}
endif;

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?><a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a><?php
	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
}

// WooCommerce Styling
function boxy_woocommerce_styles_scripts()  
{
	
	$template_dir = get_template_directory_uri();
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
		wp_enqueue_style( 'custom-woocommerce', $template_dir . '/_theme_styles/woocommerce.css', array(), '2.0', 'all' );
	endif;

}
 
add_action('wp_enqueue_scripts', 'boxy_woocommerce_styles_scripts');