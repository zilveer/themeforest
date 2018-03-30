<?php
/**
 * Thankyou page
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $sitepress;

$is_wpml_active = ( isset( $sitepress ) && ! empty( $sitepress ) );

if ( $is_wpml_active ) {

    $unfortunately_your = yit_icl_translate( 'theme', 'yit', 'thankyou-order-declined-transaction', 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.' );
    $please_att         = yit_icl_translate( 'theme', 'yit', 'thankyou-attempt-purchase-my-account', 'Please attempt your purchase again or go to your account page.' );
    $please_att2        = yit_icl_translate( 'theme', 'yit', 'thankyou-attempt-purchase', 'Please attempt your purchase again.' );
    $thank_you_your     = yit_icl_translate( 'theme', 'yit', 'thankyou-order-received', 'Thank you. Your order has been received.' );
    $payment_fix        = yit_icl_translate( 'theme', 'yit', 'thankyou-payment-method', 'Payment method' );
    $order_fix          = yit_icl_translate( 'theme', 'yit', 'thankyou-order', 'Order:' );
    $date_fix           = yit_icl_translate( 'theme', 'yit', 'thankyou-date', 'Date:' );
    $total_fix          = yit_icl_translate( 'theme', 'yit', 'thankyou-total', 'Total:' );

} else {

    $unfortunately_your = __( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'yit' );
    $please_att         = __( 'Please attempt your purchase again or go to your account page.', 'yit' );
    $please_att2        = __( 'Please attempt your purchase again.', 'yit' );
    $thank_you_your     = __( 'Thank you. Your order has been received.', 'yit' );
    $payment_fix        = __( 'Payment method', 'yit' );
    $order_fix          = __( 'Order:', 'yit' );
    $date_fix           = __( 'Date:', 'yit' );
    $total_fix          = __( 'Total:', 'yit' );

}

?>

<?php if ( $order ) : ?>

    <?php if ( in_array( $order->status, array( 'failed' ) ) ) : ?>

        <p><?php echo $unfortunately_your; ?></p>

        <p><?php
            if ( is_user_logged_in() ) :
                echo $please_att;
            else :
                echo $please_att2;
            endif;
            ?></p>

        <p>
            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'yit' ) ?></a>
            <?php if ( is_user_logged_in() ) : ?>
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', 'yit' ); ?></a>
            <?php endif; ?>
        </p>

    <?php else : ?>

        <p><?php echo $thank_you_your; ?></p>

        <table class="shop_table thankyou">
            <thead>
            <tr>
                <th><?php echo $order_fix; ?></th>
                <th><?php echo $date_fix; ?></th>
                <th><?php echo $total_fix; ?></th>
                <?php if ( $order->payment_method_title ) : ?>
                    <th><?php echo $payment_fix; ?></th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $order->get_order_number(); ?></td>
                <td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
                <td><?php echo $order->get_formatted_order_total(); ?></td>
                <?php if ( $order->payment_method_title ) : ?>
                    <td><?php echo $order->payment_method_title; ?></td>
                <?php endif; ?>
            </tr>
            </tbody>
        </table>
        <div class="clear"></div>

        <?php
        /*
        <ul class="order_details">
            <li class="order">
                <?php _e('Order:', 'yit'); ?>
                <strong><?php echo $order->get_order_number(); ?></strong>
            </li>
            <li class="date">
                <?php _e('Date:', 'yit'); ?>
                <strong><?php echo date_i18n(get_option('date_format'), strtotime($order->order_date)); ?></strong>
            </li>
            <li class="total">
                <?php _e('Total:', 'yit'); ?>
                <strong><?php echo $order->get_formatted_order_total(); ?></strong>
            </li>
            <?php if ($order->payment_method_title) : ?>
            <li class="method">
                <?php _e('Payment method:', 'yit'); ?>
                <strong><?php
                    echo $order->payment_method_title;
                ?></strong>
            </li>
            <?php endif; ?>
        </ul>
        <div class="clear"></div>
        */
        ?>

    <?php endif; ?>

    <?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
    <?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

    <p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', $thank_you_your, null ); ?></p>

<?php endif; ?>