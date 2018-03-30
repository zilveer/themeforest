<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
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
	<div class="row">
		<div class="small-12 medium-6 columns">
			<label for="username"><?php _e( 'Username or email', 'north' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text full" name="username" id="username" />
		</div>
		<div class="small-12 medium-6 columns">
			<label for="password"><?php _e( 'Password', 'north' ); ?> <span class="required">*</span></label>
			<input class="input-text full" type="password" name="password" id="password" />
		</div>
	
		<?php do_action( 'woocommerce_login_form' ); ?>
	
		<div class="small-12 columns">
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check"/><label for="rememberme" class="custom_label"><?php _e( 'Remember me', 'north' ); ?></label>
			<input type="submit" class="button outline login_button" name="login" value="<?php _e( 'Login', 'north' ); ?>" /><a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="lost_password"><?php _e( 'Lost your password?', 'north' ); ?></a>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
			
		</div>
	</div>
	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>