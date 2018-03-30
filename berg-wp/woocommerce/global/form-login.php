<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) 
	return;
?>
<div>
	<form method="post" class="login col-md-6 checkout-user-form " <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
		<h3 class="h4"><?php _e( 'Login', 'woocommerce' ); ?></h3>
		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<?php if ( $message ) :?>

			<?php echo wpautop( wptexturize( $message ) ); ?>

		<?php endif;?>

			<div class="row">
					<p class="form-row form-row-first">
						<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text form-control" name="username" id="username" />
					</p>
					<p class="form-row form-row-last">
						<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input class="input-text form-control" type="password" name="password" id="password" />
					</p>
			</div>
					<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form' ); ?>
		<p class="form-row">
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<input type="submit" class="button btn btn-md btn-color pull-right" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
			<label for="rememberme" class="inline">
				<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
			</label>
		</p>
		<p class="lost_password">
			<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
		</p>
		<div class="clearfix"></div>

		<?php do_action( 'woocommerce_login_form_end' ); ?>


	</form>

	<?php if ( get_option( 'woocommerce_enable_signup_and_login_from_checkout' ) === 'yes' ) : ?>

		<form method="post" class="checkout-user-form register login col-md-4 col-md-offset-2" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
		<h3 class="h4"><?php _e( 'Register', 'woocommerce' ); ?></h3>
			<div class="row">
			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-row form-row-wide">
					<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</p>

			<?php endif; ?>

			<p class="form-row form-row-wide">
				<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="form-row form-row-wide">
					<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="input-text form-control" name="password" id="reg_password" />
				</p>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>
			
			<p class="form-row col-md-12 clearfix">
				<?php wp_nonce_field( 'woocommerce-register' ); ?>
				<input type="submit" class="button btn btn-md btn-color pull-right" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
			</p>
			
			<?php do_action( 'woocommerce_register_form_end' ); ?>
			</div>
		</form>

	<?php endif; ?>
</div>