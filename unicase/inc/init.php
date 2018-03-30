<?php
/**
 * unicase engine room
 *
 * @package unicase
 */

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/classes/wp_bootstrap_navwalker.php';
require get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/admin/post-formats/load.php';
require get_template_directory() . '/inc/metaboxes/unicase-page-meta-box.php';
require get_template_directory() . '/inc/functions/setup.php';

require get_template_directory() . '/inc/functions/retina.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/functions/extras.php';
require get_template_directory() . '/inc/functions/media.php';

/**
 * Initialize Theme Options
 */
if( is_redux_activated() ) {
	require get_template_directory() . '/inc/redux-framework/unicase-options.php';
	require get_template_directory() . '/inc/redux-framework/hooks.php';
	require get_template_directory() . '/inc/redux-framework/functions.php';
}

/**
 * Structure.
 * Template functions used throughout the theme.
 */
require get_template_directory() . '/inc/structure/hooks.php';
require get_template_directory() . '/inc/structure/layout.php';
require get_template_directory() . '/inc/structure/post.php';
require get_template_directory() . '/inc/structure/page.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/footer.php';
require get_template_directory() . '/inc/structure/comments.php';
require get_template_directory() . '/inc/structure/template-tags.php';

/**
 * Load WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
	require get_template_directory() . '/inc/woocommerce/integrations.php';
	require get_template_directory() . '/inc/woocommerce/product-taxonomies.php';
}

/**
 * Load Dokan compatibility files.
 */
if ( is_dokan_activated() ) {
	require get_template_directory() . '/inc/dokan/functions.php';
	require get_template_directory() . '/inc/dokan/hooks.php';
}

/**
 * Load Visual Composer Compatibility Files 
 */
if( is_vc_activated() ) {
	require get_template_directory() . '/inc/visual-composer/setup.php';
	require get_template_directory() . '/inc/visual-composer/hooks.php';
	require get_template_directory() . '/inc/visual-composer/functions.php';
}

if( is_wpml_activated() ) {
	require get_template_directory() . '/inc/wpml/hooks.php';
	require get_template_directory() . '/inc/wpml/functions.php';
}
