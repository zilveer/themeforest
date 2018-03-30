<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if( ! get_data('shop_product_price_listing') || (get_data('shop_catalog_mode') && get_data('shop_catalog_mode_hide_prices')))
	return;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<h3 class="price"><?php echo $price_html; ?></h3>
<?php endif; ?>