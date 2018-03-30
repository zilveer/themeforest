<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product,$qode_options;

$type = "type1";
if(isset($qode_options['woo_products_list_type'])){
	$type = $qode_options['woo_products_list_type'];
}

$add_to_cart_text= $product->add_to_cart_text();

if ( ! $product->is_in_stock() ) : ?>
   <div class="product_image_overlay"></div><span class="onsale out-of-stock-button"><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', 'woocommerce' ) ); ?></span></span>
<?php else :
echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<div class="product_image_overlay"></div><div class="add-to-cart-button-outer"><div class="add-to-cart-button-inner"><div class="add-to-cart-button-inner2"><a class="product_link_over" href="'.get_permalink($product->id).'"></a><a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="qbutton add-to-cart-button %s">%s</a></div></div></div>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_html( $add_to_cart_text )
	),
$product );

endif;
?>