<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * @version   2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$porto_woo_version = porto_get_woo_version_number();

if (version_compare($porto_woo_version, '2.6', '<'))
    wc_print_notices();
?>
<?php if (version_compare($porto_woo_version, '2.6', '>=')) : ?>
    <p class="order-info m-b-lg"><?php
        printf(
            __( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce' ),
            '<mark class="order-number">' . $order->get_order_number() . '</mark>',
            '<mark class="order-date">' . date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ) . '</mark>',
            '<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>'
        );
        ?></p>
<?php else : ?>
    <p class="order-info alert alert-info m-b-lg"><?php printf( __( 'Order #<mark class="order-number">%s</mark> was placed on <mark class="order-date">%s</mark> and is currently <mark class="order-status">%s</mark>.', 'woocommerce' ), $order->get_order_number(), date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), wc_get_order_status_name( $order->get_status() ) ); ?></p>
<?php endif; ?>

<?php if ( $notes = $order->get_customer_order_notes() ) : ?>
    <?php if (version_compare($porto_woo_version, '2.6', '<')) : ?>
    <div class="featured-box align-left">
        <div class="box-content">
    <?php endif; ?>

    <h2><?php _e( 'Order Updates', 'woocommerce' ); ?></h2>
    <ol class="woocommerce-OrderUpdates commentlist notes">
        <?php foreach ( $notes as $note ) : ?>
        <li class="woocommerce-OrderUpdate comment note">
            <div class="woocommerce-OrderUpdate-inner comment_container">
                <div class="woocommerce-OrderUpdate-text comment-text">
                    <p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
                    <div class="woocommerce-OrderUpdate-description description">
                        <?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </li>
        <?php endforeach; ?>
    </ol>

    <?php if (version_compare($porto_woo_version, '2.6', '<')) : ?>
        </div>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order_id ); ?>