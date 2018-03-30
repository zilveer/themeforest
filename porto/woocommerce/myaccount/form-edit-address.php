<?php
/**
 * Edit address form
 *
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$page_title = ( $load_address === 'billing' ) ? __( 'Billing Address', 'woocommerce' ) : __( 'Shipping Address', 'woocommerce' );

if (version_compare(porto_get_woo_version_number(), '2.5.1', '<')) {
    global $current_user;
    get_currentuserinfo();
}
$porto_woo_version = porto_get_woo_version_number();

if (version_compare($porto_woo_version, '2.6', '<'))
    wc_print_notices();

do_action( 'woocommerce_before_edit_account_address_form' );
?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

    <?php if (version_compare($porto_woo_version, '2.6', '<')) : ?>
    <div class="featured-box align-left">
        <div class="box-content">
    <?php endif; ?>

    <form method="post">

        <h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>

        <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

        <?php foreach ( $address as $key => $field ) : ?>

            <?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

        <?php endforeach; ?>

        <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

        <p class="clearfix">
            <input type="submit" class="button btn-lg pt-right" name="save_address" value="<?php esc_attr_e( 'Save Address', 'woocommerce' ); ?>" />
            <?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
            <input type="hidden" name="action" value="edit_address" />
        </p>

    </form>

    <?php if (version_compare($porto_woo_version, '2.6', '<')) : ?>
        </div>
    </div>
    <?php endif; ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>


