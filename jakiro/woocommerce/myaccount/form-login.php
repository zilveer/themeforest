<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
<div class="tabbable tabs-primary tabs-top woocommerce-tabs woocommerce-account-tabs">
	<ul role="tablist" class="nav nav-tabs">
		<li class="active">
			<a href="#tab-customer_login" role="tab" data-toggle="tab"><?php esc_html_e( 'Login', 'jakiro' ); ?></a>
		</li>
		<li>
			<a href="#tab-customer_register" role="tab" data-toggle="tab"><?php esc_html_e( 'Register', 'jakiro' ); ?></a>
		</li>
	</ul>
	<div class="tab-content">
		
		<div class="tab-pane active" id="tab-customer_login">
<?php else:?>		
				<h2 class="woocommerce-account-heading"><?php esc_html_e( 'Login', 'jakiro' ); ?></h2>	
<?php endif; ?>
				
				<form method="post" class="login">

					<h4><?php esc_html_e('login to your account','jakiro')?></h4>

					<?php do_action( 'woocommerce_login_form_start' ); ?>
		
					<p class="form-row form-row-wide">
						<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" placeholder="<?php esc_html_e( 'Username', 'jakiro' ); ?>" />
					</p>
					<p class="form-row form-row-wide">
						<input class="input-text" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Password', 'jakiro' ); ?>"/>
					</p>
		
					<?php do_action( 'woocommerce_login_form' ); ?>
					<div class="form-row clearfix">
						<p class="form-row-first">
							<?php wp_nonce_field( 'woocommerce-login' ); ?>
							<label for="rememberme" class="inline form-flat-checkbox">
								<input name="rememberme" type="checkbox" id="rememberme" value="forever" /><i></i><?php esc_html_e( 'Remember me', 'jakiro' ); ?>
							</label>
							<button type="submit" name="login" value="1" class="button"><?php esc_html_e('Login','jakiro');?><i class="elegant_arrow_right"></i></button>
						</p>
						<p class="form-row-last lost_password">
							<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'jakiro' ); ?></a>
						</p>
					</div>
		
					<?php do_action( 'woocommerce_login_form_end' ); ?>
					<?php if(dh_get_theme_option('facebook_login',0) && get_option('users_can_register')):?>
						<?php do_action('dh_facebook_login_button');?>
					<?php endif;?>
		
				</form>
		
	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
		</div>
		<div class="tab-pane" id="tab-customer_register">
			<form method="post" class="register">
		
				<?php do_action( 'woocommerce_register_form_start' ); ?>
	
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
	
					<p class="form-row form-row-wide">
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" placeholder="<?php esc_html_e( 'Username', 'jakiro' ); ?>" />
					</p>
	
				<?php endif; ?>
	
				<p class="form-row form-row-wide">
					
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" placeholder="<?php esc_html_e( 'Email', 'jakiro' ); ?>"/>
				</p>
	
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
	
					<p class="form-row form-row-wide">
						
						<input type="password" class="input-text" name="password" id="reg_password" placeholder="<?php esc_html_e( 'password', 'jakiro' ); ?>" />
					</p>
	
				<?php endif; ?>
	
				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'jakiro' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
	
				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>
	
				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-register' ); ?>
					<input type="submit" class="button" name="register" value="<?php esc_html_e( 'Register', 'jakiro' ); ?>" />
				</p>
	
				<?php do_action( 'woocommerce_register_form_end' ); ?>
	
			</form>
	
		</div>
		
	</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
