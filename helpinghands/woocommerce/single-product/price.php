<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="sd-single-product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo $product->get_price_html(); ?></p>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>

<?php
$count   = $product->get_rating_count();
$average = $product->get_average_rating();
?>
<?php if ( $rating_html = $product->get_rating_html() ) : ?>
<div class="sd-single-ratings">
	<span><?php _e( 'ratings', 'sd-framework' ); ?></span>
	<?php echo $rating_html; ?>
</div>
<?php endif; ?>
<div class="clearfix"></div>
