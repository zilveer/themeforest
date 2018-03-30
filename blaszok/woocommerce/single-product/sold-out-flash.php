<?php
/**
 * Single Product Sold Out Flash
 *
 * @author 		Gerhard Potgieter
 * @package 	WooCommerce/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<?php if ( ! $product->is_in_stock() ) : ?>

	<?php echo apply_filters( 'woocommerce_sold_out_flash', '<div class="mpcth-sale-wrap sold"><span class="onsale soldout">'.__( 'Sold Out!', 'mpcth' ).'</span></div>', $post, $product ); ?>

<?php endif; ?>