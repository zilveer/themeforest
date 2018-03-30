<?php
/**
 * Aqua Page Builder Config
 *
 * This file handles various configurations
 * of the page builder page
 *
 */
function aq_page_builder_config() {
	$config = array();
	$config['menu_title'] = __('Page Builder', 'framework');
	$config['page_title'] = __('Page Builder', 'framework');
	$config['page_slug'] = __('aq-page-builder', 'framework');
	$config['contextual_help'] = '';
	$config['debug'] = false;
	return $config;
}
?>