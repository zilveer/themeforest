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

if ($product->is_on_sale()) :

    echo apply_filters('woocommerce_sale_flash', '<span class="badge  badge--article  badge--product  badge--sale">'.__( 'Sale', 'bucket' ).'</span>', $post, $product);

elseif(!$product->is_in_stock()) :

    echo apply_filters('woocommerce_sold_out_flash', '<span class="badge  badge--article  badge--product  badge--sold-out">'.__( 'Sold out', 'bucket' ).'</span>', $post, $product);    

endif;