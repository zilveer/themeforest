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

<?php 
wc_print_notices();
?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>


	<div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php _e( 'Your account details', 'homeshop' ); ?></h4>
			</div>

			
			<div class="page-content">
				<p><?php _e( 'If you are already registered please login directly here', MAD_BASE_TEXTDOMAIN ); ?></p>
			
				<form method="post" class="login">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<div class="row">
					
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="iconic-input">
								<input type="text" name="username" class="woocommerce-Input woocommerce-Input--text input-text"  id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
								<i class="icons icon-user-3"></i>
							</div>
						</div>
					
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="iconic-input">
								<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" 
								/>
								<i class="icons icon-lock"></i>
							</div>
						</div>
					
					</div>

					<?php do_action( 'woocommerce_login_form' ); ?>

					
					<input name="rememberme" class="woocommerce-Input woocommerce-Input--checkbox" value="forever" type="checkbox" id="login-remember-2" style="display:none;" /> <label for="login-remember-2"><?php _e( 'Remember me', 'homeshop' ); ?></label>
                    <br/><br/>
					
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 align-left">
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<input type="submit" class="woocommerce-Button orange" name="login" value="<?php _e( 'Login', 'homeshop' ); ?>" style="padding: 5px 15px;" />
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 align-right">
							<small>
								<a class="align-right" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Forgot your password?', 'homeshop' ); ?></a>
								<br>
								<a class="align-right" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Forgot your username?', 'homeshop' ); ?></a>
								<br>
							</small>
						</div>
					</div>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>
					
			
			</div>
			
		</div>
                          
	</div>



<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12 register-account">
			
			<div class="carousel-heading no-margin">
				<h4><?php _e( 'Register', 'homeshop' ); ?></h4>
			</div>

	
	
			<form method="post" class="register">

			

			
			<div class="page-content">
			<?php do_action( 'woocommerce_register_form_start' ); ?>

			
				
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
				<div class="row">	
					<div class="col-lg-4 col-md-4 col-sm-4">
						<p><?php _e( 'Username', 'homeshop' ); ?>*</p>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</div>	
				</div>
				<?php endif; ?>
				
	
				<div class="row">

					<div class="col-lg-4 col-md-4 col-sm-4">
						<p><?php _e( 'E-Mail', 'homeshop' ); ?>*</p>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8">
						<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>"  />
					</div>	

				</div>
				
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
				<div class="row">               
					<div class="col-lg-4 col-md-4 col-sm-4">
						<p><?php _e( 'Password', 'homeshop' ); ?></p>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8">
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
					</div>	
				</div>
				<?php endif; ?>
				
				
				
				
				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'homeshop' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
				
				
				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>
	
				<div class="row">
				
					<div class="col-lg-12 col-md-12 col-sm-12">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<input class="big" type="submit" class="woocommerce-Button button" name="register" value="<?php _e( 'Register', 'homeshop' ); ?>" />
						
					</div>
					
				</div>

				
				
			<?php do_action( 'woocommerce_register_form_end' ); ?>	
			</div>
			
			

			</form>


	
		</div>
                          
	</div>
	

<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>