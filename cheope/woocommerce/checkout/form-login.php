<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( yit_get_option('shop-checkout-multistep') ) {
    $checkout = WC()->checkout;
    remove_action( 'woocommerce_checkout_process', array( $checkout,'checkout_process' ) );
    remove_action( 'woocommerce_checkout_billing', array( $checkout,'checkout_form_billing' ) );
    remove_action( 'woocommerce_checkout_shipping', array( $checkout,'checkout_form_shipping' ) );
}

if ( is_user_logged_in() || ! WC()->checkout->enable_signup ) return;

$info_message = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'yit' ) );
?>

<?php if( !yit_get_option('shop-checkout-multistep') ): ?>
<p class="woocommerce_info"><?php echo $info_message; ?> <a href="#" class="showlogin"><?php _e('Click here to login', 'yit'); ?></a></p>

<?php woocommerce_login_form( array( 'message' => __('If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'yit'), 'redirect' => get_permalink(wc_get_page_id('checkout')) ) ); ?>

<?php else: ?>
<div class="step1_login_form span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 6 : 9 ?>">
		<h3><?php _e('Login', 'yit'); ?></h3>

		<form method="post" class="login_checkout">
			<p class="form-row form-row-first">
				<label for="username"><?php _e('Username or email', 'yit'); ?> <span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" />
			</p>
			<p class="form-row form-row-last">
				<label for="password"><?php _e('Password', 'yit'); ?> <span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" />
			</p>
			<div class="clear"></div>

			<p class="form-row">
				<?php wp_nonce_field('woocommerce-login') ?>
				<input type="hidden" name="redirect" value="<?php echo get_permalink(wc_get_page_id('checkout')) ?>" />
				<input type="submit" class="button" name="login" value="<?php _e('Login', 'yit'); ?>" />
				<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e('Lost Password?', 'yit'); ?></a>
			</p>
		</form>
</div>

<div class="step1_create_account span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 6 : 9 ?>">

		<h3><?php printf( __('<span>First time on %s?</span> Create an account.', 'yit'), apply_filters( 'yit_wc_registration_form_bloginfo', yit_decode_title(get_bloginfo()) )); ?></h3>
		<form method="post" id="form-login" class="register">

			<?php if ( get_option( 'woocommerce_registration_generate_username' ) == 'no' ) : ?>

				<p class="form-row form-row-first">
					<label for="reg_username"><?php _e('Username', 'yit'); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
				</p>

				<p class="form-row form-row-last">

			<?php else : ?>

				<p class="form-row form-row-wide">

			<?php endif; ?>

				<label for="reg_email"><?php _e('Email', 'yit'); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
			</p>

			<div class="clear"></div>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                <p class="form-row form-row-first">
                    <label for="reg_password"><?php _e('Password', 'yit'); ?> <span class="required">*</span></label>
                    <input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
                </p>
                <p class="form-row form-row-last">
                    <label for="reg_password2"><?php _e('Re-enter password', 'yit'); ?> <span class="required">*</span></label>
                    <input type="password" class="input-text form-control" name="password2" id="reg_password_retype" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
                </p>
            <?php endif; ?>

			<div class="clear"></div>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" /></div>

			<?php do_action( 'register_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field('woocommerce-register') ?>

				<input type="hidden" name="yit_checkout" value="true" />
				<input type="submit" class="button" name="register" value="<?php _e('Register', 'yit'); ?>" />
			</p>

		</form>

</div>
<?php

endif;

if( yit_get_option('shop-checkout-multistep') ) {
    add_action( 'woocommerce_checkout_process', array( $checkout,'checkout_process' ) );
    add_action( 'woocommerce_checkout_billing', array( $checkout,'checkout_form_billing' ) );
    add_action( 'woocommerce_checkout_shipping', array( $checkout,'checkout_form_shipping' ) );
}