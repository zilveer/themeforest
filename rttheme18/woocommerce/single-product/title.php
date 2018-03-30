<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


echo do_action( "get_info_bar", apply_filters( 'get_info_bar_single_products_woocommerce', array( "called_for" => "inside_content" ) ) );
?>