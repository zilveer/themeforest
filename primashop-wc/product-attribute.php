<?php
/**
 * The template for displaying archive page of product attribute.
 *
 * DEPRECEATED in WooCommerce 2.2+
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'woocommerce_archive_description', 'prima_wc_taxonomy_archive_description', 10 );
function prima_wc_taxonomy_archive_description() {
	if ( get_query_var( 'paged' ) == 0 ) {
		$description = apply_filters( 'the_content', term_description() );
		if ( $description ) {
			echo '<div class="term-description">' . $description . '</div>';
		}
	}
}

if ( function_exists( 'wc_get_template' ) ) {
	wc_get_template( 'archive-product.php' );
}
else {
	woocommerce_get_template( 'archive-product.php' );
}
