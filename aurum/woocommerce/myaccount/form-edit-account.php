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
	exit;
}

do_action( 'woocommerce_before_edit_account_form' ); ?>

<?php // start: modified by Arlind ?>
<div class="page-title">
	<h2>
		<?php _e('Edit Account <small>Change your name, email or password</small>', 'aurum'); ?>
	</h2>
</div>
<?php // end: modified by Arlind ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<?php // start: modified by Arlind ?>
	<fieldset>
		<legend class="no-top-margin"><?php _e( 'Name and Email', 'aurum' ); ?></legend>
		
		<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="account_first_name" id="account_first_name" placeholder="<?php _e( 'First name', 'woocommerce' ); ?> *" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p>
		<p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="account_last_name" id="account_last_name" placeholder="<?php _e( 'Last name', 'woocommerce' ); ?> *" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</p>
		<div class="clear"></div>
	
		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
			<input type="email" class="woocommerce-Input woocommerce-Input--email input-text form-control" name="account_email" id="account_email" placeholder="<?php _e( 'Email address', 'woocommerce' ); ?> *" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</p>
	
	</fieldset>

	<fieldset>
		<legend><?php _e( 'Password Change', 'woocommerce' ); ?></legend>

		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-control" placeholder="<?php _e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?>" name="password_current" id="password_current" />
		</p>
		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-control" placeholder="<?php _e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?>" name="password_1" id="password_1" />
		</p>
		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-control" placeholder="<?php _e( 'Confirm New Password', 'woocommerce' ); ?>" name="password_2" id="password_2" />
		</p>
	</fieldset>
	<div class="clear"></div>
	<?php // end: modified by Arlind ?>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<?php // start: modified by Arlind ?>
		<input type="submit" class="woocommerce-Button button btn btn-primary" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
		<?php // end: modified by Arlind ?>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
