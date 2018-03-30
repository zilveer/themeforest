<?php
$geode_dir = WP_CONTENT_DIR .'/geode-includes/';
if (!is_dir($geode_dir))
	@mkdir($geode_dir);

$geode_includes = ABSPATH . 'wp-content/geode-includes/includes.php';
if ( file_exists($geode_includes) ) {
	require_once( $geode_includes );
} else {
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	WP_Filesystem();
	global $wp_filesystem;
	$wp_filesystem->put_contents( $geode_includes, '', FS_CHMOD_FILE );
}

require_once('functions/class-tgm-plugin-activation.php');
require_once('functions/lib/pix_sidebar-generator.php');
require_once('functions/lib/pix_functions.php');
require_once('functions/lib/pix_admin.php');
require_once('functions/lib/pix_importer.php');
require_once('functions/lib/pix_metaboxes.php');
require_once('functions/lib/pix_menu.php');
	require_once('functions/lib/admin/pix_interface.php');
	require_once('functions/lib/admin/pix_adminpanel.php');
	require_once('functions/lib/admin/pix_register.php');
	require_once('functions/lib/admin/pix_importexport.php');
	require_once('functions/lib/admin/pix_layout.php');
	require_once('functions/lib/admin/pix_topbar.php');
	require_once('functions/lib/admin/pix_headerpanel.php');
	require_once('functions/lib/admin/pix_navpanel.php');
	require_once('functions/lib/admin/pix_titlesection.php');
	require_once('functions/lib/admin/pix_sidebar.php');
	require_once('functions/lib/admin/pix_scripts.php');
	require_once('functions/lib/admin/pix_footerpanel.php');
	require_once('functions/lib/admin/pix_sidebargenerator.php');
	require_once('functions/lib/admin/pix_latestpostspage.php');
	require_once('functions/lib/admin/pix_blogpages.php');
	require_once('functions/lib/admin/pix_categories.php');
	require_once('functions/lib/admin/pix_posts.php');
	require_once('functions/lib/admin/pix_portfolio.php');
	require_once('functions/lib/admin/pix_portfolio_items.php');
	require_once('functions/lib/admin/pix_googlefonts.php');
	require_once('functions/lib/admin/pix_maintypography.php');
	require_once('functions/lib/admin/pix_css.php');
	require_once('functions/lib/admin/pix_shop.php');
	require_once('functions/lib/admin/pix_products.php');
	require_once('functions/lib/admin/pix_woocommerce.php');
	require_once('functions/lib/admin/pix_colorbox.php');
	require_once('functions/lib/admin/pix_layout_colors.php');
	require_once('functions/lib/admin/pix_main_colors.php');
	require_once('functions/lib/admin/pix_footer_colors.php');
	require_once('functions/lib/admin/pix_top_sliding_colors.php');
	require_once('functions/lib/admin/pix_topbar_colors.php');

function pix_is_woocommerce_active(){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active('woocommerce/woocommerce.php')) {
	    return true;
	} else {
	    return false;
	}
}
function pix_is_woocommerce(){
	if (pix_is_woocommerce_active() && is_woocommerce()) {
	    return true;
	} else {
	    return false;
	}
}
function pix_is_product(){
	if (pix_is_woocommerce_active() && is_product()) {
	    return true;
	} else {
	    return false;
	}
}
if (pix_is_woocommerce_active()) {
	require_once('functions/lib/pix_woocommerce.php');
	
	if ( class_exists('WC_Shortcodes') )
		require_once('functions/lib/pix_woocommerce_sc.php');
}
