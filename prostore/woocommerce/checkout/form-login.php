<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/checkout/form-login.php
 * @sub-package WooCommerce/Templates/checkout/form-login.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php
if ( is_user_logged_in() ) { 
?>
	<div class="panel checkout log_box logged_in">
		<div class="icon-box">
			<?php global $userdata; get_currentuserinfo(); echo get_avatar( $userdata->ID, 58 ); ?>				
		</div>
		<h5><span class="logged-in">Logged in as</span> <span class="alert-color"><?php echo $userdata->display_name; ?></span></h5>
	</div>
<?php
} else {
?>
	<div class="panel checkout log_box">
		<?php

			if ( get_option('woocommerce_enable_signup_and_login_from_checkout') == "no" ) return;
			$info_message = apply_filters('woocommerce_checkout_login_message', __('Already registered?', 'woocommerce'));
	
		?>
			<div class="row container">
				<div class="six columns">
					<?php echo $info_message; ?> <a href="#" class="showlogin"><?php _e('Click here to login', 'woocommerce'); ?></a>
				</div>
				<div class="six columns end">
					<?php woocommerce_login_form( array( 'message' => __('If you have shopped with us before, please enter your details in the boxes below. <br/><br/>If you are a new customer please proceed to the Billing &amp; Shipping section.', 'woocommerce'), 'redirect' => get_permalink(woocommerce_get_page_id('checkout')) ) ); ?>
				</div>
			</div>
	</div>

<?php
	}
?>