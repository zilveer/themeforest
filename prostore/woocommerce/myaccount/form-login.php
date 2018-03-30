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
 * @package 	proStore/woocommerce/myaccount/form-login.php
 * @sub-package WooCommerce/Templates/myaccount/form-login.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<div class="gravatar login-page"><div></div></div></div>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

<div class="row container" id="customer_login">

	<div class="six columns">

<?php endif; ?>

		<h4><em class="icon-lock-open"></em> <?php _e('Login', 'woocommerce'); ?></h4>
		<form method="post" class="login_customer">
			<div class="row">
				<div class="six columns">
					<label for="username"><?php _e('Username or email', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="text" class="input-text gravatar-email" name="username" id="username" placeholder="Username or email" />
				</div>
				<div class="six columns end">
					<label for="password"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
					<input class="input-text" type="password" name="password" id="password" placeholder="Password" />
				</div>
			</div>
			<div class="row">
				<div class="six columns text-right mobile-two">
					<?php $woocommerce->nonce_field('login', 'login') ?>
					<input type="submit" class="button" name="login" value="<?php _e('Login', 'woocommerce'); ?>" />
				</div>
				<div class="six columns end mobile-two">
					<a class="lost_password button alert" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e('Lost Password?', 'woocommerce'); ?></a>
				</div>
			</div>
		</form>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="six columns end">

		<h4><em class="icon-user-add"></em> <?php _e('Register', 'woocommerce'); ?></h4>
		<form method="post" class="register">

			<div class="row">
				<div class="six columns">
					<label for="reg_username"><?php _e('Username', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" placeholder="Username" />
				</div>
				<div class="six columns">
					<label for="reg_email"><?php _e('Email', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="email" class="input-text gravatar-email" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" placeholder="Email" />
				</div>
			</div>

			<div class="row">
				<div class="six columns">
					<label for="reg_password"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" placeholder="Password" />
				</div>
				<div class="six columns end">
					<label for="reg_password2"><?php _e('Re-enter password', 'woocommerce'); ?> <span class="required">*</span></label>
					<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" placeholder="Password" />
				</div>
			</div>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" /></div>

			<?php do_action( 'register_form' ); ?>

			<div class="row">
				<div class="twelve columns text-center">
					<?php $woocommerce->nonce_field('register', 'register') ?>
					<input type="submit" class="button" name="register" value="<?php _e('Register', 'woocommerce'); ?>" />
				</div>
			</div>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>