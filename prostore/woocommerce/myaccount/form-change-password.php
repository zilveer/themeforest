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
 * @package 	proStore/woocommerce/myaccount/form-change-password.php
 * @sub-package WooCommerce/Templates/myaccount/form-change-password.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<form action="<?php echo esc_url( get_permalink(woocommerce_get_page_id('change_password')) ); ?>" method="post">

	<div class="row container">
		<div class="six columns">
			<label for="password_1"><?php _e('New password', 'woocommerce'); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password_1" id="password_1" />
		</div>
		<div class="six columns">
			<label for="password_2"><?php _e('Re-enter new password', 'woocommerce'); ?> <span class="required">*</span></label>
			<input type="password" class="input-text" name="password_2" id="password_2" />
		</div>
	</div>
	
	<p class="submit-changes text-center"><input type="submit" class="button large" name="change_password" value="<?php _e('Save', 'woocommerce'); ?>" /></p>

	<?php $woocommerce->nonce_field('change_password')?>
	<input type="hidden" name="action" value="change_password" />

</form>