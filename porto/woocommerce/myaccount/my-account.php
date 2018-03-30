<?php
/**
 * My Account page
 *
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$porto_woo_version = porto_get_woo_version_number();

wc_print_notices();

if (version_compare($porto_woo_version, '2.6', '>=')) {
    /**
     * My Account navigation.
     *
     * @since 2.6.0
     */
    do_action( 'woocommerce_account_navigation' );
}
?>
<?php if (version_compare($porto_woo_version, '2.6', '>=')) : ?>

    <div class="woocommerce-MyAccount-content">
        <div class="featured-box align-left">
            <div class="box-content">

                <?php
                /**
                 * My Account content.
                 * @since 2.6.0
                 */
                do_action( 'woocommerce_account_content' );
                ?>

            </div>
        </div>
    </div>

<?php else : ?>

    <p class="myaccount_user alert alert-success m-b-lg">
        <?php
        printf(
            __( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
            $current_user->display_name,
            wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
        );

        printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
            wc_customer_edit_account_url()
        );
        ?>
    </p>

    <?php do_action( 'woocommerce_before_my_account' ); ?>

    <?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

    <?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

    <?php wc_get_template( 'myaccount/my-address.php' ); ?>

    <?php do_action( 'woocommerce_after_my_account' ); ?>

<?php endif; ?>
