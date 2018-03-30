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
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
<?php if (jwOpt::get_option('woo_skus', '1') == '1') { ?>
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<span itemprop="productID" class="sku_wrapper"><?php _e( 'SKU:', 'jawtemplates' ); ?> <span class="sku" itemprop="sku"><?php echo $product->get_sku(); ?></span></span>
	<?php endif; ?>
<?php } ?>

	<?php
	if (jwOpt::get_option('woo_single_product_categories', '1') == '1') {
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $size, 'jawtemplates' ) . ' ', '</span>' );
	}
	?>

	<?php if (jwOpt::get_option('woo_product_tags', '1') == '1') {
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'jawtemplates' ) . ' ', '</span>' );}
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>