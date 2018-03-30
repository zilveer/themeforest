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
 * @package 	proStore/woocommerce/shop/form-login.php
 * @sub-package WooCommerce/Templates/shop/form-login.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>

<?php if (is_user_logged_in()) return; ?>

<form method="post" class="login">
	<?php if ($message) echo wpautop(wptexturize($message)); ?>

	<div class="row container">
		<div class="six columns">
			<div class="row collapse">
			  <div class="two mobile-one columns">
				<div class="gravatar"><div class="prefix"></div></div>
			  </div>
			  <div class="ten mobile-three columns">
			  	<label for="username"><?php _e('Username or email', 'woocommerce'); ?> <span class="required">*</span></label>			
				<input type="text" class="dark gravatar-email" name="username" id="username" placeholder="Username or email" />
			  </div>
			</div>
		</div>
		<div class="six columns">
			<div class="row collapse">
				<div class="two mobile-one column"> </div>
				<div class="ten mobile-three columns">
					<label for="password"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
					<input class="dark" type="password" name="password" id="password" placeholder="Password" />
				</div>
			</div>
		</div>
	</div>
	<div class="row container">
		<div class="six columns mobile-two text-right">
			<?php $woocommerce->nonce_field('login', 'login') ?>
			<input type="submit" class="button" name="login" value="<?php _e('Login', 'woocommerce'); ?>" />
			<input type="hidden" name="redirect" value="<?php echo $redirect ?>" />
		</div>
		<div class="six columns mobile-two">
			<a class="lost_password button alert" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e('Lost Password ?', 'woocommerce'); ?></a>
		</div>
	</div>
</form>