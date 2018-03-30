<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php //if ( is_shop_enabled() && yit_get_option('shop-detail-add-to-cart') ): ?>
    <?php do_action('woocommerce_before_add_to_cart_button'); ?>
    <div class="woocommerce-price-and-add group">
        <?php if( yit_get_option('shop-detail-show-price') ): ?>
            <div class="woocommerce-price"><?php wc_get_template( 'single-product/price.php' ); ?></div>
        <?php endif ?>
        <p class="cart"><a href="<?php echo $product_url; ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', $button_text, 'external'); ?></a></p>
    </div>

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>
<?php //endif ?>
