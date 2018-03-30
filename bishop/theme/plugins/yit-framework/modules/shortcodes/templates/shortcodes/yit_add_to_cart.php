<?php

global $woocommerce, $product;

$id = ( isset($id) ) ? (int) $id : '';

$product = function_exists( ' get_product' ) ? get_product( $id ) : wc_get_product( $id ) ;
if (! is_object( $product) || ! $product->is_purchasable() ) return;

$btn_added_classes = apply_filters( 'yit_sc_add_to_cart_btn_classes','' );

?>

<div class="woocommerce sc_add_to_cart <?php esc_attr( $vc_css ) ?>">

	<?php if ( $product->is_in_stock() ) : ?>
		<?php if ( $product->is_type('simple') ) : ?>
			<?php woocommerce_simple_add_to_cart(); ?>

		<?php elseif( $product->is_type( 'variable' ) ) : ?>

			<?php woocommerce_variable_add_to_cart() ?>

		<?php endif; ?>
	<?php endif; ?>
</div>