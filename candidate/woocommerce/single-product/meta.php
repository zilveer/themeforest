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

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>


	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<p class="animate-onscroll"><?php _e( 'SKU:', 'candidate' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'candidate' ); ?></span>.</p>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<p class="animate-onscroll">' . _n( 'Category:', 'Categories:', $cat_count, 'candidate' ) . ' ', '.</p>' ); ?>

	<?php echo $product->get_tags( ', ', '<p class="animate-onscroll">' . _n( 'Tag:', 'Tags:', $tag_count, 'candidate' ) . ' ', '.</p>' ); ?>

		<ul class="social-share animate-onscroll">	
			<li><?php _e( 'Share this:', 'candidate' ); ?></li>
			<li class="facebook"><a href="#" class="tooltip-ontop" title="Facebook"><i class="icons icon-facebook"></i></a></li>
			<li class="twitter"><a href="#" class="tooltip-ontop" title="Twitter"><i class="icons icon-twitter"></i></a></li>
			<li class="google"><a href="#" class="tooltip-ontop" title="Google Plus"><i class="icons icon-gplus"></i></a></li>
			<li class="pinterest"><a href="#" class="tooltip-ontop" title="Pinterest"><i class="icons icon-pinterest-3"></i></a></li>
			<li class="email"><a href="#" class="tooltip-ontop" title="Email"><i class="icons icon-mail"></i></a></li>
		</ul>
	
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

