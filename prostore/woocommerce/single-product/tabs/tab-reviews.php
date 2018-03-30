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
 * @package 	proStore/woocommerce/single-product/tabs/tabs-reviews.php
 * @sub-package WooCommerce/Templates/single-product/tabs/tabs-reviews.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php
if ( comments_open() ) : ?>
	<dd class="reviews_tab"><a href="#tab-reviews"><h4><em class="icon-pencil"></em> <span><?php _e('Reviews', 'woocommerce'); ?><?php echo comments_number(' (0)', ' (1)', ' (%)'); ?></span></h4></a></dd>
<?php endif; ?>