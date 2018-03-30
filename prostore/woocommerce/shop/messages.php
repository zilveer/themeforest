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
 * @package 	proStore/woocommerce/shop/messages.php
 * @sub-package WooCommerce/Templates/shop/messages.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php if ( ! $messages ) return; ?>

<?php foreach ( $messages as $message ) : ?>
	<div class="woocommerce_message success alert-box">
		<div class="icon-box">
			<span class="success-color"><em class="icon-info"></em></span>
		</div>
		<?php echo $message; ?>
	</div>
<?php endforeach; ?>
