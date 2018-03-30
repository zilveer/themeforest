<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$shop_view_show_price_range_option = yit_get_option( 'shop-view-show-price-range' );
if ( !($shop_view_show_price_range_option == "1" || $shop_view_show_price_range_option == "true") && ($product->product_type == 'variable' || $product->product_type == 'variable-subscription') ) return ;

/* woocommerce subscription price fix */
$class_subscription ="";
if($product->product_type == 'subscription' || $product->product_type == 'variable-subscription') $class_subscription ="subscription";
/*--------------------------*/

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo $product->get_price_html(); ?></p>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
