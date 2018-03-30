<?php
/**
 * Product Loop Sold Out Flash
 *
 * @author 		Gerhard Potgieter
 * @package 	WooCommerce/Templates
 * @version     1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<?php if ( ! $product->is_in_stock() ) : ?>

	<?php echo apply_filters( 'woocommerce_sold_out_flash', '<div class="mpcth-sale-wrap sold"><span class="onsale sold">'.__( 'Sold Out!', 'wc-sold-out-products' ).'</span></div>', $post, $product ); ?>

<?php endif; ?>