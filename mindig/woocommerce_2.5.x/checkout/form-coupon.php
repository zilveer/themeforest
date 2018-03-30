<?php
/**
 * Checkout coupon form
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! wc_coupons_enabled() ) {
    return;
}

?>

<div class="coupon-form-checkout">

    <?php
    $info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'yit' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'yit' ) . '</a>' );
    wc_print_notice( $info_message, 'notice' );
    ?>

    <form class="checkout_coupon" method="post" style="display:none">

        <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'yit' ); ?>" id="coupon_code" value="" />
        </p>

        <p class="form-row form-row-last">
            <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'yit' ); ?>" />
        </p>

        <div class="clear"></div>
    </form>

</div>