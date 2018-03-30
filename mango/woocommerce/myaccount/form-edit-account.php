<?php

/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



?>



<?php wc_print_notices(); ?>



<form action="" method="post">



	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>



	<p class="form-row input-group form-row-first">

		<label class="input-desc" for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>

		<input type="text" class="input-text form-control" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />

	</p>

	<p class="form-row input-group form-row-last">

		<label class="input-desc" for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>

		<input type="text" class="input-text form-control" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />

	</p>

	<div class="clear"></div>



	<p class="form-row input-group form-row-wide">

		<label class="input-desc" for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>

		<input type="email" class="input-text form-control" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />

	</p>



	<fieldset>

		<legend><?php _e( 'Password Change', 'woocommerce' ); ?></legend>



		<p class="form-row input-group form-row-wide">

			<label class="input-desc" for="password_current"><?php _e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>

			<input type="password" class="input-text form-control" name="password_current" id="password_current" />

		</p>

		<p class="form-row input-group form-row-wide">

			<label class="input-desc" for="password_1"><?php _e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>

			<input type="password" class="input-text form-control" name="password_1" id="password_1" />

		</p>

		<p class="form-row input-group form-row-wide">

			<label class="input-desc" for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>

			<input type="password" class="input-text form-control" name="password_2" id="password_2" />

		</p>

	</fieldset>

	<div class="clear"></div>



	<?php do_action( 'woocommerce_edit_account_form' ); ?>



	<p class="input-group">

		<?php wp_nonce_field( 'save_account_details' ); ?>

		<input type="submit" class="button  btn btn-custom2 min-width" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />

		<input type="hidden" name="action" value="save_account_details" />

	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</form>