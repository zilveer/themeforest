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
 * @package 	proStore/woocommerce/single-product/tabs/description.php
 * @sub-package WooCommerce/Templates/single-product/tabs/description.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce, $post; ?>

<?php
if ( $post->post_content ) : ?>
	<div class="panel entry-content" id="tab-description">

		<?php the_content(); ?>

	</div>
<?php endif; ?>