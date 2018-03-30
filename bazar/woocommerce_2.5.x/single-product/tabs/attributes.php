<?php
/**
 * Attributes tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $post, $product;

$show_attr = ( get_option( 'woocommerce_enable_dimension_product_attributes' ) == 'yes' ? true : false );

if ( $product->has_attributes() || ( $show_attr && $product->has_dimensions() ) || ( $show_attr && $product->has_weight() ) ) {
	?>

		<?php $heading = apply_filters('woocommerce_product_additional_information_heading', __('Additional Information', 'yit') ); ?>

		<?php if( ! empty( $heading ) ): ?>
			<h2><?php echo $heading; ?></h2>
		<?php endif; ?>

		<?php $product->list_attributes(); ?>

	<?php
}
?>