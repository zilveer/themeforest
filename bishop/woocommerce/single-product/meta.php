<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = get_the_terms( $post->ID, 'product_cat' ) ;
$cat_count = is_array($cat_count) ? sizeof($cat_count) : 0;

$tag_count = get_the_terms( $post->ID, 'product_tag' );
$tag_count = is_array($tag_count) ? sizeof($tag_count) : 0;

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'yit' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'yit' ); ?></span>.</span>

	<?php endif; ?>

	<?php

    if ( $cat_count > 0 ) {
        echo _n( 'Category:', 'Categories:', $cat_count, 'yit' ).' '.$product->get_categories( ', ', '<div class="posted_in">', '.</div>' );
        echo "<div class='clear'></div>";
    }

    if($tag_count > 0){
        echo _n( 'Tag:', 'Tags:', $tag_count, 'yit' ).' '.$product->get_tags( ', ', '<div class="tagged_as">', '.</div>' );
        echo "<div class='clear'></div>";
    }

    do_action( 'woocommerce_product_meta_end' );

    ?>

</div>