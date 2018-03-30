<?php
/**
 * Require files that deal with various plugin integrations.
 *
 * @package Pile
 */

/**
 * Load Customify compatibility file.
 * https://wordpress.org/plugins/customify/
 */
require get_template_directory() . '/inc/integrations/customify.php';

/**
 * Load Jetpack compatibility file.
 * https://jetpack.me/
 */
require get_template_directory() . '/inc/integrations/jetpack.php';

/**
 * Load WooCommerce compatibility file.
 * https://www.woothemes.com/woocommerce/
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/integrations/woocommerce-template-tags.php';
	require get_template_directory() . '/inc/integrations/woocommerce-extras.php';
}

/**
 * Load PixCodes compatibility file
 * https://wordpress.org/plugins/pixcodes/
 */
if ( class_exists( 'WpGradeShortcodes' ) ) {
	require get_template_directory() . '/inc/integrations/pixcodes.php';
}

/**
 * Load Yoast SEO compatibility file
 * https://wordpress.org/plugins/wordpress-seo/
 */

require get_template_directory() . '/inc/integrations/yoast-seo.php';
