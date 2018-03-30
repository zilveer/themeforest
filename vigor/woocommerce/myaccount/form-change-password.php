<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php wc_print_notices(); ?>

<form action="<?php echo esc_url( get_permalink( wc_get_page_id( 'change_password' ) ) ); ?>" method="post">

	<p class="form-row form-row-first">
                <input type="password" class="input-text placeholder change-pass-field" placeholder="<?php _e( 'New password', 'woocommerce' ); ?>" name="password_1" id="password_1" />
                <input type="password" class="input-text placeholder change-pass-field" placeholder="<?php _e( 'Re-enter new password', 'woocommerce' ); ?>" name="password_2" id="password_2" />
	</p>
	<div class="clear"></div>

	<p><input type="submit" class="button" name="change_password" value="<?php _e( 'Save', 'woocommerce' ); ?>" /></p>

	<?php wp_nonce_field( 'woocommerce-change_password' ); ?>
	<input type="hidden" name="action" value="change_password" />

</form>