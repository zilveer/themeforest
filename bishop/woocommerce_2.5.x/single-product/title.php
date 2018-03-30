<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( yit_get_option('shop-single-product-title') == 'no' ) return;
?>

<h1 itemprop="name" class="product_title entry-title" <?php if( yit_get_option( 'shop-single-product-title-uppercase' ) == 'yes' ) echo 'style=text-transform:uppercase;'; ?> ><?php the_title(); ?></h1>