<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<?php 
	if( function_exists('add_label_to_product_list') ): 
		add_label_to_product_list();  
	else:
	?>
		<?php if ($product->is_on_sale()) : ?>

			<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale off', 'wpdance' ).'</span>', $post, $product); ?>

		<?php endif; ?>
	<?php endif; ?>