<?php
// Redirect to webnus welcome page
if ( is_admin() )
	include_once get_template_directory() . '/inc/webnus-admin-welcome/index.php';

// Include theme update functions
include_once get_template_directory() . '/inc/webnus-admin-welcome/webnus-update-functions.php';

if ( ! class_exists( 'ReduxFramework' ) )
	include_once get_template_directory() . '/inc/theme-options/ReduxCore/framework.php';

if ( ! isset( $webnus_options ) ) :
	include_once get_template_directory() . '/inc/theme-options/webnus-options/webnus-options.php';
	include_once get_template_directory() . '/inc/theme-options/extensions/wbc_importer/webnus-wbc-configs.php';
	include_once get_template_directory() . '/inc/theme-options/extensions/wbc_importer/webnus-prevent-duplicated-menus.php';
endif;

include_once get_template_directory() . '/inc/shortcodes/shortcode.php';
include_once get_template_directory() . '/inc/sidebars/general-sidebars.php';
include_once get_template_directory() . '/inc/editor/nc-sc.php';
include_once get_template_directory() . '/inc/widgets/widgets-init.php';

include_once get_template_directory() . '/inc/helpers/breadcrumbs.php';
include_once get_template_directory() . '/inc/helpers/cat-field.php';
include_once get_template_directory() . '/inc/helpers/live-search.php';
include_once get_template_directory() . '/inc/helpers/get-the-image.php';
include_once get_template_directory() . '/inc/helpers/show-ids.php';
include_once get_template_directory() . '/inc/helpers/speakers-images.php';

include_once get_template_directory() . '/inc/plugins/woocommerce/index.php';
include_once get_template_directory() . '/inc/plugins/plugin-activator/init.php';
include_once get_template_directory() . '/inc/plugins/sweet-custom-menu/sweet-custom-menu.php';

include_once get_template_directory() . '/inc/metaboxes/setup.php';
include_once get_template_directory() . '/inc/metaboxes/pagesubtitle-init.php';
include_once get_template_directory() . '/inc/metaboxes/featured-video-init.php';
include_once get_template_directory() . '/inc/metaboxes/page_title_meta.php';
include_once get_template_directory() . '/inc/metaboxes/slider-meta-init.php';
include_once get_template_directory() . '/inc/metaboxes/homedark-init.php';
include_once get_template_directory() . '/inc/metaboxes/is_mega-init.php';
include_once get_template_directory() . '/inc/metaboxes/blogpost_meta.php';
include_once get_template_directory() . '/inc/metaboxes/sermon_meta.php';
include_once get_template_directory() . '/inc/metaboxes/cause_meta.php';