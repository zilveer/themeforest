<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );

?>

<?php if ( $heading ): ?>
    <div class="tittle-line title-line-description">
        <h5><?php echo esc_html($heading); ?></h5>
        <div class="divider-1 small">
            <div class="divider-small"></div>
        </div>
    </div>
<?php endif; ?>

<?php the_content(); ?>
