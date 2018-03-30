<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<?php if ($product->is_on_sale()) : ?>

	<?php echo apply_filters('woocommerce_sale_flash', '<div class="onsale-wrap"><div class="onsale-inner"><span class="onsale">'.__( 'Sale!', 'woocommerce' ).'</span></div></div>', $post, $product); ?>

<?php endif; ?>