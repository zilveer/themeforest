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
	$middle_sidebar_id = $cmsms_option[CMSMS_SHORTNAME . '_archive_middle_sidebar'];
} elseif (is_search()) {
	$middle_sidebar_id = $cmsms_option[CMSMS_SHORTNAME . '_search_middle_sidebar'];
} elseif (!is_404() && !is_home()) {
	$middle_sidebar_id = get_post_meta($cmsms_page_id, 'cmsms_middle_sidebar_id', true);
} 


if (isset($middle_sidebar_id) && is_dynamic_sidebar($middle_sidebar_id) && is_active_sidebar($middle_sidebar_id)) {
	dynamic_sidebar($middle_sidebar_id);
} else if (is_active_sidebar('sidebar_middle')) {
	dynamic_sidebar('sidebar_middle');
} else {
	sidebarDefaultText();
}

