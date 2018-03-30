<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() )
	return;
?>
<div class="login-form-env"<?php if ( $hidden ) echo ' style="display:none;"'; ?>>
	<div class="bordered-block">
		<h2><?php echo _e('Log in', 'aurum'); ?></h2>

		<form method="post" class="login">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

			<p class="form-row form-row-first form-group">
				<input type="text" class="input-text form-control" name="username" id="username" placeholder="<?php _e( 'Username or email', 'aurum' ); ?>" />
			</p>
			<p class="form-row form-row-last form-group">
				<input class="input-text form-control" type="password" name="password" id="password" placeholder="<?php _e( 'Password', 'aurum' ); ?>" />
			</p>
			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row form-group">

				<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="replaced-checkboxes" />

				<label for="rememberme" class="inline">
					<?php _e( 'Remember me', 'aurum' ); ?>
				</label>
			</p>

			<p class="form-row form-group">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<input type="submit" class="button btn btn-primary" name="login" value="<?php _e( 'Login', 'aurum' ); ?>" />
				<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />


				<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="lost-password pull-right"><?php _e( 'Lost your password?', 'aurum' ); ?></a>
			</p>

			<div class="clear"></div>



			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
	</div>
</div>