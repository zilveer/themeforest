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

<?php // start: modified by Arlind 
$registration_allowed = get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes';
$registration_allowed = 1;
?>

<div class="section-title">
	<h1><?php
		if ( $registration_allowed ) {
			kalium_woocmmerce_get_i18n_str( 'Login or Register', true );
		} else {
			_e( 'Login', 'woocommerce' );
		}
	?></h1>
	<p><?php kalium_woocmmerce_get_i18n_str( 'Manage your account and see your orders', true ); ?></p>
</div>
<?php // end: modified by Arlind ?>


<?php if ( $registration_allowed ) : ?>

<div class="u-columns col2-set row" id="customer_login">

	<div class="u-column1 col-1<?php echo $registration_allowed ? ' col-md-6' : ''; ?>">

<?php endif; ?>


		<form method="post" class="login message-form">
			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

			<?php // start: modified by Arlind ?>
			<div class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-group absolute">
				<div class="placeholder"><label for="username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label></div>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</div>
			<div class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-group absolute">
				<div class="placeholder"><label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
			</div>
			<?php // end: modified by Arlind ?>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row remember-me-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input class="woocommerce-Input woocommerce-Input--checkbox replaced-checkboxes" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
					
				<label for="rememberme" class="inline">
					<?php _e( 'Remember me', 'woocommerce' ); ?>
				</label>
				
				
			</p>
			<div class="clear"></div>
			
			<input type="submit" class="woocommerce-Button button btn btn-primary" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
			
			<p class="woocommerce-LostPassword lost_password pull-right">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( $registration_allowed ) : ?>

	</div>

	<div class="u-column2 col-2 col-md-6">


		<form method="post" class="register message-form">
			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<div class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-group absolute">
					<div class="placeholder"><label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label></div>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</div>

			<?php endif; ?>

			<div class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-group absolute">
				<div class="placeholder"><label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label></div>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</div>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<div class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-group absolute">
					<div class="placeholder"><label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label></div>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
				</div>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<p class="woocomerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button btn btn-primary" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
