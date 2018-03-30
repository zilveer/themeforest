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
 * @package 	proStore/woocommerce/myaccount/form-edit-address.php
 * @sub-package WooCommerce/Templates/myaccount/form-edit-address.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce, $current_user; ?>

<?php  get_currentuserinfo(); ?>

<?php $woocommerce->show_messages(); ?>

<?php if (!$load_address) : ?>

	<?php woocommerce_get_template('myaccount/my-address.php'); ?>

<?php else : ?>

	<form action="<?php echo esc_url( add_query_arg( 'address', $load_address, get_permalink( woocommerce_get_page_id('edit_address') ) ) ); ?>" method="post">

		<h4 class="sub-title"><?php if ($load_address=='billing') { echo '<em class="icon-dollar"></em> '; _e('Billing Address', 'woocommerce'); } else { echo '<em class="icon-address"></em> ';  _e('Shipping Address', 'woocommerce'); } ?></h4>

		<?php
		foreach ($address as $key => $field) :
			$value = (isset($_POST[$key])) ? $_POST[$key] : get_user_meta( get_current_user_id(), $key, true );

			// Default values
			if (!$value && ($key=='billing_email' || $key=='shipping_email')) $value = $current_user->user_email;
			if (!$value && ($key=='billing_country' || $key=='shipping_country')) $value = $woocommerce->countries->get_base_country();
			if (!$value && ($key=='billing_state' || $key=='shipping_state')) $value = $woocommerce->countries->get_base_state();

			custom_form_field( $key, $field, $value, '' );
		endforeach;
		?>

		<p class="text-center submit-changes">
			<input type="submit" class="button large" name="save_address" value="<?php _e('Save Address', 'woocommerce'); ?>" />
		</p>

	<?php $woocommerce->nonce_field('edit_address') ?>
		<input type="hidden" name="action" value="edit_address" />

	</form>

<?php endif; ?>