<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
$availability = $product->get_availability();
if ($availability['availability']) :
    echo apply_filters( 'woocommerce_stock_html', '<span class="onsale-s ' . esc_attr( $availability['class'] ) . '"><span class="onsale">' . esc_html( __("Out","vbegy") ) . '</span></span>', $availability['availability'] );
endif;
?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale-s"><span class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</span></span>', $post, $product ); ?>

<?php endif; ?>