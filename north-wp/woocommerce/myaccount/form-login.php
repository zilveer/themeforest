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

<?php do_action('woocommerce_before_customer_login_form'); ?>

<div class="my_woocommerce_page page-padding">
	<div class="row" id="customer_login">
		<?php wc_print_notices();  ?>
		<div class="small-12 small-centered  medium-10 large-8 columns">
			<div class="thb_tabs full <?php if (get_option('woocommerce_enable_myaccount_registration')!=='yes') : ?>center<?php endif; ?>" data-interval="0">
				<dl class="tabs cf">
					<dd>
						<a href="#" class="active" id="login-account"><?php _e( 'Login','north' ); ?></a>
					</dd>
					<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
					<dd>
						<a href="#" id="create-account"><?php _e( 'Register','north' ); ?></a>
					</dd>
					<?php endif; ?>
				</dl>
				<ul class="tabs-content cf">	
					<li class="active login-container">
						<div class="small-12 medium-8 small-centered columns">
							<h3><?php _e( "I'm an existing customer and <br>would like to login." ,'north' ); ?></h3>
							<form method="post" class="login row text-center">
							<?php do_action( 'woocommerce_login_form_start' ); ?>
							<div class="small-12 columns">
								<label for="username"><?php _e( 'Username or email','north' ); ?> <span class="required">*</span></label>
								<input type="text" class="input-text full" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>"/>
							</div>
							<div class="small-12 columns">
								<label for="password"><?php _e( 'Password','north' ); ?> <span class="required">*</span></label>
								<input class="input-text full" type="password" name="password" id="password" />
							</div>
							<div class="small-6 columns">
								<div class="remember">
									<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check"/> <label for="rememberme" class="checkbox custom_label"><?php _e( 'Remember me','north' ); ?></label>
								</div>
							</div>
							<div class="small-6 columns">
								<a class="lost_password" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost Password?','north' ); ?></a>
							</div>
							<?php do_action( 'woocommerce_login_form' ); ?>
							<div class="small-12 columns">
								<?php wp_nonce_field( 'woocommerce-login' ); ?>
								<input type="submit" class="button" name="login" value="<?php _e( 'Login','north' ); ?>" />
								<?php if($_SERVER['HTTP_HOST'] === 'north.fuelthemes.net') {?>
								<p>Try our demo account -  <strong>username:</strong> demo <strong>password</strong> demo</p>
								<?php } ?>
							</div>
							<?php do_action( 'woocommerce_login_form_end' ); ?>
						</form>
						</div>
					</li>
					<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
					<li class="register-container">
						<div class="small-12 medium-8 small-centered columns">
							<h3><?php _e( "I'm a new customer and <br>would like to register." ,'north' ); ?></h3>
							<form method="post" class="register row text-center">
							<?php do_action( 'woocommerce_register_form_start' ); ?>
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
								<div class="small-12 columns">
									<label for="reg_username"><?php _e( 'Username','north' ); ?> <span class="required">*</span></label>
									<input type="text" class="input-text full" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
								</div>

							<?php endif; ?>
							<div class="small-12 columns">
								<label for="reg_email"><?php _e( 'Email','north' ); ?> <span class="required">*</span></label>
								<input type="email" class="input-text full" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
							</div>
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
							<div class="small-12 columns">
								<label for="reg_password"><?php _e( 'Password','north' ); ?> <span class="required">*</span></label>
								<input type="password" class="input-text full" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
							</div>
							<?php endif; ?>
							<!-- Spam Trap -->
							<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam','north' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

							<?php do_action( 'woocommerce_register_form' ); ?>
							<?php do_action( 'register_form' ); ?>

							<div class="small-12 columns">
								<?php wp_nonce_field( 'woocommerce-register' ); ?>
								<input type="submit" class="button" name="register" value="<?php _e( 'Register','north' ); ?>" />
							</div>
							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
						</div>
					</li>
					<?php endif; ?>
				</ul>
			</div>
			
			<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
		</div>
	</div>
</div>
