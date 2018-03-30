<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $woocommerce_loop;

$classes = '';

if ( isset( $woocommerce_loop['columns'] ) ) {
	$classes .= 'thb-woo-' . $woocommerce_loop['columns'] . 'col';
}

?>
<ul class="products <?php echo $classes; ?>">
