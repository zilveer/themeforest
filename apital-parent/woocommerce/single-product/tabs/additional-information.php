<?php
/**
 * Additional Information tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'woocommerce' ) );

?>

<?php if ( $heading ): ?>
    <div class="tittle-line">
        <h5><?php echo esc_html($heading); ?></h5>
        <div class="divider-1 small">
            <div class="divider-small"></div>
        </div>
    </div>
<?php endif; ?>

<?php $product->list_attributes(); ?>
