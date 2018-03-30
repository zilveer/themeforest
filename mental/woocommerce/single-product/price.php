<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><span class="price-title"><?php _e('Price:', 'mental'); ?></span> <?php echo wp_kses( $product->get_price_html(), mental_allowed_tags() ); ?></p>

	<meta itemprop="price" content="<?php echo esc_attr($product->get_price()); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr(get_woocommerce_currency()); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo ( $product->is_in_stock() ) ? 'InStock' : 'OutOfStock'; ?>" />

</div>