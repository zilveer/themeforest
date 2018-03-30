<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $venedor_woo_version;

wc_print_notices();

if (version_compare($venedor_woo_version, '2.6', '>=')) {
    /**
     * My Account navigation.
     *
     * @since 2.6.0
     */
    do_action( 'woocommerce_account_navigation' );
}
?>
<?php if (version_compare($venedor_woo_version, '2.6', '>=')) : ?>

    <div class="woocommerce-MyAccount-content">
        <?php
        /**
         * My Account content.
         * @since 2.6.0
         */
        do_action( 'woocommerce_account_content' );
        ?>
    </div>

<?php else : ?>

<p class="myaccount_user">
	<?php
	printf(
		__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
		$current_user->display_name,
        ( version_compare($venedor_woo_version, '2.3', '<') ? wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) : wc_get_endpoint_url( 'customer-logout', '', get_permalink( wc_get_page_id( 'myaccount' ) ) ))
	);

	printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	);
	?>
</p>

<?php endif; ?>