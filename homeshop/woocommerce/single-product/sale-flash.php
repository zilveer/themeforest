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
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'homeshop' ) . '</span>', $post, $product ); ?>

<?php endif; ?>

	<?php 
		if ( !$product->is_in_stock() ) : 

			echo '<span class="onsale labels_stock" >'. __("Stock",'homeshop') .'</span>'; 

		endif; 
	 ?>		

<?php if ( $product->is_featured() ) : ?>

	<?php echo apply_filters( 'woocommerce_featured_flash', '<span class="onsale onfeatured">' . __( 'Hot', 'homeshop' ) . '</span>', $post, $product ); ?>

<?php endif; ?>	 