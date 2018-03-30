<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
//if ( is_single() ) return;

?>
<div class="woocommerce-price-and-add group">
	<div class="woocommerce-price"><?php do_action('yit_woocommerce_price'); ?></div>
	<div class="woocommerce-add-to-cart"><?php do_action('yit_woocommerce_add_to_cart'); ?></div>
</div>