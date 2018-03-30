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
 * @package 	proStore/woocommerce/single-product/tabs/tabs-description.php
 * @sub-package WooCommerce/Templates/single-product/tabs/tabs-description.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $post; ?>

<?php
if ( $post->post_content ) : ?>
	<dd class="description_tab"><a href="#tab-description"><h4><em class="icon-feather"></em> <span><?php _e('Description', 'woocommerce'); ?></span></h4></a></dd>
<?php endif; ?>