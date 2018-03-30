<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

global $post, $woocommerce_loop;
if(isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] !== '') {
    $type = $woocommerce_loop['columns'];
} else {
    $type = jwOpt::get_option('woo_type', 0);
    $woocommerce_loop['columns'] = $type;
}
if(!in_array($type, array(0,1,2,10,11,20))){
    $type = 0;
}

echo jaw_get_template_part('content-product-' . $type, 'woocommerce');