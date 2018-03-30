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
 * @package 	proStore/woocommerce/single-product/tabs.php
 * @sub-package WooCommerce/Templates/single-product/tabs.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php
ob_start();

do_action('woocommerce_product_tabs');

$tabs = trim( ob_get_clean() );


if ( ! empty( $tabs ) ) : ?>
	<div class="woocommerce_tabs">
		<div class="row container">
			<div class="twelve columns clearfix">
				<dl class="tabs">
					<?php echo $tabs; ?>
				</dl>
				<?php do_action('woocommerce_product_tab_panels'); ?>
			</div>
		</div>
	</div>
<?php endif; ?>