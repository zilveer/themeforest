<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
global $theretailer_theme_options;

?>

<?php wc_print_notices(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<style>
.entry-header {
	display:none;
}
</style>

<div class="gbtr_login_register_wrapper <?php if (get_option('woocommerce_enable_myaccount_registration')!='yes') : ?>myaccount_registration_disabled<?php endif; ?>">
                    
    <div class="gbtr_login_register_slider" >    
              
		<div class='gbtr_login_register_slide_1'>

            <h2><?php _e( 'Login', 'woocommerce' ); ?></h2>
    
            <form method="post" class="login">
    
                <?php do_action( 'woocommerce_login_form_start' ); ?>
    
                <p class="form-row form-row-wide">
                    <label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                </p>
                <p class="form-row form-row-wide">
                    <label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                    <input class="input-text" type="password" name="password" id="password" />
                </p>
    
                <?php do_action( 'woocommerce_login_form' ); ?>
    
                <p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
                    <input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" /> 
                    <label for="rememberme" class="inline gbtr_rememberme">
                        <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
                    </label>
                </p>
                <p class="lost_password">
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
                </p>
    
                <?php do_action( 'woocommerce_login_form_end' ); ?>
    
            </form>
        
        </div>

		<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
    
        <div class='gbtr_login_register_slide_2'>

            <h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
    
            <form method="post" class="register">
    
                <?php do_action( 'woocommerce_register_form_start' ); ?>
    
					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>    
                    <p class="form-row form-row-wide">
                        <label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
                        <input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                    </p>    
                	<?php endif; ?>
    
                <p class="form-row form-row-wide">
                    <label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
                </p>
    
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>	
                <p class="form-row form-row-wide">
                    <label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="input-text" name="password" id="reg_password" />
                </p>    
				<?php endif; ?>

                <!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
    
                <?php do_action( 'woocommerce_register_form' ); ?>
                <?php do_action( 'register_form' ); ?>
    
                <p class="form-row">
					<?php wp_nonce_field( 'woocommerce-register' ); ?>
                    <input type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
                </p>
    
                <?php do_action( 'woocommerce_register_form_end' ); ?>
    
            </form>
        
        </div>
        
        <?php endif; ?>

	</div>

</div>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

<div class="gbtr_login_register_switch">
    <div class="gbtr_login_register_label_slider">
        <div class="gbtr_login_register_reg">
        	<h2><?php _e('Register', 'woocommerce'); ?></h2>
            <?php _e( $theretailer_theme_options['registration_content'], 'woocommerce' ); ?>
            <input type="submit" class="button" name="create_account" value="<?php _e('Register', 'woocommerce'); ?>">
        </div>
        
        <div class="gbtr_login_register_log">
        	<h2><?php _e('Login', 'woocommerce'); ?></h2>
            <?php _e( $theretailer_theme_options['login_content'], 'woocommerce' ); ?>
            <input type="submit" class="button" name="create_account" value="<?php _e('Login', 'woocommerce'); ?>">
        </div>
    </div>
</div>

<?php endif; ?>

<div class="clr"></div>

<?php do_action('woocommerce_after_customer_login_form'); ?>

<?php if ( isset($_POST["gbtr_login_register_section_name"]) && $_POST["gbtr_login_register_section_name"] == "register") { ?>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery(document).ready(function($) {
	 $('.gbtr_login_register_slider').animate({
		left: '-500',
	 }, 0, function() {
		// Animation complete.
	 });
	 
	 $('.gbtr_login_register_wrapper').animate({
		height: $('.gbtr_login_register_slide_2').height() + 100
	 }, 0, function() {
		// Animation complete.
	 });
	 
	 $('.gbtr_login_register_label_slider').animate({
		top: '-500',
	 }, 0, function() {
		// Animation complete.
	 });
});
//--><!]]>
</script>

<?php } ?>