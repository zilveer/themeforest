<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.2.7
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

<form action="" method="post" class="address-form">
	<div class="row">
		<div class="col-md-6">
			
			<h3 class="h4"><?php _e( 'Your details', 'woocommerce' ); ?></h3>
			<div class="row">

			<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

			<p class="form-row form-row-first">
				<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
			</p>
			<p class="form-row form-row-last">
				<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
			</p>
			<p class="form-row form-row-wide">
				<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</p>
		</div>
		</div>
		<div class="col-md-6">
			<fieldset>
				<h3 class="h4"><?php _e( 'Password Change', 'woocommerce' ); ?></h3>
			
				<p class="form-row form-row-thirds">
					<label for="password_current"><?php _e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_current" id="password_current" />
				</p>
				<p class="form-row form-row-thirds">
					<label for="password_1"><?php _e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_1" id="password_1" />
				</p>
				<p class="form-row form-row-thirds">
					<label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_2" id="password_2" />
				</p>
			</fieldset>
		</div>
	</div>
	
<hr/>
	<?php do_action( 'woocommerce_edit_account_form' ); ?>
	<div class="text-right">
	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="button btn btn-sm btn-color" name="save_account_details" value="<?php _e( 'Save changes', 'woocommerce' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p></div>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	
</form>