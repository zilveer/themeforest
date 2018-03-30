<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.6
 * 
 * Sidebar Template
 * Created by CMSMasters
 * 
 */
 
 
$cmsms_option = cmsms_get_global_options();


if (class_exists('woocommerce') && is_shop()) {
	$cmsms_page_id = wc_get_page_id('shop');
} else {
	$cmsms_page_id = get_the_ID();
}


if (((class_exists('woocommerce') && !is_shop()) || !class_exists('woocommerce')) && is_archive()) {
	$bottom_sidebar_id = $cmsms_option[CMSMS_SHORTNAME . '_archive_bottom_sidebar'];
} elseif (is_search()) {
	$bottom_sidebar_id = $cmsms_option[CMSMS_SHORTNAME . '_search_bottom_sidebar'];
} elseif (!is_404() && !is_home()) {
	$bottom_sidebar_id = get_post_meta($cmsms_page_id, 'cmsms_bottom_sidebar_id', true);
}


if (isset($bottom_sidebar_id) && is_dynamic_sidebar($bottom_sidebar_id) && is_active_sidebar($bottom_sidebar_id)) {
	dynamic_sidebar($bottom_sidebar_id);
} elseif (is_active_sidebar('sidebar_bottom')) {
	dynamic_sidebar('sidebar_bottom');
} else {
	sidebarDefaultText();
}

