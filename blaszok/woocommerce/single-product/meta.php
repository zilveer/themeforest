<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $mpcth_options, $post, $product;

$sku = isset( $mpcth_options[ 'mpcth_disable_sku' ] ) ? $mpcth_options[ 'mpcth_disable_sku' ] : false;
$categories = isset( $mpcth_options[ 'mpcth_disable_categories' ] ) ? $mpcth_options[ 'mpcth_disable_categories' ] : false;
$tags = isset( $mpcth_options[ 'mpcth_disable_tags' ] ) ? $mpcth_options[ 'mpcth_disable_tags' ] : false;

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( !$sku && wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'n/a', 'woocommerce' ); ?></span>.</span>
	<?php endif; ?>

	<?php if( !$categories ) : ?>
		<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'woocommerce' ) . ' ', '</span>' ); ?>
	<?php endif; ?>
		
	<?php if( !$tags ) : ?>
		<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', sizeof( get_the_terms( $post->ID, 'product_tag' ) ), 'woocommerce' ) . ' ', '</span>' ); ?>
	<?php endif; ?>	
		
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>