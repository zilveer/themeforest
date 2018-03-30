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

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="col2-set row" id="customer_login">

	<div class="col-1 col-md-6">

<?php endif; ?>

		<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

		<form method="post" class="login">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="form-row form-group form-row-wide">

				<label class="input-desc" for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>

				<input type="text" class="input-text form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />

			</p>

			<p class="form-row form-group form-row-wide">

				<label class="input-desc" for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>

				<input class="input-text form-control" type="password" name="password" id="password" />

			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row form-group">

				<?php wp_nonce_field( 'woocommerce-login' ); ?>

				<input type="submit" class="button btn btn-custom2" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />

                <label for="rememberme" class="inline checkbox-inline custom-checkbox-wrapper">

                            <span class="custom-checkbox-container">

            					<input name="rememberme" type="checkbox" id="rememberme" value="forever" />

                                <span class="custom-checkbox-icon"></span>

                            </span><span><?php _e( 'Remember me', 'woocommerce' ); ?></span>

                </label>

			</p>

			<p class="lost_password">

				<a class="btn btn-custom3" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>

			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="col-2 col-md-6">

		<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="register">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-row form-group form-row-wide">

					<label class="input-desc" for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>

					<input type="text" class="input-text form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />

				</p>

			<?php endif; ?>

			<p class="form-row form-group form-row-wide">

				<label class="input-desc" for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>

				<input type="email" class="input-text form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />

			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="form-row form-group form-row-wide">

					<label class="input-desc" for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>

					<input type="password" class="input-text form-control" name="password" id="reg_password" />

				</p>

			<?php endif; ?>

			<!-- Spam Trap -->

			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;">

                <label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label>

                <input type="text" name="email_2" id="trap" tabindex="-1" />

            </div>



			<?php do_action( 'woocommerce_register_form' ); ?>

			<?php do_action( 'register_form' ); ?>



			<p class="form-row form-group">

				<?php wp_nonce_field( 'woocommerce-register' ); ?>

				<input type="submit" class="button btn btn-custom" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />

			</p>



			<?php do_action( 'woocommerce_register_form_end' ); ?>



		</form>

	</div>

    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>