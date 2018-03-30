<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>


<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
	<div class="product-categories">
		<span><?php esc_html_e( 'SKU:', 'crazyblog' ); ?> <span class="sku" itemprop="sku"><?php echo esc_html( ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'crazyblog' )  ); ?></span></span>
	</div>
<?php endif; ?>
<?php echo $product->get_categories( ', ', '<div class="product-categories"><span>' . _n( 'Category:', 'Categories:', $cat_count, 'crazyblog' ) . ' ', '</span></div>' ); ?>
<?php echo $product->get_tags( ', ', '<div class="product-categories"><span>' . _n( 'Tag:', 'Tags:', $tag_count, 'crazyblog' ) . ' ', '</span><div>' ); ?>



