<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>

<div class="bordered-block">

	<form method="post" class="woocommerce-ResetPassword lost_reset_password login message-form">
		
		<h2><?php kalium_woocmmerce_get_i18n_str( 'Reset Password' ); ?></h2>
	
		<p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce') ); ?></p>
	
		<div class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first form-group absolute">
			<div class="placeholder"><label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" />
		</div>
		<div class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last form-group absolute">
			<div class="placeholder"><label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" />
		</div>
	
		<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
		<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />
	
		<div class="clear"></div>
	
		<?php do_action( 'woocommerce_resetpassword_form' ); ?>
	
		<p class="woocommerce-FormRow form-row">
			<input type="hidden" name="wc_reset_password" value="true" />
			<input type="submit" class="woocommerce-Button button btn btn-primary" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>" />
		</p>
	
		<?php wp_nonce_field( 'reset_password' ); ?>
	
	</form>

</div>
