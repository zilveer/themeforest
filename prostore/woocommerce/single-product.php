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
 * @package 	proStore/woocommerce/single-product.php
 * @sub-package WooCommerce/Templates/single-product.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php get_header('shop'); ?>

	<?php
		do_action('custom_before_main_content_single');
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		do_action('custom_after_main_content_single');
	?>

<?php get_footer('shop'); ?>