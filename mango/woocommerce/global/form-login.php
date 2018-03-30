<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}
?>
<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
	<?php do_action( 'woocommerce_login_form_start' ); ?>
	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
	<p class="form-row form-group form-row-first">
		<label class="input-desc" for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text form-control" name="username" id="username" />
	</p>
	<p class="form-row form-group form-row-last">
		<label class="input-desc" for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input class="input-text form-control" type="password" name="password" id="password" />
	</p>
	<div class="clear"></div>
	<?php do_action( 'woocommerce_login_form' ); ?>
	<p class="form-row form-group">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<input type="submit" class="button btn btn-custom2 min-width-sm" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
        <label for="rememberme" class="inline custom-checkbox-wrapper">
                            <span class="custom-checkbox-container">
                                <input type="checkbox" name="rememberme"id="rememberme" value="forever">
                                <span class="custom-checkbox-icon"></span>
                            </span>
            <span> <?php _e( 'Remember me', 'woocommerce' ); ?></span>
        </label>
	</p>
	<p class="lost_password">
		<a class="helper-link" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>
	<div class="clear"></div>
	<?php do_action( 'woocommerce_login_form_end' ); ?>
</form>