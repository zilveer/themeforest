<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/loop/add-to-cart.php
 * @sub-package WooCommerce/Templates/loop/add-to-cart.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php
global $product;

if ( ! $product->is_purchasable() && ! in_array( $product->product_type, array( 'external', 'grouped' ) ) ) return;
?>

<?php if ( ! $product->is_in_stock() ) : ?>

	<div class="add_to_cart_wrapper product_external">	
		<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="button tertiary"><em class='icon-info'></em> <?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ); ?></a>	
	</div>

<?php else : ?>

	<?php

		switch ( $product->product_type ) {
			case "variable" :
				$link 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'variable_add_to_cart_text', __('Select options', 'woocommerce') );
				$icon = "<em class='icon-cog'></em> ";
				$color = "info";
			break;
			case "grouped" :
				$link 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'grouped_add_to_cart_text', __('View options', 'woocommerce') );
				$icon = "<em class='icon-cog'></em> ";
				$color = "info";
			break;
			case "external" :
				$link 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'external_add_to_cart_text', __('Read More', 'woocommerce') );
				$icon = "<em class='icon-info'></em> ";
				$color = "tertiary";
			break;
			default :
				$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
				$label 	= apply_filters( 'add_to_cart_text', __('Add to cart', 'woocommerce') );
				$icon = "<em class='icon-basket'></em> ";
				$color = "success";
			break;
		}
		
		printf('<div class="add_to_cart_wrapper"><a href="%s" rel="nofollow" data-product_id="%s" class="add_to_cart_button %s button product_type_%s">%s %s</a></div>', $link, $product->id, $color, $product->product_type, $icon, $label);

	?>

<?php endif; ?>