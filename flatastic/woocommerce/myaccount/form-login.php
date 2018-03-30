<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="tabs-holder">

	<ul class="tabs-nav">

		<li class="active"><a href="#"><?php _e('Login', 'flatastic') ?></a></li>

		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
			<li><a data-type-form="register" href="#"><?php _e('Register', 'flatastic') ?></a></li>
		<?php endif; ?>

	</ul><!--/ .tabs-nav-->

	<div class="tabs-container">

		<div class="tab-content">

			<div class="col-2">

				<h3 class="form-field-title"><?php _e( 'Login', 'flatastic' ); ?></h3>

				<form method="post" class="login clearfix">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
						<label for="username"><?php _e( 'Username or email address', 'flatastic' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>
					<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
						<label for="password"><?php _e( 'Password', 'flatastic' ); ?> <span class="required">*</span></label>
						<input class="input-text" type="password" name="password" id="password" />
						<span class="lost_password">
							<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'flatastic' ); ?></a>
						</span>
					</p>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<p class="form-row">
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
						<label for="rememberme" class="woocommerce-Input woocommerce-Input--checkbox"><?php _e( 'Remember me', 'flatastic' ); ?></label>
					</p>

					<p class="form-row">
						<input type="submit" class="woocommerce-Button button" name="login" value="<?php _e( 'Login', 'flatastic' ); ?>" />
					</p>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>

			</div><!--/ .col-2-->

		</div><!--/ .tab-content-->

		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

			<div class="tab-content">

				<div class="col-2" id="customer_login">

					<h3 class="form-field-title"><?php _e( 'Register', 'flatastic' ); ?></h3>

					<form method="post" class="register clearfix">

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

							<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
								<label for="reg_username"><?php _e( 'Username', 'flatastic' ); ?> <span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
							</p>

						<?php endif; ?>

						<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
							<label for="reg_email"><?php _e( 'Email address', 'flatastic' ); ?> <span class="required">*</span></label>
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
						</p>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<p class="form-row form-row-wide">
								<label for="reg_password"><?php _e( 'Password', 'flatastic' ); ?> <span class="required">*</span></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
							</p>

						<?php endif; ?>

						<!-- Spam Trap -->
						<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'flatastic' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

						<?php do_action( 'woocommerce_register_form' ); ?>
						<?php do_action( 'register_form' ); ?>

						<p class="woocomerce-FormRow form-row">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<input type="submit" class="woocommerce-Button button" name="register" value="<?php _e( 'Register', 'flatastic' ); ?>" />
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>

				</div><!--/ .col-2-->

			</div><!--/ .tab-content-->

		<?php endif; ?>

	</div><!--/ .tabs-container-->

</div><!--/ .tabs-holder-->

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
