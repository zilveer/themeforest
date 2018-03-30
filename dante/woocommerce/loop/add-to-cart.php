<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>

<?php if ( ! $product->is_in_stock() ) : ?>

	<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class=""><i class="ss-info"></i><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'swiftframework' ) ); ?></span></a>
	<?php echo sf_wishlist_button(); ?>
	
<?php else : ?>

	<?php
		$link = array(
			'url'   => '',
			'label' => '',
			'class' => '',
			'icon' => ''
		);

		$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

		switch ( $handler ) {
			case "variable" :
				$link['url'] 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
				$link['label'] 	= '<i class="ss-sugarpackets"></i><span>' . apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'swiftframework' ) ) . '</span>';
			break;
			case "grouped" :
				$link['url'] 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
				$link['label'] 	= '<i class="ss-sugarpackets"></i><span>' . apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'swiftframework' ) ) . '</span>';
			break;
			case "external" :
				$link['url'] 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
				$link['label'] 	= '<i class="ss-info"></i><span>' . apply_filters( 'external_add_to_cart_text', __( 'Read More', 'swiftframework' ) ) . '</span>';
			break;
			default :
				if ( $product->is_purchasable() ) {
					$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
					$link['label'] 	= '<i class="ss-cart"></i><span>' . apply_filters( 'add_to_cart_text', __( 'Add to shopping bag', 'swiftframework' ) ) . '</span>';
					$link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
				} else {
					$link['url'] 	= apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
					$link['label'] 	= '<i class="ss-info"></i><span>' . apply_filters( 'not_purchasable_text', __( 'Read More', 'swiftframework' ) ) . '</span>';
				}
			break;
		}
		
		$added_text = __( 'Item added to bag', 'swiftframework' );

		echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s"  data-added_text="%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), $added_text, $link['label'] ), $product, $link);
		
		echo sf_wishlist_button();
		
	?>

<?php endif; ?>
