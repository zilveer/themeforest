<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.0.0
 * 
 * Sidebar Template
 * Created by CMSMasters
 * 
 */


if (class_exists('woocommerce') && is_shop()) {
	$cmsms_page_id = wc_get_page_id('shop');
} else {
	$cmsms_page_id = get_the_ID();
}


if ( 
	!is_404() && 
	!is_archive() && 
	!is_search() && 
	!is_home() || 
	(class_exists('woocommerce') && is_shop())
) {
	$sidebar_id = get_post_meta($cmsms_page_id, 'cmsms_sidebar_id', true);
}


if (isset($sidebar_id) && is_dynamic_sidebar($sidebar_id) && is_active_sidebar($sidebar_id)) {
	dynamic_sidebar($sidebar_id);
} else if (is_active_sidebar('sidebar_default')) {
	dynamic_sidebar('sidebar_default');
} else {
	sidebarDefaultText();
}

