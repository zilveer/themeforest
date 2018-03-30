<?php
/**
 * mediacenter engine room
 *
 * @package mediacenter
 */

/**
 * Setup.
 * Load Classes. Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/classes/wp_bootstrap_navwalker.php';
require get_template_directory() . '/inc/classes/wp_bootstrap_categorieswalker.php';
require get_template_directory() . '/inc/classes/class-mediacenter.php';
require get_template_directory() . '/inc/functions/hooks.php';
require get_template_directory() . '/inc/functions/setup.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/functions/media.php';
require get_template_directory() . '/inc/functions/extras.php';

/**
 * Initialize Theme Options
 */
if( is_redux_activated() ) {
	require get_template_directory() . '/inc/redux-framework/mc-options.php';
	require get_template_directory() . '/inc/redux-framework/hooks.php';
	require get_template_directory() . '/inc/redux-framework/functions.php';
	require get_template_directory() . '/inc/redux-framework/header.php';
	require get_template_directory() . '/inc/redux-framework/footer.php';
	require get_template_directory() . '/inc/redux-framework/woocommerce.php';
}

/**
 * Structure - Layout and template functions used throught the theme
 */
require get_template_directory() . '/inc/structure/hooks.php';
require get_template_directory() . '/inc/structure/layout.php';
require get_template_directory() . '/inc/structure/page.php';
require get_template_directory() . '/inc/structure/comments.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/footer.php';

/**
 * Load WooCommerce compatibility files
 */
if( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
	require get_template_directory() . '/inc/woocommerce/integrations.php';
}

/**
 * Load Dokan compatibility files.
 */
if ( is_dokan_activated() ) {
	require get_template_directory() . '/inc/dokan/functions.php';
	require get_template_directory() . '/inc/dokan/hooks.php';
}

/**
 * Load ECWID compatibility files
 */
if( defined( 'ECWID_DEMO_STORE_ID' ) ) {
	require get_template_directory() . '/inc/ecwid/hooks.php';
	require get_template_directory() . '/inc/ecwid/functions.php';
}

/**
 * Load Visual Composer compatibility files
 */
if( is_visual_composer_activated() ) {
	require get_template_directory() . '/inc/visual-composer/hooks.php';
	require get_template_directory() . '/inc/visual-composer/functions.php';
}

/**
 * Load WPML Compatibility Files
 */
if( is_wpml_activated() ) {
	require get_template_directory() . '/inc/wpml/hooks.php';
	require get_template_directory() . '/inc/wpml/functions.php';
}