<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$oos_ribbon_show        = get_data('shop_oos_ribbon_show');
$featured_ribbon_show   = get_data('shop_featured_ribbon_show');
$sale_ribbon_show       = get_data('shop_sale_ribbon_show');
?>
<?php if ( $oos_ribbon_show && $product->is_in_stock() == false && ! ($product->is_type('variable') && $product->get_total_stock() > 0)) : ?>

	<div class="onsale oos"><?php _e('Out of stock', 'aurum'); ?></div>

<?php elseif ( $oos_ribbon_show && ( $product->backorders_allowed() || $product->backorders_require_notification() ) ) : ?>
	
	<div class="onsale oos bo"><?php _e( 'Available for backorder', 'aurum' ); ?></div>

<?php elseif ( $featured_ribbon_show && $product->is_featured() ) : ?>

	<div class="onsale featured"><?php _e('Featured', 'aurum'); ?></div>

<?php elseif ( $sale_ribbon_show && $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'aurum' ) . '</span>', $post, $product ); ?>

<?php endif; ?>