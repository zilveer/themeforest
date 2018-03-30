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
 * @package 	proStore/woocommerce/myaccount/my-account.php
 * @sub-package WooCommerce/Templates/myaccount/my-account.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_my_account'); ?>

<?php if ($downloads = $woocommerce->customer->get_downloadable_products()) : ?>
<h4 class="sub-title" id="available-downloads"><em class="icon-install"></em> <?php _e('Available downloads', 'woocommerce'); ?></h4>
	<div class="panel digital_downloads">
		<ul class="digital-downloads">
			<?php foreach ($downloads as $download) : ?>
				<li><?php if (is_numeric($download['downloads_remaining'])) : ?><span class="count label"><?php echo $download['downloads_remaining'] . _n('&nbsp;download remaining', '&nbsp;downloads remaining', $download['downloads_remaining'], 'woocommerce'); ?></span><?php endif; ?> <a href="<?php echo esc_url( $download['download_url'] ); ?>"><u><?php echo $download['download_name']; ?></u></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<h4 class="sub-title" id="recent-orders"><em class="icon-basket"></em> <?php _e('Recent Orders', 'woocommerce'); ?></h4>
<?php woocommerce_get_template('myaccount/my-orders.php', array( 'recent_orders' => $recent_orders )); ?>

<h4 class="sub-title"><em class="icon-map"></em> <?php _e('My Address', 'woocommerce'); ?></h4>
<p class="myaccount_address"><?php _e('The following addresses will be used on the checkout page by default.', 'woocommerce'); ?></p>
<?php woocommerce_get_template('myaccount/my-address.php'); ?>

<?php
do_action('woocommerce_after_my_account');