<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $venedor_woo_version;

if (version_compare($venedor_woo_version, '2.6', '<'))
    wc_print_notices(); 

do_action( 'woocommerce_before_edit_account_form' );
?>

<form action="" method="post" class="woocommerce-EditAccountForm edit-account">

    <?php do_action( 'woocommerce_edit_account_form_start' ); ?>

    <p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first input-field">
        <label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
    <p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last input-field">
        <label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
	</p>
    <div class="clear"></div>

    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide input-field">
        <label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>

    <fieldset>
        <legend><?php _e( 'Password Change', 'woocommerce' ); ?></legend>

        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide input-field">
            <label for="password_current"><?php _e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" />
        </p>
        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide input-field">
            <label for="password_1"><?php _e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" />
        </p>
        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide input-field">
            <label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" />
        </p>
    </fieldset>
    <div class="clear"></div>

    <?php do_action( 'woocommerce_edit_account_form' ); ?>

    <p>
        <?php wp_nonce_field( 'save_account_details' ); ?>
        <input type="submit" class="woocommerce-Button button pt-right" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
        <input type="hidden" name="action" value="save_account_details" />
    </p>

    <?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>